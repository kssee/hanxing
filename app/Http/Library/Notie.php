<?php
	namespace App\Http\Library;

	class Notie {

		public static function success($message = 'Successful', $second = 1.5)
		{
			self::set('alert', 1, $message, $second);

			return true;
		}

		public static function warning($message = 'Warning', $second = 2)
		{
			self::set('alert', 2, $message, $second);

			return true;
		}

		public static function error($message = 'Error', $second = 2.5)
		{
			self::set('alert', 3, $message, $second);

			return true;
		}

		public static function info($message = 'Info', $second = 2)
		{
			self::set('alert', 4, $message, $second);

			return true;
		}

		public static function set($type, $level, $message, $second)
		{
			session()->flash('notie_flag', true);
			session()->flash('notie_type', $type);
			session()->flash('notie_level', $level);
			session()->flash('notie_message', $message);
			session()->flash('notie_second', $second);
		}
	}