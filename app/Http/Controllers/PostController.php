<?php

namespace App\Http\Controllers;

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
        $userId = Auth::id();
        $data = array();
        $jdata = Post::all()->where('user_id',$userId);
        $data = json_decode($jdata);
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return view('Profile',['data' =>array_reverse($data)]);
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

    private function saveImage($request){
        $request->validate([
            'image' => 'mimes:jpeg,bmp,png,jpg',
        ]);
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
    
    public function store(Request $request)
    {
        if ($request->image != null) {
            $imgName = $this->saveImage($request);
            Post::create([
                'content' => $request->content,
                'user_id' => Auth::user()->id,
                'image' => $imgName,
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
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
    }
}
