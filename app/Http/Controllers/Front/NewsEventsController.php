<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NewsEventsController extends Controller
{
    public function index($type)
    {
        $subject = ucfirst($type);
	    return view('front.newsEvents',compact('subject'));
    }
}
