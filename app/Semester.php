<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semesters';
    protected $primaryKey = 'semester';

    public function periods()
    {
        return $this->hasMany(Period::class, 'semester', 'semester');
    }
}
