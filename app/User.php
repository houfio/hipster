<?php

namespace App;

use App\Traits\Encryptable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, Encryptable;

    public $timestamps = true;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected array $encryptable = [
        'first_name',
        'email',
        'last_name'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin(): bool
    {
        return $this->role->name === 'admin';
    }

    public function isManager(): bool
    {
        return $this->role->name === 'manager';
    }
}
