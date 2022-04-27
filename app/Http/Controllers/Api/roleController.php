<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
            $validator = Validator::make($request->all(),[
                "role"=>"required",
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }
            $role= new Role();
            $role ->role = $request->role;
            $role->save();
            // dd($request->permission);
            // $role->permissions()->sync([$request->permission]);
            $role->permissions()->sync(3);
            DB::commit();
           return response()->json(['message','data save successflly',200]);
        }

        Catch(Exception $e)
        {
            DB::rollback();
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

            $validator = Validator::make($request->all(),[
                "role"=>"required",
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }
            $role= Role::find($id);
            if($role)
            {
                $role ->role = $request->role;
                $role->save();
                DB::commit();
               return response()->json(['message','data update successflly',200]);
            }
            else
            {
                return response()->json(['message','Record not found']);
            }

        }

        Catch(Exception $e)
        {
            DB::rollback();
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
        $role=Role::find($id);
        if($role)
        {
            $role->delete();
        return response()->json(['message','Data Deleted Successful']);
        }
        else
        {
            return response()->json(['message','Record not found']);
        }

    }
}
