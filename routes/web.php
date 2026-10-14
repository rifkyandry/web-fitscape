<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\ScanController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\OtpController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SiteSettingController;

Route::get('/', function () {
    return view('welcome');
});

// Route Member
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [MemberController::class, 'index'])->name('dashboard');
    Route::post('/membership/request', [MemberController::class, 'requestMembership'])->name('membership.request');
    Route::post('/membership/cancel', [MemberController::class, 'cancelRequest'])->name('membership.cancel');
});

// Route Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

// Route Admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.admin');
    Route::resource('memberships', MembershipController::class);
    Route::get('members', [AdminMemberController::class, 'index'])->name('members.index');
    Route::get('members/{user}', [AdminMemberController::class, 'show'])->name('members.show');
    Route::post('members/{user}/assign', [AdminMemberController::class, 'assignMembership'])->name('members.assign');
    Route::post('members/{user}/confirm', [AdminMemberController::class, 'confirmMembership'])->name('members.confirm');
    Route::post('members/{user}/reject', [AdminMemberController::class, 'rejectMembership'])->name('members.reject');
    Route::get('scan', [ScanController::class, 'index'])->name('scan.index');
    Route::post('scan/verify', [ScanController::class, 'verify'])->name('scan.verify');
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.export-pdf');
    Route::get('profile', [AdminProfileController::class, 'index'])->name('profile.admin');
    Route::get('settings', [SiteSettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SiteSettingController::class, 'update'])->name('settings.update');
});

// OTP Verification
Route::middleware('guest')->group(function () {
    Route::get('otp/verify', [OtpController::class, 'show'])->name('otp.show');
    Route::post('otp/verify', [OtpController::class, 'verify'])->name('otp.verify');
    Route::get('otp/resend', [OtpController::class, 'resend'])->name('otp.resend');
});
Route::get('/api/absensi-status', [MemberController::class, 'absensiStatus'])
    ->middleware(['auth', 'verified'])
    ->name('absensi.status');

require __DIR__.'/auth.php';