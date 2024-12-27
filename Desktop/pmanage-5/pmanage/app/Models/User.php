<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\HasTenants;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable implements FilamentUser, HasTenants
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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



    public function canAccessPanel(Panel $panel): bool
    {
       // return str_ends_with($this->email, '@yourdomain.com') && $this->hasVerifiedEmail();
       return true;
    }

    public function workspaces() {
        return $this->hasMany(Workspace::class, 'owner_id');
    }

    public function memberships() {
        return $this->belongsToMany(Workspace::class, 'user_work_space', 'user_id', 'work_space_id');
    }

    public function getTenants(Panel $panel): Collection
    {
        return $this->workspaces;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->memberships()->whereKey($tenant)->exists();
    }


}
