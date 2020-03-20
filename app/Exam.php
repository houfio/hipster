<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public $timestamps = true;

    protected $table = 'exams';
    protected $primaryKey = 'id';

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
