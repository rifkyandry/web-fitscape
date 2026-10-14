<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'gym_name',        'label' => 'Nama Gym',          'group' => 'general',  'value' => 'Fitscape Studio'],
            ['key' => 'gym_tagline',     'label' => 'Tagline',           'group' => 'general',  'value' => 'Premium Gym Membership'],
            ['key' => 'gym_description', 'label' => 'Deskripsi Singkat', 'group' => 'general',  'value' => 'Fitscape Studio adalah pusat kebugaran premium yang menghadirkan pengalaman latihan modern dengan sistem absensi digital berbasis QR Code dinamis.'],

            // Kontak
            ['key' => 'gym_address',     'label' => 'Alamat Lengkap',    'group' => 'contact',  'value' => 'Jl. Nama Jalan No. XX, Kelurahan, Kecamatan, Kota, Provinsi'],
            ['key' => 'gym_phone',       'label' => 'Nomor WhatsApp',    'group' => 'contact',  'value' => '628XXXXXXXXXX'],
            ['key' => 'gym_email',       'label' => 'Email',             'group' => 'contact',  'value' => 'fitscapestudio@gmail.com'],
            ['key' => 'gym_instagram',   'label' => 'Username Instagram', 'group' => 'contact', 'value' => 'fitscapestudio'],
            ['key' => 'gym_maps_url',    'label' => 'Link Google Maps',  'group' => 'contact',  'value' => 'https://maps.google.com/?q=Fitscape+Studio'],

            // Jam Operasional
            ['key' => 'hours_weekday',   'label' => 'Jam Senin-Jumat',   'group' => 'hours',    'value' => '05:00 — 23:00'],
            ['key' => 'hours_saturday',  'label' => 'Jam Sabtu',         'group' => 'hours',    'value' => '06:00 — 22:00'],
            ['key' => 'hours_sunday',    'label' => 'Jam Minggu & Libur', 'group' => 'hours',   'value' => '06:00 — 21:00'],

            // Footer
            ['key' => 'footer_copyright', 'label' => 'Teks Copyright',  'group' => 'footer',   'value' => '© 2026 Fitscape Studio. All rights reserved.'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}