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
        $size = Cache::remember('space-size-for' . $space->slug, 10, function() use ($space) {
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

    /**
     * Return size for space
     */
    public function sizeOf($path)
    {
        // remember into cache
        $size = Cache::remember($path, 10, function() use ($path) {
            //get size for all files
            $files =  Storage::allFiles($path);
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

}
