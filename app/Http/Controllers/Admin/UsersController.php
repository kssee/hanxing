<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Library\Notie;
	use App\Http\Requests;
	use App\Models\Role;
	use App\Models\User;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;


	class UsersController extends Controller {
		/**
		 * UsersController constructor.
		 */
		public function __construct()
		{
			$this->middleware('permission:admin_users');
		}

		public function index(Request $request)
		{
			$page_subject = trans('custom.user_list_title');

			if(checkPermission('admin_user_add'))
			{
				$add_route = 'admin.user.create';
			}

			$validation = get_filter_bar_validation();
			$this->validate($request, $validation);

			$status  = $request->get('status');
			$role    = $request->get('role');
			$st      = $request->get('st', 'exactly');
			$search  = $request->get('search');
			$sortBy  = $request->mt;
			$orderBy = $request->get('od', 'asc');

			$sortColumns = ['a' => 'name', 'b' => 'email', 'c' => 'position', 'd' => 'tel'];
			$sortColumn  = find_soft_column($sortBy, $sortColumns, 'name');

			$query = DB::table('users')
			           ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
			           ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
			           ->select('users.*', 'roles.display_name');

			if($search != '')
			{
				$search_available_field = ['email', 'users.name'];
				search_to_query($query, $search, $search_available_field, $st);
			}
			else
			{
				if($status != '')
				{
					$query->where('status', $status);
				}
			}

			$paginate_appends = ['search' => $search,
			                     'st'     => $st,
			                     'status' => $status,
			                     'role'   => $role,
			                     'mt'     => $sortBy,
			                     'od'     => $orderBy];

			$filter_list['items'] = [
				'status' => ['list'     => [''        => 'All',
				                            'ACTIVE'  => trans('custom.active'),
				                            'SUSPEND' => trans('custom.suspend')],
				             'selected' => $status],
			];

			$filter_list['search'] = ['enable' => true, 'value' => $search, 'st' => $st];

			$result = $query->orderBy($sortColumn, $orderBy)->paginate(30);

			return view('admin.users.index', compact('result', 'filter_list', 'paginate_appends', 'page_subject', 'add_route'));
		}

		/**
		 * Add new User
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
		 */
		public function create()
		{
			$page_subject = trans('custom.user_add_title');
			$roleArr      = Role::lists('display_name', 'id');

			return view('admin.users.create', compact('roleArr', 'page_subject'));
		}

		/**
		 * Store new user to DB
		 *
		 * @param Request $request
		 *
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function store(Request $request)
		{
			$request->merge(array_map('trim', $request->all()));
			$this->validate($request, ['email'    => 'required|max:64|email|unique:users,email',
			                           'password' => 'required|confirmed|min:6|max:255',
			                           'name'     => 'required|min:3|max:32',
			                           'role'     => 'required|exists:roles,id',
			                           'status'   => 'required|in:ACTIVE,SUSPEND',
			                           'position' => 'max:32',
			                           'tel'      => 'max:32',
			                           'ext'      => 'max:12',
			]);

			$user           = new User();
			$user->status   = $request->status;
			$user->email    = $request->email;
			$user->password = $request->password;
			$user->name     = $request->name;
			$user->tel      = $request->get('tel', NULL);
			$user->position = $request->get('position', NULL);
			$user->ext      = $request->get('ext', NULL);
			$user->cre_by   = auth()->user()->name;
			$user->upd_by   = auth()->user()->name;
			$user->save();
			$user->roles()->attach($request->role);
			Notie::success();

			return redirect()->route('admin.user.index');
		}

		/**
		 * Edit user
		 *
		 * @param $id
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
		 */
		public function edit($id)
		{
			$page_subject = trans('custom.user_edit_title');
			$user         = User::findOrFail($id);
			$user_role    = $user->roles->toArray();
			$user_role_id = $user_role[0]['id'];
			$roleArr      = Role::lists('display_name', 'id');

			return view('admin.users.edit', compact('user', 'user_role_id', 'roleArr', 'page_subject'));
		}

		/**
		 * Update user to DB
		 *
		 * @param Request $request
		 * @param $id
		 * @param $type
		 *
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function update(Request $request, $id)
		{
			$request->merge(array_map('trim', $request->all()));

			$this->validate($request, ['password' => 'confirmed|min:6|max:255',
			                           'name'     => 'required|min:3|max:32',
			                           'role'     => 'exists:roles,id',
			                           'status'   => 'in:ACTIVE,SUSPEND',
			                           'position' => 'max:32',
			                           'tel'      => 'max:32',
			                           'ext'      => 'max:32',
			]);

			DB::beginTransaction();
			try
			{
				$user = User::findOrFail($id);
				if($request->has('status'))
				{
					$user->status = $request->status;
				}

				$user->name     = $request->name;
				$user->email    = $request->email;
				$user->tel      = $request->tel;
				$user->position = $request->position;
				$user->ext      = $request->ext;
				$user->upd_by   = auth()->user()->name;

				if($request->has('password'))
				{
					$user->password = $request->password;
				}

				$user->save();

				if($request->has('role'))
				{
					$roles = $user->roles->toArray();
					if($roles[0]['id'] != $request->role)
					{
						$user->roles()->detach($roles[0]['id']);
						$user->roles()->attach($request->role);
					}
				}

				DB::commit();
			}catch(\Exception $e)
			{
				DB::rollBack();

				return redirect()->back()->withErrors($e->getMessage())->withInput($request->all());
			}

			Notie::success('Updated');

			return redirect()->route('admin.user.index');
		}


		/**
		 * Delete user
		 *
		 * @param $id
		 *
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function destroy($id)
		{
			$user = User::findOrFail($id);
			$user->delete();
			Notie::success('Deleted');

			return redirect()->route('admin.user.index');
		}

	}
