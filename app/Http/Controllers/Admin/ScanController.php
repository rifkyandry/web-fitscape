<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Presence;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    public function index()
    {
        return view('admin.scan.index');
    }

    public function verify(Request $request)
    {
        $qrData = $request->input('qr_data');
        $parts = explode('|', $qrData);

        if (count($parts) !== 2) {
            return response()->json([
                'success' => false,
                'message' => 'Format QR tidak valid!'
            ]);
        }

        [$memberId, $otpCode] = $parts;

        $user = User::where('member_id', $memberId)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Member tidak ditemukan!'
            ]);
        }

        if ($user->membership_status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Membership tidak aktif!'
            ]);
        }

        $google2fa = new Google2FA();
        $isValid = $google2fa->verifyKey(
        $user->totp_secret, 
        $otpCode,
        4  // toleransi 2 window = ±60 detik
        );
        if (!$isValid) {
            return response()->json([
                'success' => false,
                'message' => 'Kode QR sudah kedaluwarsa atau tidak valid!'
            ]);
        }

        $alreadyCheckedIn = Presence::where('user_id', $user->id)
            ->whereDate('check_in_at', today())
            ->exists();

        if ($alreadyCheckedIn) {
            return response()->json([
                'success' => false,
                'message' => $user->name . ' sudah absen hari ini!'
            ]);
        }

        Presence::create([
            'user_id'     => $user->id,
            'member_id'   => $user->member_id,
            'check_in_at' => now(),
            'status'      => 'Hadir',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil!',
            'member'  => [
                'name'      => $user->name,
                'member_id' => $user->member_id,
                'package'   => $user->membershipPackage->name ?? '-',
            ]
        ]);
    }
}