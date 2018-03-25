<?php

namespace App\Http\Controllers\Labels\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Label;
use App\Http\Resources\Label\ListResource;
use App\Http\Resources\Label\LabelResource;

class LabelsController extends Controller
{
    /**
     * LabelsController constructor
     */
    public function __construct()
    {
        $this->middleware(['auth', 'api']);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $labels = Label::all();

        // Formating output
        if (request()->has('format')) {
            if (request('format') == 'list') return ListResource::collection($labels);
        }

        return LabelResource::collection($labels);
    }
}
