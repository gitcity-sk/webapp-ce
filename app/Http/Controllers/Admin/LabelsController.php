<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\LabelsController as BaseController;
use App\Label;

class LabelsController extends BaseController
{
    public function index()
    {
        $labels =  Label::all();

        return view('admin.labels.index', compact('labels'));
    }

    public function create()
    {
        return view('admin.labels.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required|min:2',
            'color' => 'required'
        ]);

        Label::create([
            'title' => request('title'),
            'color' => request('color'),
            'description' => request('description')
        ]);

        return redirect('/admin/labels');
    }
}
