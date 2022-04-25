<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Membership::all();
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
            $this ->validate($request,[
                'title'=>'required',
                'description'=>'required',
                'membershipPlan'=>'required',
                'price'=>'required',
                'rank'=>'required'
            ]);
            $membership = new Membership();
            $membership->title = $request->title;
            $membership->description = $request->description;
            $membership->membershipPlan = $request->membershipPlan;
            $membership->price = $request->price;
            $membership->rank = $request->rank;
            $membership->save();
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
        $membership = Membership::find($id);
        return response()->json($membership);
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
        $membership = Membership::where('id','=',$id)->first();
        $membership->title = $request->title;
        $membership->description = $request->description;
        $membership->membershipPlan = $request->membershipPlan;
        $membership->price = $request->price;
        $membership->rank = $request->rank;
        $membership->save();
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
        $membership = Membership::find($id);
        $membership->delete();
        return response()->json(['message','data deleted successfully']);
    }
}
