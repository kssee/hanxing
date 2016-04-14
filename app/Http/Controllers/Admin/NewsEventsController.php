<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Library\Notie;
	use App\Http\Requests;
	use App\Models\NewsEvents;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\File;
	use Intervention\Image\Facades\Image;

	class NewsEventsController extends Controller {
		public function __construct()
		{
			$this->middleware('permission:admin_news_events');
		}

		/**
		 * Display a listing of the resource.
		 *
		 * @return Response
		 */
		public function index(Request $request)
		{
			$validation = get_filter_bar_validation();
			$this->validate($request, $validation);

			$sortBy   = $request->mt;
			$orderBy  = $request->get('od', 'desc');
			$status   = $request->get('status');
			$category = $request->get('category');
			$st       = $request->get('st', 'exactly');
			$search   = $request->get('search');
			$from     = $request->get('from');
			$to       = $request->get('to');

			$sortColumns = ['a' => 'created_at', 'b' => 'title', 'c' => 'activity_date', 'd' => 'category'];
			$sortColumn  = find_soft_column($sortBy, $sortColumns, 'created_at');
			$from        = get_filter_date_from($from);
			$to          = get_filter_date_to($to);

			$page_subject = trans('custom.news_events_list_title');
			$add_route    = 'admin.ne.create';

			$query = NewsEvents::whereBetween('created_at', [$from->toDateTimeString(), $to->toDateTimeString()]);
			if($search != '')
			{
				$search_available_field = ['title', 'title_zh', 'cre_by'];
				search_to_query($query, $search, $search_available_field, $st);
			}
			else
			{
				if($status != '')
				{
					$query->where('published', $status);
				}

				if($category != '')
				{
					$query->where('category', $category);
				}
			}
			$result = $query->orderBy($sortColumn, $orderBy)->paginate(10);

			$paginate_appends = ['search'   => $search,
			                     'st'       => $st,
			                     'status'   => $status,
			                     'category' => $category,
			                     'from'     => $from->toDateString(),
			                     'to'       => $to->toDateString(),
			                     'mt'       => $sortBy,
			                     'od'       => $orderBy];

			$filter_list['items'] = [
				'status'   => ['list'     => [''  => 'All',
				                              '1' => trans('custom.published'),
				                              '0' => trans('custom.pending')],
				               'selected' => $status],
				'category' => ['list'     => [''      => 'All',
				                              'news'  => 'News',
				                              'event' => 'Event'],
				               'selected' => $category],
			];

			$filter_list['search'] = ['enable' => true, 'value' => $search, 'st' => $st];
			$filter_list['date']   = ['enable' => true, 'from' => $from->toDateString(), 'to' => $to->toDateString()];

			return view('admin.ne.index', compact('result', 'page_subject', 'add_route', 'paginate_appends', 'filter_list'));
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Response
		 */
		public function create()
		{
			$page_subject = trans('custom.news_events_add_title');
			$categoryArr  = $this->getCategory();

			return view('admin.ne.create', compact('page_subject', 'categoryArr'));
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  Request $request
		 *
		 * @return Response
		 */
		public function store(Request $request)
		{
			$request->merge(array_map('trim', $request->all()));
			$this->validate($request, [
				'title'         => 'required|max:255',
				'title_zh'      => 'required|max:255',
				'category'      => 'required|alpha',
				'highlight'     => 'max:255',
				'published'     => 'required|boolean',
				'activity_date' => 'date_format:Y-m-d',
				'image'         => 'mimes:jpeg,jpg,png,gif|max:1024',
				'page_content'  => 'required']);

			$slug = str_slug($request->title);
			if(empty($slug))
			{
				return redirect()->back()->withErrors(['title' => 'Invalid Title'])->withInput($request->all());
			}

			$news_event                = new NewsEvents();
			$news_event->slug          = $slug;
			$news_event->title         = $request->title;
			$news_event->title_zh      = $request->title_zh;
			$news_event->category      = $request->category;
			$news_event->highlight     = $request->highlight;
			$news_event->published     = $request->published;
			$news_event->activity_date = $request->activity_date;
			$news_event->page_content  = $request->page_content;
			$news_event->cre_by        = auth()->user()->name;
			$news_event->upd_by        = auth()->user()->name;

			if($request->has('image'))
			{
				$news_event->path_thumbnail = $this->save_image($request->file('image'));
			}

			$news_event->save();

			Notie::success();

			return redirect()->route('admin.ne.index');
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int $id
		 *
		 * @return Response
		 */
		public function edit($id)
		{
			$page_subject = trans('custom.news_events_edit_title');

			$result                  = NewsEvents::findOrFail($id);
			$result['activity_date'] = $result->activity_date->format('Y-m-d');
			$categoryArr             = $this->getCategory();

			return view('admin.ne.edit', compact('result', 'page_subject', 'categoryArr'));
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  Request $request
		 * @param  int $id
		 *
		 * @return Response
		 */
		public function update(Request $request, $id)
		{
			$request->merge(array_map('trim', $request->all()));
			$this->validate($request, [
				'title'         => 'required|max:255',
				'title_zh'      => 'required|max:255',
				'category'      => 'required|alpha',
				'highlight'     => 'max:255',
				'published'     => 'required|boolean',
				'activity_date' => 'date_format:Y-m-d',
				'image'         => 'mimes:jpeg,jpg,png,gif|max:1024',
				'page_content'  => 'required']);

			$slug = str_slug($request->title);
			if(empty($slug))
			{
				return redirect()->back()->withErrors(['title' => 'Invalid Title'])->withInput($request->all());
			}

			$news_event                = NewsEvents::findOrFail($id);
			$news_event->slug          = $slug;
			$news_event->title         = $request->title;
			$news_event->title_zh      = $request->title_zh;
			$news_event->category      = $request->category;
			$news_event->highlight     = $request->highlight;
			$news_event->published     = $request->published;
			$news_event->activity_date = $request->activity_date;
			$news_event->page_content  = $request->page_content;
			$news_event->upd_by        = auth()->user()->name;

			if($request->has('image'))
			{
				File::delete($news_event->path_thumbnail);
				$news_event->path_thumbnail = $this->save_image($request->file('image'));
			}

			$news_event->save();

			Notie::success('Updated');

			return redirect()->route('admin.ne.index');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 *
		 * @return Response
		 */
		public function destroy($id)
		{
			$page = Pages::findOrFail($id);
			File::delete($page->path_thumbnail);
			$page->delete();

			Notie::success('Deleted');

			return redirect()->route('admin.ne.index');
		}

		private function getCategory()
		{
			$data = [
				'news'  => 'News',
				'event' => 'Event',
			];

			return $data;
		}

		private function save_image($image)
		{
			$timestamp   = time();
			$path        = env('NEWS_IMAGE_PATH');
			$img_dt_name = $timestamp . '-' . $image->getClientOriginalName();
			$image_path  = $path . '/' . $img_dt_name;

			$image->move($path, $img_dt_name);
			Image::make($image_path)->fit(env('NEWS_IMAGE_WIDTH'), env('NEWS_IMAGE_HEIGHT'))->save();

			return $image_path;
		}
	}
