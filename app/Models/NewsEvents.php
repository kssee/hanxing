<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class NewsEvents extends Model
{
	protected $dates = ['activity_date'];

	public function setActivityDateAttribute($value)
	{
		$this->attributes['activity_date'] = Carbon::parse($value);
	}
}
