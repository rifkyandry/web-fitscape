<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\MembershipExpiryMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CheckMembershipExpiry extends Command
{
    protected $signature   = 'membership:check-expiry';
    protected $description = 'Cek expired dan kirim notifikasi email H-3 & H-5';

    public function handle()
    {
        // 1. Auto-expired membership yang sudah lewat
        $expired = User::where('role', 'member')
            ->where('membership_status', 'active')
            ->whereNotNull('membership_end_date')
            ->whereDate('membership_end_date', '<', Carbon::today())
            ->get();

        foreach ($expired as $member) {
            $member->update(['membership_status' => 'expired']);
            $this->info("Expired: {$member->name}");
        }

        // 2. Kirim notifikasi H-3 dan H-5
        $notifyDays = [3, 5];

        foreach ($notifyDays as $days) {
            $members = User::where('role', 'member')
                ->where('membership_status', 'active')
                ->whereNotNull('membership_end_date')
                ->whereDate('membership_end_date', Carbon::today()->addDays($days))
                ->get();

            foreach ($members as $member) {
                Mail::to($member->email)->send(new MembershipExpiryMail($member, $days));
                $this->info("Email H-{$days} dikirim ke: {$member->email}");
            }
        }

        $this->info("Selesai. Expired: {$expired->count()} member.");
        return 0;
    }
}