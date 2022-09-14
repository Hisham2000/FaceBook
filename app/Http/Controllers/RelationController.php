<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\relation;
use Illuminate\Database\Eloquent\Relations\Relation as RelationsRelation;
use Illuminate\Http\Request;
use PhpParser\Node\Name\Relative;
use Symfony\Component\VarDumper\VarDumper;

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
        ->select('users.id','users.name','users.email','users.bdate','users.gender','users.user_image')
        ->where('friend_id',Auth::user()->id)->where('request',0)->
        whereNotIn('sender',[Auth::user()->id])->get();
        
        
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
            'request' => 0,
            'sender' => Auth::user()->id,
        ]);

        Relation::create([
            'friend_id' => $request->user_id,
            'user_id' => $request->friend,
            'request' => 0,
            'sender' => Auth::user()->id,
        ]);

        return redirect()->route('user.show',$request->friend);
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
    public function update(Request $request,$id)
    {

        $relation = Relation::where(function($query){
            $query->where('friend_id',Auth::user()->id)
            ->orWhere('user_id',Auth::user()->id);
        })->update(['request'=>1]);

        return redirect()->route('relation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\relation  $relation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $relation1 = Relation::query()->where('user_id',$id)->
        where('friend_id',Auth::user()->id)->delete();

        $relation2 = Relation::query()->where('friend_id',$id)->
        where('user_id',Auth::user()->id)->delete();
        
        return redirect()->route('relation.index');
    }
}