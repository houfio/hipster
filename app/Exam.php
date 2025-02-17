<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Exam extends Model
{
    public $timestamps = true;

    protected $table = 'exams';
    protected $primaryKey = 'id';

    protected $casts = [
        'grade' => 'float',
        'due_on' => 'datetime'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'exam_tags');
    }

    public function passed(): bool
    {
        return $this->grade >= 5.5;
    }

    public function formattedDueOn(): string
    {
        return Carbon::parse($this->due_on)->format('Y-m-d\TH:i');
    }

    public function isOverdue(): bool
    {
        return !$this->finished && $this->due_on->isPast();
    }
}
