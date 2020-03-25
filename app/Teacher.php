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

    protected array $encryptable = [
        'first_name',
        'last_name',
        'email',
        'abbreviation'
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teachers')->withPivot('is_coordinator');
    }
}
