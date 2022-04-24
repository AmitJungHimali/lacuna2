<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class permissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Permission::all();
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
        $this->validate($request,[
            "permission"=>"required",

        ]);
        $permission= new Permission();
        $permission ->permission = $request->permission;
        $permission ->screen = $request->screen;
        $permission ->role_id = $request->role_id;
        $permission->save();
        return response()->json(['message','Data save Successful']);
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

        $this->validate($request,[
            "permission"=>"required",

        ]);
        $permission= Permission::find($id);
        $permission ->permission = $request->permission;
        $permission ->screen = $request->screen;
        $permission ->role_id = $request->role_id;
        $permission->save();
        return response()->json(['message','Data update Successful']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission=Permission::findOrFail($id);
        $permission->delete();
        return response()->json(['message','Data Deleted Successful']);

    }
}
