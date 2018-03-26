<?php

namespace App\Http\Controllers\Spaces\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Space;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Url;

class FilesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['cors', 'throttle:60,1']);
    }

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
                    'url' => Url::signedRoute('storage.file', ['filename' => $file]),
                    'name' => $currentFile->getBasename(),
                    'type' => $currentFile->getMimeType(),
                    'extension' => $currentFile->getExtension(),
                    'created_at' => Carbon::createFromTimestamp(Storage::lastModified($file)),
                    'size' => size_for_humans(Storage::size($file))
                ];
            }

            return $files;

        });

        if (request()->has('type')) $filesData = $this->_filter($filesData, request('type'));

        return ['data' => $filesData];
    }

    /**
     * @param null $filesData
     * @param null $type
     * @return array
     */
    protected function _filter($filesData, $type)
    {
        foreach ($filesData as $key => $file)
        {
            if ($file['extension'] != $type) unset($filesData[$key]);
        }

        return $filesData;
    }
}
