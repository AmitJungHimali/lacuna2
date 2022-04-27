<?php

namespace App\Http\Controllers;

use App\Models\team;
use Illuminate\Http\Request;
use App\Http\Resources\TeamResource;
use Illuminate\Support\Facades\Validator;


class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TeamResource::collection(team::paginate(5));
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
        $validator=Validator::make($request->all(),[
            'image'=>['required','image'],
            'name'=>['required'],
            'designation'=>['required'],
            'quotes'=>['required'],
            'status'=>['required','boolean'],
            'rank'=>['required','numeric']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors() , 422);
        }
        $team=team::create($request->all());
        if ($request->hasFile('image')){
            $team->addMediaFromRequest('image')->toMediaCollection('images');
        }
        $team->save();
        return new TeamResource($team);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\team  $team
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team=team::findOrFail($id);
       
        return new TeamResource($team);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\team  $team
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $validator=Validator::make($request->all(),[
            'image'=>['image'],
            'name'=>['required'],
            'designation'=>['required'],
            'quotes'=>['required'],
            'status'=>['required','boolean'],
            'rank'=>['required','numeric']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors() , 422);
        }
        
        $team=team::findOrFail($id);
        $team->fill($request->all());
        if($request->hasFile('image')){
            $team->clearMediaCollection('images');  //while sending update request use send POST ,_method=PUT like this localhost:8000/api/team/10?_method=PUT&name=333&rank=4&status=1&designation=333&quotes=33
            $team->addMediaFromRequest('image')->toMediaCollection('images');
        }
            
        $team->save();
        return new TeamResource($team);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Team::whereId($id)->delete();
        $return = ["status" => "Success",
                "error" => [
                    "code" => 200,
                    "errors" => 'Deleted successfully'
                            ]
                    ];
            return response()->json($return, 200);
    }
}
