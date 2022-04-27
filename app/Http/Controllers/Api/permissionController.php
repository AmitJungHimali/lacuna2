<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class permissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $permission=Permission::all();
        return response()->json($permission,200);


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
                "permission"=>"required",
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }
            $permission= new Permission();
            $permission ->permission = $request->permission;
            $permission ->screen = $request->screen;
            $permission ->role_id = $request->role_id;
            $permission->save();
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
            $permission= Permission::findOrFail($id);
            $validator = Validator::make($request->all(),[
                "permission"=>"required",
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }
            $permission= Permission::find($id);
            if($permission)
            {
                $permission ->permission = $request->permission;
                $permission ->screen = $request->screen;
                $permission ->role_id = $request->role_id;
                $permission->save();
                DB::commit();
                return response()->json(['message','Data update Successful',200]);
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
        $permission=Permission::find($id);
        if($permission)
        {
            $permission->delete();
            return response()->json(['message','Data Deleted Successful']);
        }
        else
        {
            return response()->json(['message','Record not found']);
        }


    }
}
