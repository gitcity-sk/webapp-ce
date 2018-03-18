<?php

namespace App\Http\Controllers\Spaces\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Space;
use Illuminate\Support\Facades\Storage;

class DirectoriesController extends Controller
{
    /**
     * @param Space $space
     * @param null $path
     * @return array
     */
    public function index(Space $space, $path = null)
    {
        $directories = [];
        $currentPath = str_finish('spaces/' . $space->slug . '/' . $path, '/');

        $directoriesRaw = Storage::directories($currentPath);

        foreach ($directoriesRaw as $directory) {
            $directories[] = [
                'name' => basename($directory),
                'path' => $directory
            ];
        }

        return ['data' => $directories];
    }
}
