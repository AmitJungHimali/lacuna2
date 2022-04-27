<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Privilege;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class privilegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Privilege::all();
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
                "privilege"=>"required",
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }
            $privilege= new Privilege();
            $privilege ->privilege = $request->privilege;
            $privilege->save();
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
        $privilege = Privilege::find($id);
        return response()->json($privilege);
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
                "privilege"=>"required",
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }

            $privilege= Privilege::find($id);
            if($privilege)
            {
            $privilege ->privilege = $request->privilege;
            $privilege->save();
            DB::commit();
            return response()->json(['message','Data update Successful',200]);

            }
            else{
                return response()->json(["message",'Record Not found']);
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
        $privilege=Privilege::find($id);
        if($privilege)
        {
            $privilege->delete();
        return response()->json(['message','Data Deleted Successful']);
        }
        else
        {
            return response()->json(['message','Record not found']);
        }


    }
}
