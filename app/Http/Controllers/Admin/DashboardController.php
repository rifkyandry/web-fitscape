<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Presence;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers    = User::where('role', 'member')->count();
        $activeMembers   = User::where('role', 'member')->where('membership_status', 'active')->count();
        $pendingMembers  = User::where('role', 'member')->where('membership_status', 'pending')->count();
        $todayPresences  = Presence::whereDate('check_in_at', today())->count();

        $expiringMembers = User::where('role', 'member')
            ->where('membership_status', 'active')
            ->whereNotNull('membership_end_date')
            ->whereBetween('membership_end_date', [now(), now()->addDays(7)])
            ->count();

        $pendingList = User::where('role', 'member')
            ->where('membership_status', 'pending')
            ->with('pendingPackage')
            ->latest()
            ->take(5)
            ->get();

        $recentPresences = Presence::with('user')
            ->whereDate('check_in_at', today())
            ->latest('check_in_at')
            ->take(10)
            ->get();

        $expiringList = User::where('role', 'member')
            ->where('membership_status', 'active')
            ->whereNotNull('membership_end_date')
            ->whereBetween('membership_end_date', [now(), now()->addDays(7)])
            ->get();

        return view('admin.dashboard', compact(
            'totalMembers', 'activeMembers', 'pendingMembers',
            'todayPresences', 'expiringMembers',
            'pendingList', 'recentPresences', 'expiringList'
        ));
    }
}