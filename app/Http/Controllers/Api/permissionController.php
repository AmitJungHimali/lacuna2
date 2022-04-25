<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        try
        {
            $this->validate($request,[
                "permission"=>"required",

            ]);
            $permission= new Permission();
            $permission ->permission = $request->permission;
            $permission ->screen = $request->screen;
            $permission ->role_id = $request->role_id;
            $permission->save();
            DB::commit();
            return response()->json(['message','Data save Successful']);
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
        $permission = Permission::find($id);
        return response()->json($permission);
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
            $this->validate($request,[
                "permission"=>"required",

            ]);
            $permission= Permission::find($id);
            $permission ->permission = $request->permission;
            $permission ->screen = $request->screen;
            $permission ->role_id = $request->role_id;
            $permission->save();
            DB::commit();
            return response()->json(['message','Data update Successful']);
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
        $permission=Permission::findOrFail($id);
        $permission->delete();
        return response()->json(['message','Data Deleted Successful']);

    }
}
