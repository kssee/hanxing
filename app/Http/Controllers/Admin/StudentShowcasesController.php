<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Library\Notie;
	use App\Http\Requests;
	use App\Models\StudentShowcases;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\File;
	use Intervention\Image\Facades\Image;

	class StudentShowcasesController extends Controller {
		public function __construct()
		{
			$this->middleware('permission:admin_student_showcases');
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

			$page_subject = trans('custom.sshowcase_list_title');
			$add_route    = 'admin.sshowcase.create';

			$query = StudentShowcases::whereBetween('created_at', [$from->toDateTimeString(), $to->toDateTimeString()]);

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

			return view('admin.sshowcase.index', compact('result', 'page_subject', 'add_route', 'paginate_appends', 'filter_list'));
		}

		public function create()
		{
			$page_subject = trans('custom.sshowcase_add_title');
			$categoryArr  = $this->getCategory();

			return view('admin.sshowcase.create', compact('page_subject', 'categoryArr'));
		}

		public function store(Request $request)
		{
			$request->merge(array_map('trim', $request->all()));
			$this->validate($request, ['image'     => 'mimes:jpeg,jpg,png,gif|max:1024',
			                           'pdf_file'  => 'mimes:pdf|max:24480',
			                           'title'     => 'required|max:100',
			                           'category'  => 'required|max:100',
			                           'author'    => 'max:100',
			                           'link'      => 'url|max:255',
			                           'published' => 'required|boolean']);

			$sshowcase            = new StudentShowcases();
			$sshowcase->title     = $request->title;
			$sshowcase->link      = $request->get('link', NULL);
			$sshowcase->published = $request->published;
			$sshowcase->category  = $request->category;
			$sshowcase->author    = $request->get('author', NULL);
			$sshowcase->cre_by    = auth()->user()->name;
			$sshowcase->upd_by    = auth()->user()->name;

			if($request->has('image'))
			{
				$sshowcase->path_thumbnail = $this->save_image($request->file('image'));
			}

			if($request->has('pdf_file'))
			{
				$sshowcase->path_file = $this->save_file($request->file('pdf_file'));
			}

			$sshowcase->save();
			Notie::success();

			return redirect()->route('admin.sshowcase.index');
		}

		public function edit($id)
		{
			$page_subject = trans('custom.sshowcase_edit_title');
			$result       = StudentShowcases::findOrFail($id);
			$categoryArr  = $this->getCategory();

			return view('admin.sshowcase.edit', compact('result', 'page_subject', 'categoryArr'));
		}

		public function update(Request $request, $id)
		{
			$request->merge(array_map('trim', $request->all()));
			$this->validate($request, ['image'     => 'mimes:jpeg,jpg,png,gif|max:1024',
			                           'pdf_file'  => 'mimes:pdf|max:24480',
			                           'title'     => 'required|max:100',
			                           'category'  => 'required|max:100',
			                           'author'    => 'max:100',
			                           'link'      => 'url|max:255',
			                           'published' => 'required|boolean']);

			$sshowcase            = StudentShowcases::findOrFail($id);
			$sshowcase->title     = $request->title;
			$sshowcase->link      = $request->get('link', NULL);
			$sshowcase->published = $request->published;
			$sshowcase->category  = $request->category;
			$sshowcase->author    = $request->get('author', NULL);
			$sshowcase->upd_by    = auth()->user()->name;

			if($request->has('image'))
			{
				File::delete($sshowcase->path_thumbnail);
				$sshowcase->path_thumbnail = $this->save_image($request->file('image'));
			}

			if($request->has('pdf_file'))
			{
				File::delete($sshowcase->path_file);
				$sshowcase->path_file = $this->save_file($request->file('pdf_file'));
			}
			$sshowcase->save();

			Notie::success('Updated');

			return redirect()->route('admin.sshowcase.index');
		}

		public function destroy($id)
		{
			$sshowcase = StudentShowcases::findOrFail($id);
			File::delete($sshowcase->path_thumbnail);
			File::delete($sshowcase->path_file);
			$sshowcase->delete();

			Notie::success('Deleted');

			return redirect()->route('admin.sshowcase.index');
		}

		private function save_image($image)
		{
			$timestamp   = time();
			$path        = env('STUDENT_SHOWCASE_THUMBNAIL_PATH');
			$img_dt_name = $timestamp . '-' . $image->getClientOriginalName();
			$image_path  = $path . '/' . $img_dt_name;

			$image->move($path, $img_dt_name);
			Image::make($image_path)->fit(env('STUDENT_SHOWCASE_THUMBNAIL_WIDTH'), env('STUDENT_SHOWCASE_THUMBNAIL_HEIGHT'))->save();

			return $image_path;
		}

		private function save_file($file)
		{
			$timestamp    = time();
			$path         = env('STUDENT_SHOWCASE_FILE_PATH');
			$file_dt_name = $timestamp . '-' . $file->getClientOriginalName();
			$file_path    = $path . '/' . $file_dt_name;

			$file->move($path, $file_dt_name);

			return $file_path;
		}

		private function getCategory()
		{
			$data = [
				'films_mv'          => 'Films/ MV',
				'han_xin_bao'       => 'HanxiBao',
				'chuan_bao_xue_ren' => 'Chuan Bo Xue Ren',
			];

			return $data;
		}
	}
