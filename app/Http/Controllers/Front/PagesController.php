<?php

	namespace App\Http\Controllers\Front;

	use App\Http\Controllers\Controller;
	use App\Http\Requests;
	use App\Models\Pages;

	class PagesController extends Controller {
		public function index($slug)
		{
			$page = Pages::where('slug', $slug)->where('published', '1')->firstOrFail();

			if( ! is_null($page->child_page_id) && ! empty($page->child_page_id))
			{
				$child_id    = explode(',', $page->child_page_id);
				$child_pages = Pages::where('published', '1')->whereIn('id', $child_id)->orderBy('title')->get();
			}

			return view('front.pages', compact('page', 'child_pages'));
		}

	}
