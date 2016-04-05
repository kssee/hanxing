<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Library\Notie;
	use App\Http\Requests;
	use App\Models\Permission;
	use App\Models\Role;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;

	class RolesController extends Controller {
		/**
		 * RolesController constructor.
		 */
		public function __construct()
		{
			$this->middleware('permission:admin_authorization');
		}

		public function index(Request $request)
		{
			$validation = get_filter_bar_validation();
			$this->validate($request, $validation);

			$sortBy  = strtolower($request->mt);
			$orderBy = $request->get('od', 'asc');

			$sortColumns = ['a' => 'name', 'b' => 'display_name'];
			$sortColumn  = find_soft_column($sortBy, $sortColumns, 'name');

			$page_subject = trans('custom.role_list_title');
			$add_route = 'admin.role.create';

			$paginate_appends = ['mt' => $sortBy, 'od' => $orderBy];
			$result           = Role::orderBy($sortColumn, $orderBy)->paginate(50);

			return view('admin.roles.index', compact('result', 'page_subject', 'add_route', 'paginate_appends'));
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
		 */
		public function create()
		{
			$page_subject = trans('custom.role_add_title');

			return view('admin.roles.create', compact('page_subject'));
		}

		/**
		 * @param Request $request
		 *
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function store(Request $request)
		{
			$request->merge(array_map('trim', $request->all()));
			$this->validate($request, ['name'         => 'required|alpha_dash|max:32|unique:roles,name',
			                           'display_name' => 'required|max:32',
			                           'description'  => 'max:128',
			]);

			$role               = new Role();
			$role->name         = strtolower($request->name);
			$role->display_name = $request->display_name;
			$role->description  = $request->description;
			$role->save();
			Notie::success();

			return redirect()->route('admin.role.index');
		}

		/**
		 * @param $id
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
		 */
		public function edit($id)
		{
			$page_subject = trans('custom.role_edit_title');
			$result       = Role::findOrFail($id);

			return view('admin.roles.edit', compact('result', 'page_subject'));
		}

		/**
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

			$role               = Role::findOrFail($id);
			$role->name         = strtolower($request->name);
			$role->display_name = $request->display_name;
			$role->description  = $request->description;
			$role->save();
			Notie::success('Updated');

			return redirect()->route('admin.role.index');
		}

		/**
		 * @param $id
		 *
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function destroy($id)
		{
			DB::table('roles')->where('id', $id)->delete();
			Notie::success('Deleted');

			return redirect()->route('admin.role.index');
		}

		/**
		 * @param $id
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
		 */
		public function permission($id)
		{
			$page_subject = trans('custom.role_edit_permission');

			$role             = Role::findOrFail($id);
			$permissions      = Permission::orderBy('display_name')->get();
			$_permission_role = DB::table('permission_role')->select('permission_id')->where('role_id', $role->id)->get();
			$permission_role  = [];
			foreach($_permission_role as $entry)
			{
				$permission_role[] = $entry->permission_id;
			}

			return view('admin.roles.permission', compact('role', 'permissions', 'permission_role', 'page_subject'));
		}

		/**
		 * @param Request $request
		 * @param $id
		 *
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function permissionStore(Request $request, $id)
		{
			$role = Role::findOrFail($id);
			$this->validate($request, ['permission' => 'required|array']);
			$role->perms()->sync($request->permission);
			Notie::success('Updated');

			return redirect()->route('admin.role.index');
		}
	}
