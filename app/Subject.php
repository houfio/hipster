<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $timestamps = true;

    protected $table = 'subjects';
    protected $primaryKey = 'id';

    protected $casts = [
        'credits' => 'int'
    ];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teachers')->withPivot('is_coordinator');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
