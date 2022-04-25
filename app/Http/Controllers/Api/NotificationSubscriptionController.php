<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NotificationSubscription;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = NotificationSubscription::all();
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
            $notification=new NotificationSubscription();
            $notification->fullname=$request->fullname;
            $notification->email=$request->email;
            $notification->subscriptionDate=$request->subscriptionDate;
            $notification->save();
            DB::commit();
           return response()->json(['message','data save successflly']);
        }

        catch(Exception $e)
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
        $notification = NotificationSubscription::find($id);
        return response()->json($notification);
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
            $notification=NotificationSubscription::find($id);
            $notification->fullname=$request->fullname;
            $notification->email=$request->email;
            $notification->subscriptionDate=$request->subscriptionDate;
            $notification->save();
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
        $notification= NotificationSubscription::findOrFail($id);
        $notification->delete();
        return response()->json(['message','Data Deleted Successful']);
    }
}
