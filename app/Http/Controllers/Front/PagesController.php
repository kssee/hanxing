<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function index($slug)
    {
	    if($slug == 'about')
	    {
		    return view('front.pages');
	    }
	    else
	    {
		    return view('front.pages2');
	    }

    }

}
