<?php

namespace App\Http\Controllers\Spaces\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Space;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\File;

class FilesController extends Controller
{
    /**
     * @param Space $space
     * @param null $path
     * @return array
     */
    public function index(Space $space, $path = null)
    {
        $path == null ? $key = $space->slug . 'root-folder' : $key = $space->slug . $path;

        $filesData = Cache::remember($key, 10, function() use ($space, $path) {

            $files = [];
            $currentPath = str_finish('spaces/' . $space->slug . '/' . $path, '/');
            $filesRaw = Storage::files($currentPath);

            foreach ($filesRaw as $file) {
                $currentFile = new File(storage_path('app/'.$file));
                $files[] = [
                    'path' => $file,
                    'url' => Storage::url($file),
                    'name' => $currentFile->getBasename(),
                    'type' => $currentFile->getExtension(),
                    'size' => size_for_humans(Storage::size($file))
                ];
            }

            return $files;

        });

        return ['data' => $filesData];
    }
}
