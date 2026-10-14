<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Presence;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Mode filter: range atau bulan
        $filterMode = $request->get('filter_mode', 'month');

        if ($filterMode === 'range') {
            $dateFrom = $request->get('date_from', now()->startOfMonth()->format('Y-m-d'));
            $dateTo   = $request->get('date_to', now()->format('Y-m-d'));
            $month    = null;
            $year     = null;
        } else {
            $month    = $request->get('month', now()->month);
            $year     = $request->get('year', now()->year);
            $dateFrom = Carbon::create($year, $month, 1)->startOfMonth()->format('Y-m-d');
            $dateTo   = Carbon::create($year, $month, 1)->endOfMonth()->format('Y-m-d');
        }

        $presences = Presence::with('user')
            ->whereBetween('check_in_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->orderBy('check_in_at', 'desc')
            ->get();

        $chartData = Presence::selectRaw('DATE(check_in_at) as date_label, COUNT(*) as total')
            ->whereBetween('check_in_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->groupBy('date_label')
            ->orderBy('date_label')
            ->get();

        $totalMembers   = User::where('role', 'member')->count();
        $totalPresences = $presences->count();

        $topMember = Presence::with('user')
            ->selectRaw('user_id, COUNT(*) as total')
            ->whereBetween('check_in_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->groupBy('user_id')
            ->orderBy('total', 'desc')
            ->first();

        return view('admin.reports.index', compact(
            'presences', 'chartData', 'month', 'year',
            'totalMembers', 'totalPresences', 'topMember',
            'filterMode', 'dateFrom', 'dateTo'
        ));
    }

    public function exportPdf(Request $request)
{
    $filterMode = $request->get('filter_mode', 'month');

    if ($filterMode === 'range') {
        $dateFrom    = $request->get('date_from', now()->startOfMonth()->format('Y-m-d'));
        $dateTo      = $request->get('date_to', now()->format('Y-m-d'));
        $periodLabel = \Carbon\Carbon::parse($dateFrom)->format('d M Y')
                     . ' sd ' . \Carbon\Carbon::parse($dateTo)->format('d M Y');
    } else {
        $month       = $request->get('month', now()->month);
        $year        = $request->get('year', now()->year);
        $dateFrom    = \Carbon\Carbon::create($year, $month, 1)->startOfMonth()->format('Y-m-d');
        $dateTo      = \Carbon\Carbon::create($year, $month, 1)->endOfMonth()->format('Y-m-d');
        $periodLabel = \Carbon\Carbon::create()->month($month)->format('F') . ' ' . $year;
    }

    $presences = Presence::with('user')
        ->whereBetween('check_in_at', [
            $dateFrom . ' 00:00:00',
            $dateTo   . ' 23:59:59'
        ])
        ->orderBy('check_in_at', 'desc')
        ->get();

    $totalPresences = $presences->count();
    $totalMembers   = User::where('role', 'member')->count();

    $topMember = Presence::with('user')
        ->selectRaw('user_id, COUNT(*) as total')
        ->whereBetween('check_in_at', [
            $dateFrom . ' 00:00:00',
            $dateTo   . ' 23:59:59'
        ])
        ->groupBy('user_id')
        ->orderBy('total', 'desc')
        ->first();

    $pdf = Pdf::loadView('admin.reports.pdf', compact(
        'presences', 'totalPresences', 'totalMembers',
        'periodLabel', 'topMember', 'dateFrom', 'dateTo'
    ))->setPaper('a4', 'portrait');

    $safeLabel = str_replace([' ', '/'], '-', $periodLabel);
    return $pdf->download("laporan-absensi-{$safeLabel}.pdf");
}
}