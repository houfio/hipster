<?php

namespace App;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use Encryptable;

    public $timestamps = true;

    protected $table = 'teachers';
    protected $primaryKey = 'id';

    protected $encryptable = [
        'first_name',
        'last_name',
        'abbreviation'
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teachers', 'teacher_id');
    }
}
