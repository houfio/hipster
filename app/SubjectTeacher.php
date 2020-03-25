<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SubjectTeacher extends Pivot
{
    public $timestamps = true;

    protected $primaryKey = 'id';
    protected $table = 'subject_teachers';

    public function subject()
    {
        return $this->hasOne(Subject::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }
}
