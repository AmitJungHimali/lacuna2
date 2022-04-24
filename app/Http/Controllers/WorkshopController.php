<?php

namespace App\Http\Controllers;

use App\Models\workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\WorkshopResource;
use Illuminate\Support\Facades\Auth;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'this is get';
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
        $id=Auth::id();
        
        $validator = Validator::make($request->all(),[
        'banner'=>['required'],
        'title'=>['required'],
        'descriptionTitle'=>['required'],
        'description'=>['required'],
        'objectivesTitle'=>['required'],
        'objectiveDescription'=>['required'],
        'rank'=>['required','numeric'],
        'status'=>['required','boolean'],
        'benefitTitle'=>['required'],
        'benefitDescription'=>['required']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors() , 422);
        }
        $request['user_id']=$id;
        $workshop=Workshop::create($request->all());
        

        return new WorkshopResource($workshop);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   $work=Workshop::findOrFail($id);
            return new WorkshopResource($work);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $workshop=Workshop::findOrFail($id);
        if($workshop->user_id==Auth::id()){
            $validator = Validator::make($request->all(),[
                'banner'=>['required'],
                'title'=>['required'],
                'descriptionTitle'=>['required'],
                'description'=>['required'],
                'objectivesTitle'=>['required'],
                'objectiveDescription'=>['required'],
                'rank'=>['required','numeric'],
                'status'=>['required','boolean'],
                'benefitTitle'=>['required'],
                'benefitDescription'=>['required']
                ]);
                if ($validator->fails()) {
                    return response()->json($validator->errors() , 422);
                }
                $workshop=Workshop::findOrFail($id);
                $workshop->fill($request->all());
                $workshop->save();
                $updatedwork=Workshop::findOrFail($id);
            return new WorkshopResource($updatedwork);
        }
        return response()->json([
            'message'=>'you are not owner of this workshop'
        ],401);
        
            
            
            
            
            
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $workshop=Workshop::findOrFail($id);
        if($workshop->user_id==$user->id){
            $work=Workshop::whereId($id)->delete();
            $return = ["status" => "Success",
                    "error" => [
                        "code" => 200,
                        "errors" => 'Deleted'
                                ]
                        ];
                return response()->json($return, 200);
        }
        return response()->json([
            'message'=>'You are not authenticated to delet this workshop'
        ],401);
        

    }
}
