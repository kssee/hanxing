<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Library\Notie;
	use App\Http\Requests;
	use App\Models\StudentFiles;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\File;

	class StudentFilesController extends Controller {
		public function __construct()
		{
			$this->middleware('permission:admin_student_files');
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

			$page_subject = trans('custom.sfiles_list_title');
			$add_route    = 'admin.sfiles.create';

			$query = StudentFiles::whereBetween('created_at', [$from->toDateTimeString(), $to->toDateTimeString()]);

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
			$categoryArr  = $this->getCategory();
			$filter_list['date'] = ['enable' => true, 'from' => $from->toDateString(), 'to' => $to->toDateString()];

			return view('admin.sfiles.index', compact('result', 'page_subject', 'add_route', 'paginate_appends', 'filter_list','categoryArr'));
		}

		public function create()
		{
			$page_subject = trans('custom.sfiles_add_title');
			$categoryArr  = $this->getCategory();

			return view('admin.sfiles.create', compact('page_subject', 'categoryArr'));
		}

		public function store(Request $request)
		{
			$request->merge(array_map('trim', $request->all()));
			$this->validate($request, [
				'file'      => 'mimes:jpeg,jpg,png,gif,pdf,docx,doc,txt,xlsx,xls,csv,zip|max:24480',
				'title'     => 'required|max:255',
				'category'  => 'required|max:100',
				'link'      => 'required_without:file|url|max:255',
				'published' => 'required|boolean']);

			$sfiles            = new StudentFiles();
			$sfiles->title     = $request->title;
			$sfiles->link      = $request->get('link', NULL);
			$sfiles->published = $request->published;
			$sfiles->category  = $request->category;
			$sfiles->cre_by    = auth()->user()->name;
			$sfiles->upd_by    = auth()->user()->name;

			if($request->has('file'))
			{
				$sfiles->path_file = $this->save_file($request->file('file'));
			}

			$sfiles->save();
			Notie::success();

			return redirect()->route('admin.sfiles.index');
		}

		public function edit($id)
		{
			$page_subject = trans('custom.sfiles_edit_title');
			$result       = StudentFiles::findOrFail($id);
			$categoryArr  = $this->getCategory();

			return view('admin.sfiles.edit', compact('result', 'page_subject', 'categoryArr'));
		}

		public function update(Request $request, $id)
		{
			$request->merge(array_map('trim', $request->all()));
			$this->validate($request, [
				'file'      => 'mimes:jpeg,jpg,png,gif,pdf,docx,doc,txt,xlsx,xls,csv,zip|max:24480',
				'title'     => 'required|max:255',
				'category'  => 'required|max:100',
				'link'      => 'required_without:file|url|max:255',
				'published' => 'required|boolean']);

			$sfiles            = StudentFiles::findOrFail($id);
			$sfiles->title     = $request->title;
			$sfiles->link      = $request->get('link', NULL);
			$sfiles->published = $request->published;
			$sfiles->category  = $request->category;
			$sfiles->upd_by    = auth()->user()->name;

			if($request->has('file'))
			{
				File::delete(storage_path($sfiles->path_file));
				$sfiles->path_file = $this->save_file($request->file('file'));
			}
			$sfiles->save();

			Notie::success('Updated');

			return redirect()->route('admin.sfiles.index');
		}

		public function destroy($id)
		{
			$sfiles = StudentFiles::findOrFail($id);
			File::delete(storage_path($sfiles->path_file));
			$sfiles->delete();

			Notie::success('Deleted');

			return redirect()->route('admin.sfiles.index');
		}

		private function save_file($file)
		{
			$timestamp    = time();
			$path         = env('STUDENT_FILES_PATH');
			$file_dt_name = $timestamp . '-' . $file->getClientOriginalName();
			$file_path    = $path . '/' . $file_dt_name;

			$file->move(storage_path($path), $file_dt_name);

			return $file_path;
		}

		private function getCategory()
		{
			$data = [
				'd_broadcasting'     => 'Diploma in Broadcasting',
				'd_journalism'       => 'Diploma in Journalism',
				'd_public_relations' => 'Diploma in Public Relations',
				'others'             => 'Others'
			];

			return $data;
		}
	}
