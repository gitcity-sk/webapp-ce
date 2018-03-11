<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index()
    {
        return [
            'data' => json_decode(request()->getContent()),
            'headers' => [
                'app' => request()->header('APPLICAITON-KEY'),
                'secret' => request()->header('APPLICAITON-SECRET')
            ]
        ];
    }

    public function configure()
    {
        return request()->session()->get('key');
    }
}
