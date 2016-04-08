<?php

	namespace App\Http\Controllers\Front;

	use App\Http\Controllers\Controller;
	use App\Http\Requests;
	use App\Models\NewsEvents;
	use Carbon\Carbon;
	use Illuminate\Http\Request;

	class NewsEventsController extends Controller {
		public function news()
		{
			$result = NewsEvents::where('category', 'news')
			                    ->where('published', 1)
			                    ->orderBy('activity_date', 'desc')
			                    ->paginate(16);

			$type    = 'news';

			$breadcrumb_overwrite['link'][] = [trans('custom.home') => route('index')];
			$breadcrumb_overwrite['active'] = trans('custom.news');

			return view('front.newsEvents', compact('result', 'subject', 'breadcrumb_overwrite', 'type'));
		}

		public function events(Request $request)
		{
			$past = $request->get('past', '0');

			$query = NewsEvents::where('category', 'event')->where('published', 1);

			if($past == '1')
			{
				$query->where('activity_date', '<', Carbon::now()->toDateString())->orderBy('activity_date', 'desc');
			}
			else
			{
				$query->where('activity_date', '>=', Carbon::now()->toDateString())->orderBy('activity_date', 'asc');
			}

			$result           = $query->paginate(10);
			$paginate_appends = ['past' => $past];
			$type             = 'events';

			$breadcrumb_overwrite['link'][] = [trans('custom.home') => route('index')];
			$breadcrumb_overwrite['active'] = trans('custom.events');

			return view('front.newsEvents', compact('result', 'subject', 'paginate_appends', 'breadcrumb_overwrite', 'type','past'));
		}

		public function viewNews($slug)
		{
			$result = NewsEvents::where('category', 'news')
			                    ->where('published', 1)
			                    ->where('slug', $slug)
			                    ->first();

			$breadcrumb_overwrite['link'][] = [trans('custom.home') => route('index')];
			$breadcrumb_overwrite['link'][] = [trans('custom.news') => route('news')];
			$breadcrumb_overwrite['active'] = $result->title;

			return view('front.newsEventsView', compact('result', 'breadcrumb_overwrite'));
		}

		public function viewEvent($slug)
		{
			$result = NewsEvents::where('category', 'event')
			                    ->where('published', 1)
			                    ->where('slug', $slug)
			                    ->first();

			$breadcrumb_overwrite['link'][] = [trans('custom.home') => route('index')];
			$breadcrumb_overwrite['link'][] = [trans('custom.events') => route('events')];
			$breadcrumb_overwrite['active'] = $result->title;

			return view('front.newsEventsView', compact('result', 'breadcrumb_overwrite'));
		}
	}
