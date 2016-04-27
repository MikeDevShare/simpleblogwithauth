<?php

namespace App\Http\Controllers;
use App\posts;
use App\User;
use App\categories;
use DB;
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
    public function dash(Request $request){
     if($request->user()->can_post())
      {
        return view('dash');
      }    
      else 
      {
        return redirect('/')->withErrors('You have not sufficient permissions for writing post');
      } 
      
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
        return redirect('dashboard/edit/'.$post->slug)->withMessage($message);
    }
    public function edit(Request $request,$slug)
    {
        $post = Posts::where('slug',$slug)->first();

        if( $post && ($request->user()->id == $post->author_id || $request->user()->is_admin()) )
          return view('edit')->with('post',$post);
        return redirect('/dashboard')->withErrors('you have not sufficient permissions');
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
              return redirect('dashboard/edit/'.$post->slug)->withErrors('Title already exists.')->withInput();
            }
            else 
            {
              $post->slug = $slug;
            }
          }
          $post->post_title = $title;
          $post->post_content = $request->input('body');
          if($request->has('save'))
          {
            $post->status = 'pending';
            $message = 'Post saved successfully';
            $landing = 'dashboard/edit/'.$post->slug;
          }            
          else {
            $post->status = 'publish';
            $message = 'Post updated successfully';
            $landing = $post->slug;
          }
          $post->save();
               return redirect($landing)->withMessage($message);
        }
        else
        {
          return redirect('/dashboard')->withErrors('you have not sufficient permissions');
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
        return redirect('/dashboard')->with($data);
    }
    public function categories(Request $request){
       if($request->user()->can_post())
       {
        $data['cats'] = DB::table('categories')->get();
    
        return view('categories',$data);
      }    
      else 
      {
        return redirect('/dashboard')->withErrors('You have not sufficient permissions for writing cats');
      }
    }
    public function cat_add(Request $request){

      $category = new Categories();
      $category->title = $request->get('title');
      $category->slug = str_slug($request->title);
      $category->description = $request->get('body');
      $category->save();
      return redirect('/dashboard/categories');
    }
    public function get_cat(Request $request){
      $cat_id = $request->get('cat_id');
      
      if($request->user()->can_post())
       {
        $result['success'] = true;
        $db = DB::table('categories')->where('id',$cat_id)->get();   
        $result['title'] = $db[0]->title;
        $result['body'] = $db[0]->description;
      }    
      else 
      {
        $result['success'] = false;
        $result['error'] = '<p>You have not sufficient permissions for writing cats</p>';
      }
      return json_encode($result);
    }
    public function edit_cat(Request $request){
      $category = $category = Categories::find($request->get('cat_id'));
      if($category && $request->user()->can_post() )
      {
        $category->id = $request->get('cat_id');
        $category->title = $request->get('title');
        $category->slug = str_slug($request->title);
        $category->description = $request->get('body');
        $category->save();
        $result = array(
          'success' => true,
          'message' => '<p>Category update successfully</p>'
          );
      }else{
        $result = array(
          'success' => false,
          'message' => '<p>Some error ocurred</p>'
          );
      }
     
      return json_encode($result);
    }
    public function destroy_cat(Request $request)
    {
      $cat_id = $request->get('cat_id');
      $category = Categories::find($cat_id);
       if($category && $request->user()->can_post() )
        {
          $category->delete();
          $result= array(
            'success' => true,
            'message' => 'Category deleted Successfully',
            );
        }
        else 
        {
          $result= array(
            'errors' => true,
            'message' => 'Invalid Operation. You have not sufficient permissions',
            );
        }
        return redirect('/dashboard/categories');
    }
}
