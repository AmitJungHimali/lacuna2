<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Privilege;
use Illuminate\Http\Request;

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
        $this->validate($request,[
            "privilege"=>"required",

        ]);
        $privilege= new Privilege();
        $privilege ->privilege = $request->privilege;
        $privilege->save();
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
        // $this->validate($request,[
        //     "privilege"=>"required",

        // ]);
        $privilege= Privilege::find($id);
        $privilege ->privilege = $request->privilege;
        $privilege->save();
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
        $privilege=Privilege::findOrFail($id);
        $privilege->delete();
        return response()->json(['message','Data Deleted Successful']);

    }
}
