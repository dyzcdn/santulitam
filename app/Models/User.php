<?php

namespace App\Models;

use Filament\Panel;
// use Filament\Models\Contracts\HasTenants;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

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
        'email_verified_at',
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

    // public function roles()
    // {
    //     return $this->belongsTo(Role::class, 'role_id');
    // }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole(['Super Admin', 'Admin', 'Cofas', 'Cofas Mobile']);
    }
}
