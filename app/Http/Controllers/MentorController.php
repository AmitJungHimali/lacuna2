<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;
use App\Http\Resources\MentorResource;
use Illuminate\Support\Facades\Validator;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MentorResource::collection(Mentor::paginate(5));
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
            'name'=>['required'],
            'designation'=>['required'],
            'quotes'=>['required'],
            'image'=>['required']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors() , 422);
        }

        $mentor=Mentor::create($request->all());
        $mentor->addMediaFromRequest('image')->toMediaCollection('images');
        $mentor->save();
        return new MentorResource($mentor);    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $ment=Mentor::findOrFail($id);
       return new MentorResource($ment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\Http\Response
     */
    public function edit(Mentor $mentor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //no mechanism to chekc if mentor was created by a user, no user_id used.
        $validator=Validator::make($request->all(),[
            'name'=>['required'],
            'designation'=>['required'],
            'quotes'=>['required']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors() , 422);
        }
        $ment=Mentor::findOrFail($id);
        $ment->fill($request->all());
        if($request->hasFile('image')){
            $ment->clearMediaCollection('images');
            $ment->addMediaFromRequest('image')->toMediaCollection('images');
        }
        $ment->save();
        return new MentorResource($ment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   $mentor=Mentor::findOrFail($id);
        $mentor->clearMediaCollection('images');
        $mentor->delete();
        
        $return = ["status" => "Success",
                "error" => [
                    "code" => 200,
                    "errors" => 'Deleted successfully'
                            ]
                    ];
            return response()->json($return, 200);
    }
}
