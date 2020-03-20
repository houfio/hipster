<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $timestamps = true;

    protected $table = 'subjects';
    protected $primaryKey = 'id';

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teachers', 'subject_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class, 'period', 'id');
    }
}
