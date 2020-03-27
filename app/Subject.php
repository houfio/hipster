<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $timestamps = true;

    protected $table = 'subjects';
    protected $primaryKey = 'id';

    protected $casts = [
        'credits' => 'float'
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

    public function graded(): bool
    {
        return $this->exams->count() > 0 && $this->exams->where('grade', '==', null)->count() === 0;
    }

    public function passed(): bool
    {
        if (!$this->graded())
        {
            return false;
        }

        return $this->exams()->min('grade') >= 5.5;
    }
}
