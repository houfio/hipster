<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = true;

    protected $table = 'roles';
    protected $primaryKey = 'id';
}
