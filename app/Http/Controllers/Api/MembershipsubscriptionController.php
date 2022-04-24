<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Membershipsubscription;
use Illuminate\Http\Request;

class MembershipsubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Membershipsubscription::all();
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
            'membershipstatus'=>'required',
            'paymentstatus'=>'required',
            'startdate'=>'required',
            'enddate'=>'required',
            'user_id'=>'required',
            'membership_id'=>'required'
        ]);
        $membershipsubs = new Membershipsubscription();
        $membershipsubs->membershipstatus =$request->membershipstatus;
        $membershipsubs->paymentstatus =$request->paymentstatus;
        $membershipsubs->startdate =$request->startdate;
        $membershipsubs->enddate =$request->enddate;
        $membershipsubs->user_id =$request->user_id;
        $membershipsubs->membership_id =$request->membership_id;

        $membershipsubs->save();
        return response()->json(['message','data save successfully']);
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
        // $this->validate($request,[
        //     'membershipstatus'=>'required',
        //     'paymentstatus'=>'required',
        //     'startdate'=>'required',
        //     'enddate'=>'required',
        //     'user_id'=>'required',
        //     'membership_id'=>'required'
        // ]);
        $membershipsubs = new Membershipsubscription();
        $membershipsubs->membershipstatus =$request->membershipstatus;
        $membershipsubs->paymentstatus =$request->paymentstatus;
        $membershipsubs->startdate =$request->startdate;
        $membershipsubs->enddate =$request->enddate;
        $membershipsubs->user_id =$request->user_id;
        $membershipsubs->membership_id =$request->membership_id;

        $membershipsubs->save();
        return response()->json(['message','data save successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $membershipsubs = Membershipsubscription::find($id);
        $membershipsubs->delete();
        return response()->json(['message','data deleted successfully']);
    }
}
