<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramResource;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

            'title' => ['required'],
            'description' => ['required'],

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors() , 422);
        }
        $request['user_id']=$id;
        $program= Program::create($request->all());
        return response()->json($program);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $program = Program::findOrFail($id);

            $validator = Validator::make($request->all(),[
                'title' => ['required'],
                'description' => ['required'],

            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors() , 422);
            }
            $program=Program::findOrFail($id);
            $program->fill($request->all());
            $program->save();
                // $updatedprogram=Program::findOrFail($id);
                return new ProgramResource($program);

        return response()->json([
            'message'=>'Fail to update'
        ],401);

            // $request['user_id']=$id;
            // $program= Program::create($request->all());
            // return response()->json($program);
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
}
