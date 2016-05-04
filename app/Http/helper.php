<?php

	function customLog($name, $type, $content, $ip = NULL, $folder = NULL)
	{
		$errMsg = "[" . date("d M Y H:i:s", time()) . "] [" . strtoupper($type) . "] " . $content;

		if($ip)
		{
			$errMsg .= " | $ip";
		}

		if($folder)
		{
			$folder = 'logs/' . $folder . '/';
		}
		else
		{
			$folder = 'logs/';
		}

		$path = storage_path() . '/' . $folder;

		if( ! File::exists($path))
		{
			$result = File::makeDirectory($path, 0775, true);
			if( ! $result)
			{
				$path = storage_path() . '/logs/';
			}
		}

		error_log($errMsg . "\n\n", 3, $path . date("Y-m-d") . "-" . $name . ".log");

		return true;
	}

	function checkPermission($permission)
	{
		if( ! auth()->user()->hasRole(env('SUPER_ADMIN_ROLE_NAME')) && ! auth()->user()->can($permission))
		{
			return false;

		}
		else
		{
			return true;
		}
	}

	function navLinkWithPermission($permission, $route, $name, $params = [])
	{
		if(auth()->user()->hasRole(env('SUPER_ADMIN_ROLE_NAME')) || auth()->user()->can($permission))
		{
			return "<li>" . link_to_route($route, $name, $params) . "</li>";
		}
		else
		{
			return "";
		}
	}

	function navIconLinkWithPermission($permission, $route, $icon, $name, $params = [])
	{
		if(auth()->user()->hasRole(env('SUPER_ADMIN_ROLE_NAME')) || auth()->user()->can($permission))
		{
			return "<li><a href='" . route($route, $params) . "'><i class='fa " . $icon . " fa-fw'></i>&nbsp;" . $name . "</a> " . "</li>";
		}
		else
		{
			return "";
		}
	}

	function iconLinkWithPermission($permission, $route, $icon, $tooltip = '', $params = [], $attributes = [], $confirm = false)
	{
		if(auth()->user()->hasRole(env('SUPER_ADMIN_ROLE_NAME')) || auth()->user()->can($permission))
		{
			$attribute_txt = '';
			foreach($attributes as $key => $value)
			{
				$attribute_txt .= $key . '="' . $value . '"';
			}

			$str = "<a";

			if($confirm)
			{
				$str .= " onclick=\"return confirm('" . trans('custom.asking_confirmation') . "');\"";
			}

			$str .= " href='" . route($route, $params) . "' data-toggle='tooltip' title='" . $tooltip . "' " . $attribute_txt . " ><i class='fa " . $icon . " fa-lg confirm-delete'></i></a>&nbsp;";

			return $str;

		}
		else
		{
			return "";
		}
	}

	function googleRecaptcha($value, $ip)
	{
		$response = json_decode(file_get_contents(env('GOOGLE_RECAPTCHA_URL') . "?secret=" . env('GOOGLE_RECAPTCHA_SECRET') . "&response=" . $value . "&remoteip=" . $ip), true);

		return $response['success'];
	}

	function sortingLink($name, $column, $default = NULL, $attributes = [])
	{
		$url    = URL::full();
		$urlArr = explode('?', $url);

		if(isset($urlArr[1]))
		{
			if(str_contains($urlArr[1], 'mt') && str_contains($urlArr[1], 'od'))
			{
				$params     = explode('&', $urlArr[1]);
				$new_params = '';
				$current_mt = '';
				$current_od = '';
				foreach($params as $param)
				{
					if(starts_with($param, 'mt='))
					{
						$mtArr      = explode('=', $param);
						$current_mt = $mtArr[1];
					}
					elseif(starts_with($param, 'od='))
					{
						$odArr      = explode('=', $param);
						$current_od = $odArr[1];
					}
					else
					{
						$new_params .= $param . '&';
					}
				}

				if($current_mt == $column)
				{
					$od   = $current_od == 'desc' ? 'asc' : 'desc';
					$icon = $current_od == 'desc' ? "&nbsp;<i class='fa fa-caret-down'></i>" : "&nbsp;<i class='fa fa-caret-up'></i>";
					$link = $urlArr[0] . "?" . $new_params . "mt=$column&od=$od";
				}
				else
				{
					$icon = '';
					$link = $urlArr[0] . "?" . $new_params . "mt=$column&od=desc";
				}

			}
			else
			{
				if($default)
				{
					$od   = $default == 'desc' ? 'asc' : 'desc';
					$icon = $default == 'desc' ? "&nbsp;<i class='fa fa-caret-down'></i>" : "&nbsp;<i class='fa fa-caret-up'></i>";
					$link = $url . "&mt=$column&od=$od";
				}
				else
				{
					$icon = '';
					$link = $url . "&mt=$column&od=desc";
				}
			}
		}
		else
		{
			if($default)
			{
				$od   = $default == 'desc' ? 'asc' : 'desc';
				$icon = $default == 'desc' ? "&nbsp;<i class='fa fa-caret-down'></i>" : "&nbsp;<i class='fa fa-caret-up'></i>";
				$link = $url . "?mt=$column&od=$od";
			}
			else
			{
				$icon = '';
				$link = $url . "?mt=$column&od=desc";
			}
		}

		$attribute_txt = '';
		foreach($attributes as $key => $value)
		{
			$attribute_txt .= $key . '="' . $value . '"';
		}

		$response = "<a href='$link' $attribute_txt>$name $icon</a>";

		return $response;
	}

	function get_filter_bar_validation()
	{
		$validation = [
			'page'         => 'digits_between:1,2',
			'display_type' => 'in:daily,monthly',
			'od'           => 'in:desc,asc',
			'status'       => 'in:ACTIVE,PENDING,SUSPEND,1,0',
			'mt'           => 'alpha|max:1',
			'st'           => 'in:any,exactly',
			'from'         => 'date_format:Y-m-d',
			'to'           => 'date_format:Y-m-d',
		];

		return $validation;
	}

	function find_soft_column($selected, $avaliable_list, $default)
	{
		$column = $default;
		foreach($avaliable_list as $key => $entry)
		{
			if($selected == $key)
			{
				$column = $entry;
			}
		}

		return $column;
	}

	function search_to_query($query, $search_str, $available_field, $st)
	{
		$query->where(function ($query) use ($search_str, $available_field, $st)
		{

			if($st == 'any')
			{
				$search_str_arr = explode(" ", $search_str);
				foreach($search_str_arr as $value)
				{
					foreach($available_field as $field)
					{
						$query->orWhere($field, 'like', '%' . $value . '%');
					}
				}
			}
			else
			{
				foreach($available_field as $field)
				{
					$query->orWhere($field, 'like', '%' . $search_str . '%');
				}
			}
		});

		return true;
	}

	function filterBar($filter_list, $export_route = NULL, $param = [])
	{
		$return_str = "<div class='filter_bar'>" . Form::Open(['role' => 'form', 'method' => 'get']);
		$return_str .= "<div class='row'><div class='col-sm-8'>";

		if(isset($filter_list['date']) && $filter_list['date']['enable'])
		{
			$return_str .= "From : " . Form::text('from', $filter_list['date']['from'], [
					'class' => 'datepicker input-inline input-xs',
					'style' => 'width:80px'
				]) . '&nbsp;&nbsp;';
			$return_str .= "To : " . Form::text('to', $filter_list['date']['to'], [
					'class' => 'datepicker input-inline input-xs',
					'style' => 'width:80px'
				]);
		}

		if(isset($filter_list['items']))
		{
			foreach($filter_list['items'] as $key => $entry)
			{
				$label = ucwords(str_replace('_', " ", $key));
				$return_str .= "&nbsp;&nbsp;$label : " . Form::select($key, $entry['list'], $entry['selected']);
			}
		}

		if(isset($filter_list['search']) && $filter_list['search']['enable'])
		{
			$return_str .= "<div class='row search-row'><div class='col-sm-5' style='padding-right: 0'>";
			$return_str .= Form::text('search', $filter_list['search']['value'], [
				'class'       => 'form-control input-xs',
				'placeholder' => 'Search',
				'id'          => 'search'
			]);
			$return_str .= "</div><div class='col-sm-7'>";
			$return_str .= "<label>" . Form::radio('st', 'any', $filter_list['search']['st'] == 'any' ? true : false) . "&nbsp;Any</label>";
			$return_str .= "&nbsp;&nbsp;<label>" . Form::radio('st', 'exactly', $filter_list['search']['st'] == 'exactly' ? true : false) . "&nbsp;Exactly</label>";
			$return_str .= "</div></div>";
		}

		$param_str = '?';
		foreach($param as $param_key => $param_value)
		{
			$return_str .= Form::hidden($param_key, $param_value);
			$param_str .= $param_key . '=' . $param_value . '&';
		}
		$param_str = substr($param_str, 0, - 1);

		$return_str .= "</div><div class='col-sm-4 text-right'><div class='btn-group' role='group'>";
		$return_str .= Form::submit('Filter', ['type' => 'button', 'class' => 'btn btn-xs btn-primary']);
		$return_str .= link_to(Request::url() . $param_str, 'Reset', ['type' => 'button', 'class' => 'btn btn-xs btn-default']);

		if( ! is_null($export_route))
		{
			$return_str .= "<div class='btn-group' role='group'>";
			$return_str .= "<button type='button' class='btn btn-xs btn-default dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
			$return_str .= "Export&nbsp;<span class='caret'></span></button><ul class='dropdown-menu'>";
			$return_str .= "<li>" . link_to_route($export_route, 'Excel 2007 (xlsx)', ['format' => 'xlsx']) . "</li>";
			$return_str .= "<li>" . link_to_route($export_route, 'Excel 5 (xls)', ['format' => 'xls']) . "</li>";
			$return_str .= "<li>" . link_to_route($export_route, 'CSV', ['format' => 'csv']) . "</li>";
			$return_str .= "</ul></div>";
		}

		$return_str .= "</div></div></div>";
		$return_str .= Form::Close() . "</div>";

		return $return_str;
	}

	function get_filter_date_from($from, $display_type = NULL, $to_string = false)
	{
		if($from == "")
		{
			if(isset($display_type) && $display_type == 'monthly')
			{
				$from = \Carbon\Carbon::now()->startOfMonth()->startOfDay();
			}
			else
			{
				$from = \Carbon\Carbon::now()->subYear()->startOfDay();
			}

		}
		else
		{
			if(isset($display_type) && $display_type == 'monthly')
			{
				$from = \Carbon\Carbon::parse($from)->startOfMonth()->startOfDay();
			}
			else
			{
				$from = \Carbon\Carbon::parse($from)->startOfDay();
			}
		}

		if($to_string)
		{
			return $from->toDateTimeString();
		}
		else
		{
			return $from;
		}
	}

	function get_filter_date_to($to, $display_type = NULL, $to_string = false)
	{
		if($to == "")
		{
			if(isset($display_type) && $display_type == 'monthly')
			{
				$to = \Carbon\Carbon::now()->endOfMonth()->endOfDay();
			}
			else
			{
				$to = \Carbon\Carbon::now()->endOfDay();
			}


		}
		else
		{
			if(isset($display_type) && $display_type == 'monthly')
			{
				$to = \Carbon\Carbon::parse($to)->endOfMonth()->endOfDay();
			}
			else
			{
				$to = \Carbon\Carbon::parse($to)->endOfDay();
			}
		}

		if($to_string)
		{
			return $to->toDateTimeString();
		}
		else
		{
			return $to;
		}
	}