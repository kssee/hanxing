<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Library\Notie;
	use App\Http\Requests;
	use App\Models\Pages;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\File;
	use Intervention\Image\Facades\Image;

	class PagesController extends Controller {
		/**
		 * PagesController constructor.
		 */
		public function __construct()
		{
			$this->middleware('permission:admin_pages');
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

			$sortBy  = $request->mt;
			$orderBy = $request->get('od', 'desc');
			$status  = $request->get('status');
			$st      = $request->get('st', 'exactly');
			$search  = $request->get('search');
			$from    = $request->get('from');
			$to      = $request->get('to');

			$sortColumns = ['a' => 'created_at', 'b' => 'title'];
			$sortColumn  = find_soft_column($sortBy, $sortColumns, 'created_at');
			$from        = get_filter_date_from($from);
			$to          = get_filter_date_to($to);

			$page_subject = trans('custom.page_list_title');
			$add_route    = 'admin.page.create';

			$query = Pages::whereBetween('created_at', [$from->toDateTimeString(), $to->toDateTimeString()]);
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
			}
			$result = $query->orderBy($sortColumn, $orderBy)->paginate(30);

			$paginate_appends = ['search' => $search,
			                     'st'     => $st,
			                     'status' => $status,
			                     'from'   => $from->toDateString(),
			                     'to'     => $to->toDateString(),
			                     'mt'     => $sortBy,
			                     'od'     => $orderBy];

			$filter_list['items'] = [
				'status' => ['list'     => [''  => 'All',
				                            '1' => trans('custom.published'),
				                            '0' => trans('custom.pending')],
				             'selected' => $status],
			];

			$filter_list['search'] = ['enable' => true, 'value' => $search, 'st' => $st];
			$filter_list['date']   = ['enable' => true, 'from' => $from->toDateString(), 'to' => $to->toDateString()];

			return view('admin.pages.index', compact('result', 'page_subject', 'add_route', 'paginate_appends', 'filter_list'));
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Response
		 */
		public function create()
		{
			$page_subject    = trans('custom.page_add_title');
			$categoryArr     = $this->getCategory();
			$childDisplayArr = $this->getCategory('child');
			$pagesArr        = Pages::lists('title', 'id');
			$pagesArr->put('0', '-- None --');

			return view('admin.pages.create', compact('page_subject', 'categoryArr', 'childDisplayArr', 'pagesArr'));
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
			$request->merge(array_map('trim', $request->except('child_page_id')));
			$this->validate($request, ['title'                  => 'required|max:255',
			                           'title_zh'               => 'required|max:255',
			                           'category'               => 'required|alpha',
			                           'highlight'              => 'max:255',
			                           'popup_title'            => 'max:20|min:3',
			                           'popup_title_zh'         => 'max:10|min:3',
			                           'published'              => 'required|boolean',
			                           'image'                  => 'mimes:jpeg,jpg,png,gif|max:1024',
			                           'thumbnail'              => 'mimes:jpeg,jpg,png,gif|max:1024',
			                           'child_page_id'          => 'array',
			                           'child_display_category' => 'in:0,1,2,3',
			                           'page_content'           => 'required']);

			$page                         = new Pages();
			$page->slug                   = str_slug($request->title);
			$page->title                  = $request->title;
			$page->title_zh               = $request->title_zh;
			$page->highlight              = $request->highlight;
			$page->popup_page_id          = $request->get('popup_page_id', 0);
			$page->popup_title            = $request->get('popup_title', NULL);
			$page->popup_title_zh         = $request->get('popup_title_zh', NULL);
			$page->published              = $request->published;
			$page->category               = $request->category;
			$page->child_display_category = $request->child_display_category;
			$page->page_content           = $request->page_content;
			$page->cre_by                 = auth()->user()->name;
			$page->upd_by                 = auth()->user()->name;

			if($request->has('image'))
			{
				$page->path_banner = $this->save_image($request->file('image'));
			}

			if($request->has('thumbnail'))
			{
				$page->path_thumbnail = $this->save_thumbnail($request->file('thumbnail'));
			}

			if($request->has('child_page_id') && count($request->child_page_id))
			{
				$page->child_page_id = implode(',', $request->child_page_id);
			}

			$page->save();

			Notie::success();

			return redirect()->route('admin.page.index');
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
			$page_subject = trans('custom.page_edit_title');

			$result                  = Pages::findOrFail($id);
			$result['child_page_id'] = explode(',', $result->child_page_id);

			$categoryArr     = $this->getCategory();
			$childDisplayArr = $this->getCategory('child');
			$pagesArr        = Pages::where('id', '<>', $id)->lists('title', 'id');
			$pagesArr->put('0', '-- None --');

			return view('admin.pages.edit', compact('result', 'page_subject', 'categoryArr', 'childDisplayArr', 'pagesArr'));
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
			$request->merge(array_map('trim', $request->except('child_page_id')));
			$this->validate($request, ['title'                  => 'required|max:255',
			                           'title_zh'               => 'required|max:255',
			                           'category'               => 'required|alpha',
			                           'highlight'              => 'max:255',
			                           'popup_title'            => 'max:20|min:3',
			                           'popup_title_zh'         => 'max:10|min:3',
			                           'published'              => 'required|boolean',
			                           'image'                  => 'mimes:jpeg,jpg,png,gif|max:1024',
			                           'thumbnail'              => 'mimes:jpeg,jpg,png,gif|max:1024',
			                           'child_page_id'          => 'array',
			                           'child_display_category' => 'in:0,1,2,3',
			                           'page_content'           => 'required']);

			$page                         = Pages::findOrFail($id);
			$page->slug                   = str_slug($request->title);
			$page->title                  = $request->title;
			$page->title_zh               = $request->title_zh;
			$page->highlight              = $request->highlight;
			$page->popup_page_id          = $request->get('popup_page_id', 0);
			$page->popup_title            = $request->get('popup_title', NULL);
			$page->popup_title_zh         = $request->get('popup_title_zh', NULL);
			$page->published              = $request->published;
			$page->category               = $request->category;
			$page->child_display_category = $request->child_display_category;
			$page->page_content           = $request->page_content;
			$page->upd_by                 = auth()->user()->name;

			if($request->has('image'))
			{
				File::delete($page->path_banner);
				$page->path_banner = $this->save_image($request->file('image'));
			}

			if($request->has('thumbnail'))
			{
				File::delete($page->path_thumbnail);
				$page->path_thumbnail = $this->save_thumbnail($request->file('thumbnail'));
			}

			if($request->has('child_page_id') && count($request->child_page_id))
			{
				$page->child_page_id = implode(',', $request->child_page_id);
			}

			$page->save();

			Notie::success('Updated');

			return redirect()->route('admin.page.index');
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

			File::delete($page->path_banner);
			File::delete($page->thumbnail);

			$page->delete();

			Notie::success('Deleted');

			return redirect()->route('admin.page.index');
		}

		private function getCategory($type = 'page')
		{
			$data = [];
			if($type == 'page')
			{
				$data = [
					'default'    => 'Default',
					'programmes' => 'Programmes',
				];
			}
			elseif($type == 'child')
			{
				$data = [
					'0' => '-- None --',
					'1' => 'White',
					'2' => 'Dark Gray',
					'3' => 'Black',
				];
			}

			return $data;
		}

		private function save_image($image)
		{
			$timestamp   = time();
			$path        = env('PAGE_BANNER_PATH');
			$img_dt_name = $timestamp . '-' . $image->getClientOriginalName();
			$image_path  = $path . '/' . $img_dt_name;

			$image->move($path, $img_dt_name);
			Image::make($image_path)->fit(env('PAGE_BANNER_WIDTH'), env('PAGE_BANNER_HEIGHT'))->save();

			return $image_path;
		}

		private function save_thumbnail($image)
		{
			$timestamp   = time();
			$path        = env('PAGE_THUMBNAIL_PATH');
			$img_dt_name = $timestamp . '-' . $image->getClientOriginalName();
			$image_path  = $path . '/' . $img_dt_name;

			$image->move($path, $img_dt_name);
			Image::make($image_path)->fit(env('PAGE_THUMBNAIL_WIDTH'), env('PAGE_THUMBNAIL_HEIGHT'))->save();

			return $image_path;
		}
	}
