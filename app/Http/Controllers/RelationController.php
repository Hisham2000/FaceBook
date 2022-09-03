<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\relation;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = Relation::join('users','users.id','=','relations.user_id')
        ->select('users.id','users.name','users.email','users.bdate','users.gender','users.image')
        ->where('friend_id',Auth::user()->id)->get();
        
        // $friends = Relation::all()->where('friend_id',Auth::user()->id)
        // ->where('request',1);

        $friends = json_decode(json_encode($friends), true);        

        return view('friendRequest',['friends' => $friends]);
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
        Relation::create([
            'user_id' => $request->user_id,
            'friend_id' => $request->friend,
            'request' => 1,
        ]);
        return redirect()->route('user.show',$request->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\relation  $relation
     * @return \Illuminate\Http\Response
     */
    public function show(relation $relation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\relation  $relation
     * @return \Illuminate\Http\Response
     */
    public function edit(relation $relation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\relation  $relation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, relation $relation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\relation  $relation
     * @return \Illuminate\Http\Response
     */
    public function destroy(relation $relation)
    {
        //
    }
}
