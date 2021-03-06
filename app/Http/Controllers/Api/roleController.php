<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class roleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Role::all();
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
        DB::begintransaction();
        try{
            $this->validate($request,[
                "role"=>"required",

            ]);
            $role= new Role();
            $role ->role = $request->role;
            $role->save();
            DB::commit();
           return response()->json(['message','data save successflly']);
        }

        Catch(Exception $e)
        {
            DB::rollback();
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
       $role = Role::find($id);
       return response()->json($role);
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
        DB::begintransaction();
        try{
            $this->validate($request,[
                "role"=>"required",

            ]);
            $role= Role::find($id);
            $role ->role = $request->role;
            $role->save();
            DB::commit();
           return response()->json(['message','data update successflly']);
        }

        Catch(Exception $e)
        {
            DB::rollback();
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
        $role=Role::findOrFail($id);
        $role->delete();
        return response()->json(['message','Data Deleted Successful']);
    }
}
