<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class MembershipExpiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $member;
    public int $daysLeft;

    public function __construct(User $member, int $daysLeft)
    {
        $this->member   = $member;
        $this->daysLeft = $daysLeft;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "⚠️ Membership Anda akan habis dalam {$this->daysLeft} hari — Fitscape Studio",
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.membership-expiry');
    }
}