<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function downloadAssessment(string $file)
    {
        Gate::authorize('can-download-files');
        return Storage::download("assessments/$file");
    }
}
