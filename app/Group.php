<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    protected $primaryKey = 'id';

    public function users()
    {
        return $this->hasMany(User::class, 'group_id', 'id');
    }

    public function period()
    {
        return $this->belongsTo(Period::class, 'period', 'id');
    }
}
