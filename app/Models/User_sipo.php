<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User_sipo extends Authenticatable
{
    use Notifiable, HasRoles;
    protected $guard_name = 'web'; // or whatever guard you want to use
    protected $table = 'users_sipo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'active', 'activation_token', 'phone', 'age', 'work', 'address', 'ktp', 'ket_ktp', 'status_ktp'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeByActivationColumns(Builder $builder, $email, $token)
    {
        return $builder->where('email', $email)->where('activation_token', $token);
    }

    public function scopeByEmail(Builder $builder, $email)
    {
        return $builder->where('email', $email);
    }

    public function getPermissionListsAttribute()
    {
        if ($this->permissions()->count() < 1) {
            return null;
        }
        return $this->permissions->pluck('id')->all();
    }

    public function getRoleIdAttribute()
    {
        if ($this->roles()->count() < 1) {
            return null;
        }
        return $this->roles->pluck('id')->all();
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
    public function getKtpPathAttribute()
    {
        //$ukuran = Template::first();
        if ($this->ktp == '') {
            return 'http://placehold.it/160x160';
        } else {
            return url('uploads/images/ktp/' . $this->ktp);
        }
    }
}
