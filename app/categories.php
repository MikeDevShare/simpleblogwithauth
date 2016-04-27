<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
	protected $guarded = [];

    public function cats()
	{
		return $this->belongsTo('App\posts','category');
	}
}
