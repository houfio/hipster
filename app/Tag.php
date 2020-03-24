<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = true;

    protected $table = 'tags';
    protected $primaryKey = 'id';

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_tags');
    }
}
