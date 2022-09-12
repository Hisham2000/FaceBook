<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\post;
use App\Models\relation;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all posts that makes public and the owner of the post with his data
        $allData = DB::table('users')->
        join('posts','posts.user_id', 'users.id')
        ->where('posts.isprivate',0)
        ->get();

        $relation = Relation::all();

        $allData = json_decode(json_encode($allData),true);
        $relation = json_decode(json_encode($relation),true);

        // match posts with friend data
        for($j=0; $j<count($relation);$j++)
        {
            for($i=0 ; $i<count($allData);$i++)
            {
                if(($allData[$j]['id'] == $relation[$j]['user_id']
                ||$allData[$j]['id'] == $relation[$j]['friend_id'])
                && $relation[$j]['request']==1 )
                {
                    echo $allData[$j]['content']."<br>";
                }
            }
        }
        
            

        echo "<pre>";
        print_r($allData);
        echo "</pre>";

        echo "<pre>";
        print_r($relation);
        echo "</pre>";
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
            $user->image  = $imgName;
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