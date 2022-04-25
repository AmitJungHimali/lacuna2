<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Eventcategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Eventcategory::all();
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
            $this -> validate($request,[
                'title'=>'required',
                'status'=>'required',

            ]);
            $category = new Eventcategory();
            $category->title = $request->title;
            $category->status = $request->status;
            $category->save();
            DB::commit();
            return response()->json(['message','data saved successfully']);
        }
        catch(Exception $e)
        {
            DB::rollBack();
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
        $category = Eventcategory::find($id);
        return response()->json($category);

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
        try{
            $this -> validate($request,[
                'title'=>'required',
                'status'=>'required',

            ]);
            $category = Eventcategory::find($id);
            $category->title = $request->title;
            $category->status = $request->status;
            $category->save();
            DB::commit();
           return response()->json(['message','data update successflly']);
        }
        catch(Exception $e)
        {
            DB::rollBack();
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
        $category = Eventcategory::find($id);
        $category -> delete();
        return response()->json(['message','data update successfully']);
    }
}
