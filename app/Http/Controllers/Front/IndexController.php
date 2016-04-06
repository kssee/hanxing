<?php

namespace App\Http\Controllers\Front;

use App\Models\Banners;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $banners = Banners::where('published',1)->orderBy('created_at','DESC')->get();
	    return view('front.index',compact('banners'));
    }
}
