<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class SystemInformation extends Model {
		protected $table      = 'system_information';
		protected $hidden     = [
			'password',
		];

		public function setPasswordAttribute($value)
		{
			$this->attributes['password'] = bcrypt($value);
		}
	}
