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

    protected $encryptable = [
        'first_name',
        'last_name'
    ];

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'user_exams', 'exam_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function authorize(string $role)
    {
        return $this->role->name === $role || abort(401, 'This action is unauthorized.');
    }
}
