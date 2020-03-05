<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $table = 'periods';
    protected $primaryKey = 'id';

    public function groups()
    {
        return $this->hasMany(Group::class, 'period', 'id');
    }
}
