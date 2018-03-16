<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Label;

class LabelsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return Label::all();
    }
}
