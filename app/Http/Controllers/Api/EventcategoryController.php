<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Eventcategory;
use Illuminate\Http\Request;

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
        $this -> validate($request,[
            'title'=>'required',
            'status'=>'required',

        ]);
        $category = new Eventcategory();
        $category->title = $request->title;
        $category->status = $request->status;
        $category->save();
        return response()->json(['message','data saved successfully']);
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
        $this -> validate($request,[
            'title'=>'required',
            'status'=>'required',

        ]);
        $category = Eventcategory::find($id);
        $category->title = $request->title;
        $category->status = $request->status;
        $category->save();
        return response()->json(['message','data update successfully']);
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
