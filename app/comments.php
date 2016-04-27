<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    //comments table in database
	protected $guarded = [];
	// user who has commented
	public function author()
	{
	return $this->belongsTo('App\User','from_user');
	}
	// returns post of any comment
	public function post()
	{
	return $this->belongsTo('App\posts','post_id');
	}

}
