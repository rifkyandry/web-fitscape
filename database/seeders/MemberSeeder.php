<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/members.json');

        if (!file_exists($path)) {
            $this->command->warn('members.json tidak ditemukan, seeder dilewati.');
            return;
        }

        $members = json_decode(file_get_contents($path), true);

        foreach ($members as $member) {
            // Ubah format tanggal ISO (2026-10-16T01:45:00.000000Z) ke format MySQL
            foreach ($member as $key => $value) {
                if (str_ends_with($key, '_at') && $value !== null) {
                    $member[$key] = Carbon::parse($value)->format('Y-m-d H:i:s');
                }
            }

            // updateOrInsert: aman dijalankan berkali-kali, tidak bikin data dobel
            DB::table('users')->updateOrInsert(
                ['email' => $member['email']],
                $member
            );
        }
    }
}