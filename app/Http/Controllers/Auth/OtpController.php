<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    // Tampilkan form input OTP
    public function show()
    {
        return view('auth.verify-otp');
    }

    // Kirim ulang OTP
    public function resend(Request $request)
    {
        $user = User::find(session('otp_user_id'));

        if (!$user) {
            return redirect()->route('login');
        }

        $this->sendOtp($user);

        return back()->with('success', 'Kode OTP baru sudah dikirim ke email Anda!');
    }

    // Verifikasi OTP
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user = User::find(session('otp_user_id'));

        if (!$user) {
            return redirect()->route('login')->with('error', 'Session habis, silakan login ulang.');
        }

        // Cek apakah OTP expired
        if (now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kedaluwarsa. Minta kode baru.']);
        }

        // Cek apakah OTP benar
        if ($request->otp !== $user->otp_code) {
            return back()->withErrors(['otp' => 'Kode OTP salah!']);
        }

        // OTP benar — login user
        $user->update([
            'otp_verified' => true,
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        auth()->login($user);
        session()->forget('otp_user_id');

        // Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect('/admin/memberships');
        }

        return redirect('/dashboard');
    }

    // Helper: generate & kirim OTP
    public static function sendOtp(User $user)
    {
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
            'otp_verified' => false,
        ]);

        Mail::to($user->email)->send(new OtpMail($otp, $user->name));
    }
}