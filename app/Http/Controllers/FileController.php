<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function downloadAssessment(string $file)
    {
        return Storage::download("assessments/$file");
    }
}
