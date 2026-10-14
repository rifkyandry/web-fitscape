<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable  // ← hanya SATU class ini
{
    use Queueable, SerializesModels;

    public string $otpCode;
    public string $memberName;

    public function __construct(string $otpCode, string $memberName)
    {
        $this->otpCode = $otpCode;
        $this->memberName = $memberName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kode OTP Login Fitscape Studio',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.otp',  // ← pastikan file ini ada
        );
    }
}