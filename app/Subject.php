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
        return $this->belongsToMany(Teacher::class, 'subject_teachers', 'teacher_id');
    }
    
    public function exam()
    {
        return $this->hasOne(Exam::class, 'exam_id', 'id');
    }

    public function period()
    {
        return $this->belongsTo(Period::class, 'period', 'id');
    }
}
