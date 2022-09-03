<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\post;
use App\Models\relation;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::all()->where('id',$id)->first();
        $user = json_decode(json_encode($user),true);

        $posts = Post::all()->where('user_id',$id);
        $posts = json_decode(json_encode($posts),true);

        $relation = Relation::all()->where('user_id',Auth::user()->id)
        ->where('friend_id',$id);
        
        $relation = json_decode(json_encode($relation, true));
        if(empty($relation)) $relation = false;
        else $relation = true;

        return view('friends',[
            'posts' => $posts,
            'user' => $user,
            'relation' => $relation,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userId = Auth::user()->id;
        $data = array();
        $jdata = User::all()->where('id',$userId);
        $data = json_decode($jdata);
        return view('edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    

    public function update(Request $request, $userId)
    {
        $user = User::find($userId);
        if ($request->image != null) {
            $imgName = $this->saveImage($request);
            $user->name = $request->name;
            $user->email  = $request->email;
            $user->image  = $imgName;
            $user->update();
        }
        else{
            echo $request->name;
            echo $request->email;
            echo $request->password;
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }
        return redirect()->route('posts.index');
    }

    private function saveImage($request){
        $request->validate([
            'image' => 'mimes:jpeg,bmp,png,jpg',
        ]);     
        $cover = $request->file('image');
        $extension = $cover->getClientOriginalExtension();
        $imgName = Auth::user()->id.'.'.$extension;
        $request->image->move(public_path('assets/User_image'), $imgName);
        return $imgName;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searching(Request $request)
    {
        $id = $request->search;
        $jdata = null;
        $flag=0;
        if($id != null)
        {
            if(filter_var($id, FILTER_VALIDATE_EMAIL)) 
            {
                $id = filter_var($id,FILTER_SANITIZE_EMAIL);
                $jdata = User::all()->where('email',$id);
                $flag++;
            }
            else
            {
                $jdata = User::all()->where('name',$id);
                $data = json_decode($jdata);
                if($data != null)
                $flag++;
            }
        }
        if($flag == 0)
        {
            $jdata = User::all();
        }
        $data = json_decode($jdata);
        return view('search',['data'=>$data]);  
    }
}