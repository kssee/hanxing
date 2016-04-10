<?php

	namespace App\Http\Controllers\Front;

	use App\Http\Controllers\Controller;
	use App\Http\Requests;
	use App\Models\StudentFiles;
	use Illuminate\Support\Facades\Input;


	class StudentFilesController extends Controller {
		public function index()
		{
			if( ! $this->checkCredential())
			{
				return redirect()->route('student');
			}

			$breadcrumb_overwrite['link'][] = [trans('custom.home') => route('index')];
			$breadcrumb_overwrite['active'] = trans('custom.student_files');

			$page            = Input::get('page', '1');
			$record_per_page = 16;
			$add_order       = ($page - 1) * $record_per_page;
			$result          = StudentFiles::where('published', 1)
			                               ->orderBy('created_at', 'desc')
			                               ->paginate($record_per_page);

			$categoryArr = $this->getCategory();

			return view('front.studentFiles', compact('result', 'type', 'add_order', 'categoryArr', 'breadcrumb_overwrite'));
		}

		public function download($id)
		{
			if( ! $this->checkCredential())
			{
				return redirect()->route('student');
			}

			$file = StudentFiles::findOrFail($id);
			$path = storage_path($file->path_file);

			return response()->file($path);
		}

		private function checkCredential()
		{
			if( ! auth()->check() && ( ! session()->has('student_logged_in') || session('student_logged_in') != true))
			{
				return false;
			}

			return true;

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
