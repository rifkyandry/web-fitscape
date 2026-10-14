<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MembershipPackage;

class MembershipPackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'name'         => 'Bronze',
                'description'  => 'Akses gym standar, cocok untuk pemula',
                'price'        => 150000,
                'duration_days'=> 30,
                'color'        => '#CD7F32',
                'is_active'    => true,
            ],
            [
                'name'         => 'Silver',
                'description'  => 'Akses gym + kelas grup semua jadwal',
                'price'        => 300000,
                'duration_days'=> 90,
                'color'        => '#C0C0C0',
                'is_active'    => true,
            ],
            [
                'name'         => 'Gold',
                'description'  => 'Akses penuh + sesi personal trainer',
                'price'        => 500000,
                'duration_days'=> 180,
                'color'        => '#FFD700',
                'is_active'    => true,
            ],
        ];

        foreach ($packages as $package) {
            MembershipPackage::create($package);
        }
    }
}