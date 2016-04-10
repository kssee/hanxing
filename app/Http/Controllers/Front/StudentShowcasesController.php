<?php

	namespace App\Http\Controllers\Front;

	use App\Http\Controllers\Controller;
	use App\Http\Requests;
	use App\Models\StudentShowcases;
	use Illuminate\Support\Facades\Input;

	class StudentShowcasesController extends Controller {
		public function index($input)
		{
			switch($input)
			{
				case 'chuan-bao-xue-ren':
					$type              = 'chuan_bao_xue_ren';
					$active_breadcrumb = trans('custom.chuan_bao_xue_ren');
					break;
				case 'han-xin-bao':
					$type              = 'han_xin_bao';
					$active_breadcrumb = trans('custom.han_xin_bao');
					break;
				default :
					$type              = 'films_mv';
					$active_breadcrumb = trans('custom.films_mv');
					break;
			}

			$page            = Input::get('page', '1');
			$record_per_page = 16;
			$add_order       = ($page - 1) * $record_per_page;
			$result          = StudentShowcases::where('category', $type)
			                                   ->where('published', 1)
			                                   ->orderBy('title', 'desc')
			                                   ->paginate($record_per_page);

			$page_title = trans('custom.student_showcases');

			$breadcrumb_overwrite['link'][] = [trans('custom.home') => route('index')];
			$breadcrumb_overwrite['active'] = $active_breadcrumb;

			return view('front.studentShowcases', compact('result', 'type', 'add_order', 'page_title', 'breadcrumb_overwrite'));
		}
	}