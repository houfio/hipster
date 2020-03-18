<?php

namespace App\Providers;

use App\Subject;
use App\Teacher;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public const HOME = '/';

    public function boot()
    {
        parent::boot();

        Route::model('teacher', Teacher::class);
        Route::model('subject', Subject::class);
    }

    public function map()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }
}
