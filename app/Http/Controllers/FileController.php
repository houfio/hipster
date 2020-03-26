<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:download-files');
    }

    public function downloadAssessment(string $file)
    {
        return Storage::download("assessments/$file");
    }
}
