<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\LabelsController as BaseController;
use App\Label;

class LabelsController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Database\Eloquent\Collection|\Illuminate\View\View|static[]
     */
    public function index()
    {
        $labels =  Label::all();

        return view('admin.labels.index', compact('labels'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.labels.create');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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
