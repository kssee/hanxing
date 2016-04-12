<?php

	namespace App\Http\Controllers\Front;

	use App\Http\Controllers\Controller;
	use App\Http\Requests;
	use App\Models\Banners;
	use App\Models\NewsEvents;
	use App\Models\Pages;
	use Carbon\Carbon;

	class IndexController extends Controller {
		public function index()
		{
			$banners = Banners::where('published', 1)->orderBy('created_at', 'DESC')->limit(5)->get();

			// Programmes bar
			$programmes        = Pages::where('category', 'programmes')->where('published', 1)->orderBy('title')->get();
			$programmesList[0] = [
				'title'   => trans('custom.apply_now'),
				'slug'    => 'onlineRegister',
				'special' => true,
			];

			foreach($programmes as $entry)
			{
				$programmesList[] = [
					'title'          => $entry->title,
					'title_zh'       => $entry->title_zh,
					'slug'           => $entry->slug,
					'highlight'      => $entry->highlight,
					'path_thumbnail' => $entry->path_thumbnail,
				];
			}
			$programmesList = collect($programmesList);

			// Others bar
			$why_hanxing  = Pages::where('slug', 'why-hanxing')->where('published', 1)->first();
			$scholarships = Pages::where('slug', 'scholarships-study-loan-ptptn')->where('published', 1)->first();
			$campus_life  = Pages::where('slug', 'campus-life')->where('published', 1)->first();
			if( ! is_null($why_hanxing))
			{
				$othersList[] = [
					'title'          => trans('custom.why_choose_us'),
					'title_zh'       => trans('custom.why_choose_us'),
					'slug'           => 'why-hanxing',
					'highlight'      => '',
					'txt'            => trans('custom.our_reputation'),
					'path_thumbnail' => $why_hanxing->path_thumbnail,
				];
			}

			if( ! is_null($scholarships))
			{
				$othersList[] = [
					'title'          => trans('custom.scholarship'),
					'title_zh'       => trans('custom.scholarship'),
					'slug'           => 'scholarships-study-loan-ptptn',
					'highlight'      => '',
					'txt'            => trans('custom.let_us_help'),
					'path_thumbnail' => $scholarships->path_thumbnail,
				];
			}

			if( ! is_null($campus_life))
			{
				$othersList[] = [
					'title'          => trans('custom.campus_life'),
					'title_zh'       => trans('custom.campus_life'),
					'slug'           => 'campus-life',
					'highlight'      => '',
					'txt'            => trans('custom.live_with_us'),
					'path_thumbnail' => $campus_life->path_thumbnail,
				];
			}

			$othersList[] = [
				'special' => true,
			];

			// news events bar
			$latest_news = NewsEvents::where('category', 'news')->where('published', 1)->orderBy('activity_date', 'desc')->first();
			if( ! is_null($latest_news))
			{
				$news = NewsEvents::where('category', 'news')
				                  ->where('id', '<>', $latest_news->id)
				                  ->where('published', 1)
				                  ->orderBy('activity_date', 'desc')
				                  ->limit(2)
				                  ->get();
			}

			$events = NewsEvents::where('category', 'event')
			                    ->where('published', 1)
			                    ->where('activity_date', '>=', Carbon::now()->toDateString())
			                    ->orderBy('activity_date')
			                    ->limit(2)
			                    ->get();

			return view('front.index', compact('banners', 'programmesList', 'othersList', 'latest_news', 'news', 'events'));
		}

		public function language($lg)
		{
			session(['lg' => $lg]);

			return redirect()->back();
		}
	}
