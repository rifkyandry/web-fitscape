<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use App\Models\User;
use App\Models\Presence;
use App\Models\MembershipPackage;
use Illuminate\Support\Facades\Auth;
class MemberController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin/memberships');
        }

        $google2fa = new Google2FA();
        $otpCode   = $google2fa->getCurrentOtp($user->totp_secret);
        $qrString  = $user->member_id . '|' . $otpCode;
        $expiresIn = 30 - (time() % 30);

        $presences = Presence::where('user_id', $user->id)
            ->orderBy('check_in_at', 'desc')
            ->take(10)
            ->get();

        $lastPresence = $presences->first();

        // Ambil semua paket aktif untuk form pilih membership
        $packages = MembershipPackage::where('is_active', true)->get();

        return view('dashboard', compact(
            'user', 'qrString', 'expiresIn',
            'lastPresence', 'presences', 'packages'
        ));
    }
    public function absensiStatus()
{
    $sudahAbsen = \App\Models\Presence::where('user_id', Auth::id())
        ->whereDate('check_in_at', today())
        ->exists();

    return response()->json(['sudah_absen' => $sudahAbsen]);
}

    // Member request membership → status pending
    public function requestMembership(Request $request)
  {
    $request->validate([
        'package_id' => 'required|exists:membership_packages,id',
    ]);

    $user    = auth()->user();
    $package = \App\Models\MembershipPackage::findOrFail($request->package_id);

    $user->update([
        'membership_status'       => 'pending',
        'pending_package_id'      => $package->id,
        'pending_duration_months' => round($package->duration_days / 30),
    ]);

    return back()->with('success', 'Permintaan membership berhasil dikirim! Silakan datang ke gym dan lakukan pembayaran. Admin akan mengaktifkan membership Anda.');
}

    // Member batalkan request
    public function cancelRequest()
    {
        $user = Auth::user();

        if ($user->membership_status !== 'pending') {
            return back()->with('error', 'Tidak ada permintaan yang bisa dibatalkan.');
        }

        $user->update([
            'pending_package_id'      => null,
            'pending_duration_months' => null,
            'membership_status'       => 'none',
        ]);

        return back()->with('success', 'Permintaan membership dibatalkan.');
    }

    // Admin konfirmasi pembayaran cash → aktifkan membership
    
    public function confirmMembership(User $user)
{
    if ($user->membership_status !== 'pending') {
        return back()->with('error', 'Member ini tidak memiliki permintaan pending.');
    }

    $duration  = $user->pending_duration_months;
    $startDate = now()->toDateString();

    // Jika masih aktif dan belum expired → tambah dari tanggal expired lama
    // Jika sudah expired atau belum punya membership → mulai dari hari ini
    if (
        $user->membership_end_date &&
        \Carbon\Carbon::parse($user->membership_end_date)->isFuture()
    ) {
        $endDate = \Carbon\Carbon::parse($user->membership_end_date)
            ->addMonths($duration)
            ->toDateString();
    } else {
        $endDate = now()->addMonths($duration)->toDateString();
    }

    $user->update([
        'membership_package_id'   => $user->pending_package_id,
        'membership_status'       => 'active',
        'membership_start_date'   => $startDate,
        'membership_end_date'     => $endDate,
        'pending_package_id'      => null,
        'pending_duration_months' => null,
    ]);

    return back()->with('success', "Membership {$user->name} berhasil diaktifkan hingga {$endDate}!");
}

    // Admin menolak permintaan membership
    public function rejectMembership(User $user)
    {
        if ($user->membership_status !== 'pending') {
            return back()->with('error', 'Tidak ada permintaan pending.');
        }

        $user->update([
            'membership_status'       => 'none',
            'pending_package_id'      => null,
            'pending_duration_months' => null,
        ]);

        return back()->with('success', "Permintaan membership {$user->name} telah ditolak.");
    }
}