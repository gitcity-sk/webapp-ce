<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Label;

class LabelsController extends Controller
{
    public function index()
    {
        return Label::all();
    }
}
