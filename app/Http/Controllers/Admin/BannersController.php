<?php

	namespace App\Http\Controllers\Admin\Controllers;

	use App\Http\Controllers\Controller;
	use App\Http\Library\Notie;
	use App\Http\Requests;
	use App\Models\Banners;
	use Carbon\Carbon;
	use Illuminate\Http\Request;
	use Intervention\Image\Facades\Image;

	class BannersController extends Controller {
		public function __construct()
		{
			$this->middleware('permission:admin_banners');
		}

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

			$sortColumns = ['a' => 'created_at', 'b' => 'published_at', 'c' => 'title'];
			$sortColumn  = find_soft_column($sortBy, $sortColumns, 'created_at');
			$from        = get_filter_date_from($from);
			$to          = get_filter_date_to($to);

			$page_subject = trans('custom.banner_list_title');
			$add_route    = 'admin.banner.create';

			$query = Banners::whereBetween('created_at', [$from->toDateTimeString(), $to->toDateTimeString()]);
			if($search != '')
			{
				$search_available_field = ['title'];
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

			return view('admin.banners.index', compact('result', 'page_subject', 'add_route', 'paginate_appends', 'filter_list'));
		}

		public function create()
		{
			$page_subject = trans('custom.page_add_title');
			$categoryArr  = [
				'index' => 'Index Page'
			];

			return view('admin.pages.create', compact('page_subject', 'categoryArr'));
		}

		public function store(Request $request)
		{
			$request->merge(array_map('trim', $request->all()));
			$this->validate($request, ['title'        => 'required|max:255',
			                           'category'     => 'required|in:index',
			                           'url'          => 'url|max:255',
			                           'published'    => 'required|boolean',
			                           'publish_date' => 'required|boolean']);

			$image_desktop = $request->file('image_desktop');
			$timestamp     = time();
			$path          = env('DASHBOARD_BANNER_PATH');

			$img_dt_name = $timestamp . '-' . $image_desktop->getClientOriginalName();
			$image_desktop->move($path, $img_dt_name);
			Image::make($path . '/' . $img_dt_name)->fit(env('DASHBOARD_BANNER_WIDTH'), env('DASHBOARD_BANNER_HEIGHT'))->save();

			if($request->has('image_mobile'))
			{
				$image_mobile = $request->file('image_mobile');
				$img_mb_name  = $timestamp . '-mb-' . $image_mobile->getClientOriginalName();
				$image_mobile->move($path, $img_mb_name);
				Image::make($path . '/' . $img_mb_name)
				     ->fit(env('DASHBOARD_BANNER_MOBILE_WIDTH'), env('DASHBOARD_BANNER_MOBILE_HEIGHT'))
				     ->save();
			}
			else
			{
				$img_mb_name = $timestamp . '-mb-' . $image_desktop->getClientOriginalName();
				Image::make($path . '/' . $img_dt_name)
				     ->fit(env('DASHBOARD_BANNER_MOBILE_WIDTH'), env('DASHBOARD_BANNER_MOBILE_HEIGHT'))
				     ->save($path . '/' . $img_mb_name);
			}

			$img_tn_name = $timestamp . '-tn-' . $image_desktop->getClientOriginalName();
			Image::make($path . '/' . $img_dt_name)
			     ->fit(env('THUMBNAIL_WIDTH'), env('THUMBNAIL_HEIGHT'))
			     ->save($path . '/' . $img_tn_name);

			$page               = new Banners();
			$page->category     = $request->category;
			$page->title        = $request->title;
			$page->url          = $request->get('url', NULL);
			$page->published    = $request->published;
			$page->publish_date = $request->publish_date;
			$page->cre_by       = auth()->user()->name;
			$page->upd_by       = auth()->user()->name;
			$page->created_at   = Carbon::now();
			$page->updated_at   = Carbon::now();
			$page->save();

			Notie::success();

			return redirect()->route('admin.banner.index');
		}

		public function edit($id)
		{
			$page_subject = trans('custom.page_edit_title');
			$result       = Banners::findOrFail($id);

			$categoryArr = [
				'index' => 'Index Page'
			];

			return view('admin.banner.edit', compact('result', 'page_subject', 'categoryArr'));
		}

		public function update(Request $request, $id)
		{
			$request->merge(array_map('trim', $request->all()));
			$this->validate($request, ['title'        => 'required|max:255',
			                           'category'     => 'required|in:index',
			                           'url'          => 'url|max:255',
			                           'published'    => 'required|boolean',
			                           'publish_date' => 'required|boolean']);

			$page               = Banners::findOrFail($id);
			$page->slug         = $request->slug;
			$page->title        = $request->get('title', NULL);
			$page->highlight    = $request->highlight;
			$page->published    = $request->published;
			$page->category     = $request->category;
			$page->page_content = $request->page_content;
			$page->upd_by       = auth()->user()->name;
			$page->updated_at   = Carbon::now();
			$page->save();

			Notie::success('Updated');

			return redirect()->route('admin.banner.index');
		}

		public function destroy($id)
		{
			$banner = Banners::findOrFail($id);
			$banner->delete();

			Notie::success('Deleted');

			return redirect()->route('admin.banner.index');
		}
	}
