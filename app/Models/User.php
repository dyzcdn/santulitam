<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use App\Models\UserRole;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFilamentAvatar(): ?string
    {
        return asset('storage/'.$this->avatar_url);
        // $avatar = $this->avatar_url;
        // $path_folder = 'storage/avatars/';
        // $path = $path_folder . $avatar;
        // return storage_path($path);
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return asset('storage/'.$this->avatar_url);
        // $avatar = $this->avatar_url;
        // $path_folder = 'storage/avatars/';
        // $path = $path_folder . $avatar;
        // return storage_path($path);
    }

    public function user_role()
    {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }

    public function canAccessCentral(Panel $panel): bool
    {
        return $this->user_role_id == 1;
    }
}
