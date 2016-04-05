<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Library\Notie;
	use App\Http\Requests;
	use App\Models\Pages;
	use Carbon\Carbon;
	use Illuminate\Http\Request;

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

			$sortColumns = ['a' => 'created_at', 'b' => 'slug', 'c' => 'title'];
			$sortColumn  = find_soft_column($sortBy, $sortColumns, 'created_at');
			$from        = get_filter_date_from($from);
			$to          = get_filter_date_to($to);

			$page_subject = trans('custom.page_list_title');
			$add_route    = 'admin.page.create';

			$query = Pages::whereBetween('created_at', [$from->toDateTimeString(), $to->toDateTimeString()]);
			if($search != '')
			{
				$search_available_field = ['slug', 'title'];
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
			$page_subject = trans('custom.page_add_title');
			$categoryArr  = [
				'default' => 'Default'
			];

			return view('admin.pages.create', compact('page_subject', 'categoryArr'));
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
			$this->validate($request, ['slug'         => 'required|max:100|alpha_dash|unique:pages,slug',
			                           'title'        => 'max:255',
			                           'category'     => 'required|in:default',
			                           'highlight'    => 'max:255',
			                           'published'    => 'required|boolean',
			                           'page_content' => 'required']);

			$page               = new Pages();
			$page->slug         = $request->slug;
			$page->title        = $request->get('title', NULL);
			$page->highlight    = $request->highlight;
			$page->published    = $request->published;
			$page->category     = $request->category;
			$page->page_content = $request->page_content;
			$page->cre_by       = auth()->user()->name;
			$page->upd_by       = auth()->user()->name;
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
			$result       = Pages::findOrFail($id);

			$categoryArr = [
				'default' => 'Default'
			];

			return view('admin.pages.edit', compact('result', 'page_subject', 'categoryArr'));
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
			$this->validate($request, ['slug'         => 'required|max:100|alpha_dash',
			                           'title'        => 'max:255',
			                           'category'     => 'required|in:default',
			                           'highlight'    => 'max:255',
			                           'published'    => 'required|boolean',
			                           'page_content' => 'required']);

			$page               = Pages::findOrFail($id);
			$page->slug         = $request->slug;
			$page->title        = $request->get('title', NULL);
			$page->highlight    = $request->highlight;
			$page->published    = $request->published;
			$page->category     = $request->category;
			$page->page_content = $request->page_content;
			$page->upd_by       = auth()->user()->name;
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
			$page->delete();

			Notie::success('Deleted');

			return redirect()->route('admin.page.index');
		}
	}
