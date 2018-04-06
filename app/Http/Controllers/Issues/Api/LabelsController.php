<?php

namespace App\Http\Controllers\Issues\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Issue;
use App\Label;
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
     * @param Issue $issue
     * @return mixed
     */
    public function index(Issue $issue)
    {
        return LabelResource::collection($issue->labels);
    }

    /**
     * Create relationship between label and issue
     *
     * @param Issue $issue
     * @param int $id
     * @return mixed
     */
    public function store(Issue $issue, $id)
    {
        return $issue->addLabel($id);
    }

    /**
     * Deleting relationship between label and issue
     * @param Issue $issue
     * @param integer is
     * @return mixed
     */
    public function destroy(Issue $issue, $id)
    {
        return $issue->labels()->removeLabel($id);
    }
}
