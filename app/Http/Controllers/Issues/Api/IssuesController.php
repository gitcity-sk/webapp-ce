<?php

namespace App\Http\Controllers\Issues\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Issue;

class IssuesController extends Controller
{
    /**
     *
     */
    public function close()
    {
        $issue = Issue::find(request('id'));

        $issue->update([
            'complete' => true
        ]);
    }

    /**
     *
     */
    public function reopen()
    {
        $issue = Issue::find(request('id'));

        $issue->update([
            'complete' => false
        ]);
    }
}
