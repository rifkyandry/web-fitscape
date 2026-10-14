<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MembershipPackage;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function confirmMembership(User $user)
{
    if ($user->membership_status !== 'pending') {
        return back()->with('error', 'Member ini tidak memiliki permintaan pending.');
    }

    $duration  = $user->pending_duration_months;
    $startDate = now()->toDateString();
    $endDate   = now()->addMonths($duration)->toDateString();

    $user->update([
        'membership_package_id'   => $user->pending_package_id,
        'membership_status'       => 'active',
        'membership_start_date'   => $startDate,
        'membership_end_date'     => $endDate,
        'pending_package_id'      => null,
        'pending_duration_months' => null,
    ]);

    return back()->with('success', "Membership {$user->name} berhasil diaktifkan!");
}

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

    return back()->with('success', "Permintaan {$user->name} telah ditolak.");
}
    public function index()
    {
        $members = User::where('role', 'member')->latest()->get();
        return view('admin.members.index', compact('members'));
    }

    public function show(User $user)
    {
        $packages = MembershipPackage::where('is_active', true)->get();
        return view('admin.members.show', compact('user', 'packages'));
    }

    public function assignMembership(Request $request, User $user)
    {
        $request->validate([
            'membership_package_id' => 'required|exists:membership_packages,id',
        ]);

        $package = MembershipPackage::findOrFail($request->membership_package_id);

        $user->update([
            'membership_package_id' => $package->id,
            'membership_start_date' => now(),
            'membership_end_date'   => now()->addDays($package->duration_days),
            'membership_status'     => 'active',
        ]);

        return redirect()->route('admin.members.show', $user)
                         ->with('success', 'Membership berhasil di-assign!');
    }
}