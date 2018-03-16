<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Label;
use App\Traits\RequireAuthenticationTrait;

class LabelsController extends Controller
{   
    use RequireAuthenticationTrait;
    
    public function index()
    {
        return Label::all();
    }
}
