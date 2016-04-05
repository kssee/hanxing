<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Library\Notie;
	use App\Http\Requests;
	use App\Models\Menu;
	use Illuminate\Http\Request;

	class MenuController extends Controller {
		public function __construct()
		{
			$this->middleware('permission:admin_menu');
		}

		public function index(Request $request)
		{
			$validation = get_filter_bar_validation();
			$this->validate($request, $validation);

			$sortBy  = $request->mt;
			$orderBy = $request->get('od', 'asc');

			$sortColumns = ['a' => 'name', 'b' => 'layer'];
			$sortColumn  = find_soft_column($sortBy, $sortColumns, 'name');

			$paginate_appends = ['mt' => $sortBy, 'od' => $orderBy];
			$result           = Menu::orderBy($sortColumn, $orderBy)->paginate(30);

			$add_route    = 'admin.menu.create';
			$page_subject = trans('custom.menu_list_title');

			return view('admin.menu.index', compact('result', 'page_subject', 'add_route', 'paginate_appends'));
		}

		/**
		 * Create new record
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
		 */
		public function create()
		{
			$page_subject = trans('custom.menu_add_title');
			$menuLists    = Menu::lists('name', 'id');
			$menuLists->put('', '---- none ----');
			$menuLists   = $menuLists->sort();
			$activeLists = Menu::where('layer', 1)->lists('name', 'id');
			$activeLists->put('', '---- none ----');
			$activeLists = $activeLists->sort();

			return view('admin.menu.create', compact('page_subject', 'menuLists', 'activeLists'));
		}

		/**
		 * Store new record to DB
		 *
		 * @param Request $request
		 *
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function store(Request $request)
		{
			$request->merge(array_map('trim', $request->all()));
			$this->validate($request, ['name'      => 'required|max:50|unique:menu,name',
			                           'name_zh'   => 'required|max:50',
			                           'path'      => 'required|alpha_dash|max:255',
			                           'parent_id' => 'exists:menu,id',
			                           'active_id' => 'exists:menu,id',
			                           'layer'     => 'required|in:1,2,3',
			                           'order'     => 'required_if:layer,1',
			]);

			$menu            = new Menu();
			$menu->name      = $request->name;
			$menu->name_zh   = $request->name_zh;
			$menu->path      = $request->path;
			$menu->active_id = $request->get('active_id', 0);
			$menu->layer     = $request->layer;
			$menu->order     = $request->get('order', 0);
			$menu->cre_by    = auth()->user()->name;
			$menu->upd_by    = auth()->user()->name;

			if($request->layer == 1)
			{
				$menu->parent_id = 0;
			}
			else
			{
				$menu->parent_id = $request->get('parent_id', 0);
			}
			$menu->save();

			if($request->layer == 1 && ! $request->has('active_id'))
			{
				$menu->active_id = $menu->id;
				$menu->save();
			}

			Notie::success();

			return redirect()->route('admin.menu.index');
		}

		/**
		 * Edit record
		 *
		 * @param $id
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
		 */
		public function edit($id)
		{
			$page_subject = trans('custom.menu_edit_title');
			$result       = Menu::findOrFail($id);
			$menuLists    = Menu::where('layer', '<', $result->layer)->lists('name', 'id');
			$menuLists->put('', '---- none ----');
			$menuLists = $menuLists->sort();

			$activeLists = Menu::where('layer', 1)->where('id', '<>', $id)->lists('name', 'id');
			$activeLists->put('', '---- none ----');
			$activeLists = $activeLists->sort();

			return view('admin.menu.edit', compact('result', 'page_subject', 'menuLists', 'activeLists'));
		}

		/**
		 * Update edited record to DB
		 *
		 * @param Request $request
		 * @param $id
		 *
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function update(Request $request, $id)
		{
			$request->merge(array_map('trim', $request->all()));
			$this->validate($request, ['name'      => 'required|max:50',
			                           'name_zh'   => 'required|max:50',
			                           'path'      => 'required|alpha_dash|max:255',
			                           'parent_id' => 'exists:menu,id',
			                           'active_id' => 'exists:menu,id',
			                           'layer'     => 'required|in:1,2,3',
			                           'order'     => 'required_if:layer,1',
			]);
			$menu            = Menu::findOrFail($id);
			$menu->name      = $request->name;
			$menu->name_zh   = $request->name_zh;
			$menu->path      = $request->path;
			$menu->active_id = $request->get('active_id', 0);
			$menu->order     = $request->get('order', 0);
			$menu->upd_by    = auth()->user()->name;

			if($request->layer == 1)
			{
				$menu->parent_id = 0;
			}
			else
			{
				$menu->parent_id = $request->get('parent_id', 0);
			}

			if($request->layer == 1 && ! $request->has('active_id'))
			{
				$menu->active_id = $menu->id;
			}

			if($request->layer == 1)
			{
				$menu->layer = $request->layer;
			}

			$menu->save();

			Notie::success('Updated');

			return redirect()->route('admin.menu.index');
		}

		/**
		 * Delete record
		 *
		 * @param $id
		 *
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function destroy($id)
		{
			Menu::destroy($id);
			Notie::success('Deleted');

			return redirect()->route('admin.menu.index');
		}
	}
