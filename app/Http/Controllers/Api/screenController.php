<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Screen;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class screenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Screen::all();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $validator = Validator::make($request->all(),[
                "screens"=>"required",

            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }
            $screen= new Screen();
            $screen ->screens = $request->screens;
            $screen->save();
            DB::commit();
            return response()->json(['message','Data save Successful',200]);
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'status' => 422
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $screen = Screen::find($id);
        return response()->json($screen);
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
        DB::beginTransaction();
        try
        {
            $validator = Validator::make($request->all(),[
                "screens"=>"required",

            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }
        $screen= Screen::find($id);
        if($screen)
        {
            $screen ->screens = $request->screens;
            $screen->save();
            DB::commit();
            return response()->json(['message','Data Update Successful',200]);
        }
        else
        {
            return response()->json(['message','Record not found']);
        }

        }
        catch(Exception $e)
        {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'status' => 422
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $screen=Screen::find($id);
        if($screen)
        {
            $screen->delete();
        return response()->json(['message','Data Deleted Successful']);
        }
        else
        {
            return response()->json(['message','Record not found']);
        }

    }
}
