<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PragmaRX\Google2FA\Google2FA; // Import library Google2FA

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'name',
    'email',
    'password',
    'role',
    'member_id',
    'totp_secret',
    'phone',
    'birth_date',
    'membership_status',
    'membership_start_date',
    'membership_end_date',
    'membership_package_id',
    'otp_code',
    'otp_expires_at',
    'otp_verified',
    'photo',
    'pending_package_id',
    'pending_duration_months',

    ];

    /**
     * Atribut yang disembunyikan saat serialisasi (API/JSON).
     */
    protected $hidden = [
        'password',
        'remember_token',
        'totp_secret', // Disembunyikan demi keamanan agar tidak sembarang tampil di API
    ];

    /**
     * Atribut yang harus dikonversi ke tipe data tertentu.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Boot method untuk auto-generate data saat user dibuat.
     */
    protected static function booted()
    {
    static::creating(function ($user) {
        // Hanya jalankan untuk role member
        if (isset($user->role) && $user->role === 'admin') {
            return; // Skip, jangan timpa data admin
        }

        // 1. Set default role
        $user->role = 'member';

        // 2. Generate member_id
        $lastMember = self::whereNotNull('member_id')
            ->where('member_id', 'like', 'FS-%')
            ->orderBy('member_id', 'desc')
            ->first();

        $newNumber = $lastMember
            ? (int) substr($lastMember->member_id, 3) + 1
            : 1;

        $user->member_id = 'FS-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        // 3. Generate TOTP Secret
        $google2fa = new \PragmaRX\Google2FA\Google2FA();
        $user->totp_secret = $google2fa->generateSecretKey();
    });
    }
// Relasi ke paket yang sedang dipending
    public function pendingPackage()
{
    return $this->belongsTo(MembershipPackage::class, 'pending_package_id');
}
    // Relasi ke paket membership
public function membershipPackage()
{

    return $this->belongsTo(MembershipPackage::class, 'membership_package_id');
}

// Cek apakah membership aktif
public function isMembershipActive(): bool
{
    return $this->membership_status === 'active' 
        && $this->membership_end_date >= now()->toDateString();
}

// Sisa hari membership
public function remainingDays(): int
{
    if (!$this->isMembershipActive()) return 0;
    return (int) now()->diffInDays($this->membership_end_date);
}

public function notifications_member()
{
    return $this->hasMany(MemberNotification::class);
}

public function unreadNotifications()
{
    return $this->hasMany(MemberNotification::class)->where('is_read', false);
}
}
