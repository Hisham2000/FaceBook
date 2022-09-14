<?php

namespace App\Http\Controllers;

use App\Models\like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\post;
use App\Models\relation;
use Illuminate\Support\Facades\DB;
use PhpParser\JsonDecoder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = DB::table('users')->
        join('relations','relations.user_id','users.id')->
        join('posts','posts.user_id', 'users.id')->
        where("posts.isprivate",0)->
        where("relations.request",1)->
        get();

        $likes = like::all()->where('user_id',Auth::user()->id);
        $likes = json_decode(json_encode($likes),true);

        $allData = json_decode(json_encode($allData),true);

        $relatedPosts = array();


        $temp = array_unique(array_column($allData, 'id'));
        $unique_arr = array_intersect_key($allData, $temp);
        sort($unique_arr);
        sort($likes);
        for($i = 0 ; $i<count($unique_arr); $i++)
        {
            if($unique_arr[$i]['friend_id'] == Auth::user()->id || $unique_arr[$i]['user_id'] == Auth::user()->id)
            {
                array_push($relatedPosts,$unique_arr[$i]);
            }
        }
        
        for($i= 0; $i < count($relatedPosts); $i++)
        {
            for($j=0; $j<count($likes); $j++)
            {
                if($relatedPosts[$i]['post_id'] == $likes[$j]['post_id'])
                    array_push($relatedPosts[$i],1);

            }
        }

        
        return view('main',[
            'posts'=>$relatedPosts,
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

        $posts = Post::all()->where('user_id',$id)->where('isprivate',0);
        $posts = json_decode(json_encode($posts),true);

        $relation = Relation::where(function($query){
            $query->where('friend_id',Auth::user()->id)
            ->orWhere('user_id',Auth::user()->id);
        })->get()->first();
        $relation = json_decode(json_encode($relation),true);
        

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
        $user = User::all()->where('id',Auth::user()->id)->first();
        $user = json_decode(json_encode($user),true);
        return view('edit',['user'=>$user]);
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
        $this->validation($request);

        $user = User::find($userId);

        if($request->image != null){
            $imgName = $this->getimageName();
            $imgName = $this->saveImage($request);

            $user->name = $request->name;
            $user->email  = $request->email;
            $user->user_image  = $imgName;
            $user->update();
        }
        else{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }
        
        return redirect()->route('posts.index');
    }

    private function validation($request){
        if($request->email == Auth::user()->email){
            $request->validate([
                'image' => 'mimes:jpeg,bmp,png,jpg',
                'name' => 'min:10',
            ]);
        }
        else {
            $request->validate([
                'image' => 'mimes:jpeg,bmp,png,jpg',
                'email' => 'email|unique:users',
                'name' => 'min:10',
            ]);
        }

    }

    private function getimageName(){
        $id = Auth::user()->id;
        $imgpath = glob(public_path("assets/User_image/$id.*"));
        $imgpath = implode(" ",$imgpath);
        $ext= pathinfo($imgpath,PATHINFO_EXTENSION); 
        return Auth::user()->id.".".$ext;
    }

    private function saveImage($request){
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