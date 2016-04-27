<?php

namespace App\Http\Controllers;
use App\posts;
use App\User;
use App\comments;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Controller
{
	public function __construct()
    {
       // $this->middleware('auth');
    }
    public function index()
    {
        return view('welcome');    
    }
    
    public function blog(){
        $posts = posts::where('status','publish')->orderBy('created_at','desc')->paginate(5);
        $title = 'Latest Posts';
        return view('blog')->withPosts($posts)->withTitle($title);
    }
    public function show($slug)
  	{
	    $post = Posts::where('slug',$slug)->first();
		if(!$post)
			{
	   		return redirect('/')->withErrors('requested page not found');
		}
		$comments = $post->comments;
		return view('show')->withPost($post)->withComments($comments);
 	}

}
