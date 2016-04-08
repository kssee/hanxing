<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Library\Notie;
	use App\Http\Requests;
	use App\Models\Banners;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\File;
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
			$from    = $request->get('from');
			$to      = $request->get('to');

			$sortColumns = ['a' => 'created_at', 'b' => 'title'];
			$sortColumn  = find_soft_column($sortBy, $sortColumns, 'created_at');
			$from        = get_filter_date_from($from);
			$to          = get_filter_date_to($to);

			$page_subject = trans('custom.banner_list_title');
			$add_route    = 'admin.banner.create';

			$query = Banners::whereBetween('created_at', [$from->toDateTimeString(), $to->toDateTimeString()]);

			if($status != '')
			{
				$query->where('published', $status);
			}

			$result = $query->orderBy($sortColumn, $orderBy)->paginate(10);

			$paginate_appends = ['status' => $status,
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

			$filter_list['date'] = ['enable' => true, 'from' => $from->toDateString(), 'to' => $to->toDateString()];

			return view('admin.banners.index', compact('result', 'page_subject', 'add_route', 'paginate_appends', 'filter_list'));
		}

		public function create()
		{
			$page_subject = trans('custom.banner_add_title');

			return view('admin.banners.create', compact('page_subject'));
		}

		public function store(Request $request)
		{
			$request->merge(array_map('trim', $request->all()));
			$this->validate($request, ['image'       => 'required|mimes:jpeg,jpg,png,gif|max:1024',
			                           'title'       => 'max:100',
			                           'description' => 'max:100',
			                           'url'         => 'url|max:255',
			                           'published'   => 'required|boolean']);

			$banner              = new Banners();
			$banner->title       = $request->get('title', NULL);
			$banner->description = $request->get('description', NULL);
			$banner->url         = $request->get('url', NULL);
			$banner->published   = $request->published;
			$banner->path        = $this->save_image($request->file('image'));
			$banner->cre_by      = auth()->user()->name;
			$banner->upd_by      = auth()->user()->name;
			$banner->save();
			Notie::success();

			return redirect()->route('admin.banner.index');
		}

		public function edit($id)
		{
			$page_subject = trans('custom.banner_edit_title');
			$result       = Banners::findOrFail($id);

			return view('admin.banners.edit', compact('result', 'page_subject'));
		}

		public function update(Request $request, $id)
		{
			$request->merge(array_map('trim', $request->all()));
			$this->validate($request, ['image'       => 'mimes:jpeg,jpg,png,gif|max:1024',
			                           'title'       => 'max:100',
			                           'description' => 'max:100',
			                           'url'         => 'url|max:255',
			                           'published'   => 'required|boolean']);

			$banner              = Banners::findOrFail($id);
			$banner->title       = $request->get('title', NULL);
			$banner->description = $request->get('description', NULL);
			$banner->url         = $request->get('url', NULL);
			$banner->published   = $request->published;
			$banner->upd_by      = auth()->user()->name;

			if($request->has('image'))
			{
				File::delete($banner->path);
				$banner->path = $this->save_image($request->file('image'));
			}

			$banner->save();

			Notie::success('Updated');

			return redirect()->route('admin.banner.index');
		}

		public function destroy($id)
		{
			$banner = Banners::findOrFail($id);
			File::delete($banner->path);
			$banner->delete();

			Notie::success('Deleted');

			return redirect()->route('admin.banner.index');
		}

		private function save_image($image)
		{
			$timestamp   = time();
			$path        = env('BANNER_PATH');
			$img_dt_name = $timestamp . '-' . $image->getClientOriginalName();
			$image_path  = $path . '/' . $img_dt_name;

			$image->move($path, $img_dt_name);
			Image::make($image_path)->fit(env('BANNER_WIDTH'), env('BANNER_HEIGHT'))->save();

			return $image_path;
		}
	}
