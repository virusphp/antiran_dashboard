<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    protected $limit = 10;

    function __construct()
    {
        $this->middleware('auth:web');
    }
    
    protected function bcrum($current, $urlSecond = null, $nameSecond = null)
    {
        return [
            'url-first' => route('home'),
            'name-first' => 'Home',
            'url-second' => $urlSecond,
            'name-second' => $nameSecond,
            'current' => $current
        ];
    }
}
