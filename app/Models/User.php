<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guard_name = 'web';

    protected $fillable = [
        'name',
        'username', 
        'email',
        'password',
        'active',
        'activation_token',
        'phone',
        'age',
        'work',
        'address',
        'ktp',
        'ket_ktp',
        'status_ktp',
        'npwp',
        'nip',
        'nik',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function scopeByActivationColumns(Builder $builder, string $email, string $token): Builder
    {
        return $builder->where('email', $email)->where('activation_token', $token);
    }

    public function scopeByEmail(Builder $builder, string $email): Builder
    {
        return $builder->where('email', $email);
    }

    public function getPermissionListsAttribute(): ?array
    {
        return $this->permissions()->count() > 0 
            ? $this->permissions->pluck('id')->all() 
            : null;
    }

    public function getRoleIdAttribute(): ?array
    {
        return $this->roles()->count() > 0 
            ? $this->roles->pluck('id')->all() 
            : null;
    }

    public function ap()
    {
        return $this->hasMany(AdvancedPlaning::class, 'user_id');
    }

    public function tl()
    {
        return $this->hasMany(AdvancedPlaning::class, 'petugas_id');
    }

    public function tlkrk()
    {
        return $this->hasMany(Krk::class, 'petugas_id');
    }

    public function krk()
    {
        return $this->hasMany(Krk::class, 'user_id');
    }

    public function dokumens()
    {
        return $this->hasMany(Dokumen::class, 'user_id');
    }

    public function getKtpPathAttribute(): string
    {
        return $this->ktp 
            ? url('uploads/images/ktp/' . $this->ktp)
            : 'http://placehold.it/160x160';
    }
}
