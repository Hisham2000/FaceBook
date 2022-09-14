<?php

namespace App\Http\Controllers;

use App\Models\like;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all()->where('user_id',Auth::user()->id);
        $likes = like::all();
        $likes = json_decode(json_encode($likes),true);
        $posts = json_decode(json_encode($posts),true);

        return view('Profile',[
            'posts' =>array_reverse($posts),
            'like' => $likes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    
    
    public function store(Request $request)
    {
        if ($request->image != null) {
            $imgName = $this->saveImage($request);
            Post::create([
                'content' => $request->content,
                'user_id' => Auth::user()->id,
                'post_image' => $imgName,
            ]);
        }
        else{
            Post::create([
                'content' => $request->content,
                'user_id' => Auth::user()->id,
            ]);
        }
        return redirect()->route('posts.index');
    }

    

    private function saveImage($request){
        $request->validate([
            'image' => 'mimes:jpeg,bmp,png,jpg',
        ]);    
        $id = $this->getTheLastId();
        $cover = $request->file('image');
        $extension = $cover->getClientOriginalExtension();
        $imgName = Auth::user()->id." ".$id.'.'.$extension;
        $request->image->move(public_path('assets/Post_image'), $imgName);
        return $imgName;
    }

    private function getTheLastId(){
        $userId = Auth::id();
        $data = array();
        $jdata = Post::all()->where('user_id',$userId);
        $data = json_decode($jdata);
        $id = null;
        foreach($data as $value){
            $id = $value->id + 1;
        }
        return $id;
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::all()->where('post_id',$id)->first();
        $post = json_decode(json_encode($post),true);
        // echo "<pre>";
        // print_r($post);
        // echo "</pre>";
        return view('EditPost',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $postid)
    {
        $post = Post::find($postid);

        if($request->image != null){
            $imgName = $this->getImageName();
            $imgName = $this->saveImage($request);

            $post->content = $request->content;
            $post->post_image  = $imgName;
            $post->update();
        }
        else{
            $post->update([
                'content' => $request->content,
            ]);
        }
        
        return redirect()->route('posts.index');
    }

    private function getImageName(){
        $id = Auth::user()->id;
        $imgpath = glob(public_path("assets/User_image/$id.*"));
        $imgpath = implode(" ",$imgpath);
        $ext= pathinfo($imgpath,PATHINFO_EXTENSION); 
        return Auth::user()->id.".".$ext;
    }


    public function makePostPrivate(Request $request)
    {
        $post = Post::where('user_id',$request->id)->update(['isprivate' => 1]);
        return redirect()->route('posts.index');
    }

    public function makePostPublic(Request $request)
    {
        $post = Post::where('user_id',$request->id)->update(['isprivate' => 0]);
        return redirect()->route('posts.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($postid)
    {
        $post = Post::query()->where('id',$postid)->delete();
        return redirect()->route('posts.index');
    }
}
