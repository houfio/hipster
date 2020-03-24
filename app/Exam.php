<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public $timestamps = true;

    protected $table = 'exams';
    protected $primaryKey = 'id';

    protected $casts = [
        'grade' => 'float'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'exam_tags');
    }
}
