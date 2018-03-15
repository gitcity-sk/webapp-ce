<?php

namespace App\Http\Controllers\Spaces\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Space;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\File;

class SpacesController extends Controller
{
    protected $totalSpaceSize = 0;

    /**
     * Return size for space
     */
    public function getSize(Space $space)
    {
        // remember into cache
        $size = Cache::remember($space->slug, 10, function() use ($space) {
            //get size for all files
            $files =  Storage::allFiles('spaces/' . $space->slug);
            foreach ($files as $file)
            {
                $this->totalSpaceSize += Storage::size($file);
            }
            
            return ['data' => [
                'size' => $this->totalSpaceSize,
                'human_readable_size' => size_for_humans($this->totalSpaceSize)
            ]];
        });

        return $size;
    }

    public function files(Space $space, $path = null)
    {
        $files = [];
        $currentPath = str_finish('spaces/' . $space->slug . '/' . $path, '/');
        $filesRaw = Storage::files($currentPath);

        foreach ($filesRaw as $file) {
            $currentFile = new File(storage_path('app/'.$file));
            $files[] = [
                'path' => $file,
                'name' => $currentFile->getBasename(),
                'type' => $currentFile->getExtension(),
                'size' => size_for_humans(Storage::size($file))
            ];
        }

        return ['data' => $files];
    }

    public function directories(Space $space, $path = null)
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

        return ['data' => [
            'directories' => $directories
        ]];
    }
}
