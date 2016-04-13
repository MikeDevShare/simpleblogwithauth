<?php

namespace App\Http\Controllers;
use App\posts;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');    
    }
    public function blog(){
        $posts = posts::where('status','publish')->orderBy('created_at','desc')->paginate(5);
        $title = 'Latest Posts';
        return view('blog')->withPosts($posts)->withTitle($title);
    }
    public function create(Request $request)
    {
        // if user can post i.e. user is admin or author
        if($request->user()->can_post())
        {
          return view('create');
        }    
        else 
        {
          return redirect('/')->withErrors('You have not sufficient permissions for writing post');
        }
    }
    public function store(Request $request)
    {
        $post = new Posts();
        $post->post_title = $request->get('title');
        $post->post_content = $request->get('body');
        $post->slug = str_slug($post->post_title);
        $post->author_id = $request->user()->id;
        $post->category = 1;
        if($request->has('save'))
        {
          $post->status = 'pending';
          $message = 'Post saved successfully';            
        }            
        else 
        {
          $post->status = 'publish';
          $message = 'Post published successfully';
        }
        $post->save();
        return redirect('edit/'.$post->slug)->withMessage($message);
    }
    public function edit(Request $request,$slug)
    {
        $post = Posts::where('slug',$slug)->first();
        if( $post && ($request->user()->id == $post->author_id || $request->user()->is_admin()) )
          return view('edit')->with('post',$post);
        return redirect('/')->withErrors('you have not sufficient permissions');
    }
    public function update(Request $request)
    {
        //
        $post_id = $request->input('post_id');
        $post = Posts::find($post_id);
        if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
        {
          $title = $request->input('title');
          $slug = str_slug($title);
          $duplicate = Posts::where('slug',$slug)->first();
          if($duplicate)
          {
            if($duplicate->id != $post_id)
            {
              return redirect('edit/'.$post->slug)->withErrors('Title already exists.')->withInput();
            }
            else 
            {
              $post->slug = $slug;
            }
          }
          $post->title = $title;
          $post->post_content = $request->input('body');
          if($request->has('save'))
          {
            $post->active = 0;
            $message = 'Post saved successfully';
            $landing = 'edit/'.$post->slug;
          }            
          else {
            $post->active = 1;
            $message = 'Post updated successfully';
            $landing = $post->slug;
          }
          $post->save();
               return redirect($landing)->withMessage($message);
        }
        else
        {
          return redirect('/')->withErrors('you have not sufficient permissions');
        }
    }
    public function destroy(Request $request, $id)
    {
    //
        $post = Posts::find($id);
        if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
        {
          $post->delete();
          $data['message'] = 'Post deleted Successfully';
        }
        else 
        {
          $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
        }
        return redirect('/')->with($data);
    }
}
