<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Library\Notie;
	use App\Http\Requests;
	use App\Models\Permission;
	use Illuminate\Http\Request;

	class PermissionsController extends Controller {
		/**
		 * PermissionsController constructor.
		 */
		public function __construct()
		{
			$this->middleware('permission:admin_authorization');
		}

		public function index(Request $request)
		{
			$validation = get_filter_bar_validation();
			$this->validate($request, $validation);

			$sortBy  = $request->mt;
			$orderBy = $request->get('od', 'asc');

			$sortColumns = ['a' => 'name', 'b' => 'display_name'];
			$sortColumn  = find_soft_column($sortBy, $sortColumns, 'name');

			$paginate_appends = ['mt' => $sortBy, 'od' => $orderBy];
			$result           = Permission::orderBy($sortColumn, $orderBy)->paginate(30);

			$add_route = 'admin.permission.create';
			$page_subject = trans('custom.permission_list_title');

			return view('admin.permissions.index', compact('result', 'page_subject', 'add_route', 'paginate_appends'));
		}

		/**
		 * Create new record
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
		 */
		public function create()
		{
			$page_subject = trans('custom.permission_add_title');

			return view('admin.permissions.create', compact('page_subject'));
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
			$this->validate($request, ['name'         => 'required|alpha_dash|max:32|unique:permissions,name',
			                           'display_name' => 'required|max:32',
			                           'description'  => 'max:128',
			]);

			$permission               = new Permission();
			$permission->name         = $request->name;
			$permission->display_name = $request->display_name;
			$permission->description  = $request->description;
			$permission->save();
			Notie::success();

			return redirect()->route('admin.permission.index');
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
			$page_subject = trans('custom.permission_edit_title');
			$result       = Permission::findOrFail($id);

			return view('admin.permissions.edit', compact('result', 'page_subject'));
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
			$this->validate($request, ['name'         => 'required|alpha_dash|max:32',
			                           'display_name' => 'required|max:32',
			                           'description'  => 'max:128',
			]);
			$permission               = Permission::findOrFail($id);
			$permission->name         = $request->name;
			$permission->display_name = $request->display_name;
			$permission->description  = $request->description;
			$permission->save();
			Notie::success('Updated');

			return redirect()->route('admin.permission.index');
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
			Permission::destroy($id);
			Notie::success('Deleted');

			return redirect()->route('admin.permission.index');
		}
	}
