<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NotificationSubscription;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
            $validator = Validator::make($request->all(),[
                'fullname'=>'required',
                'email'=>'required',
                'subscriptionDate'=>'required',
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }
            $notification=new NotificationSubscription();
            $notification->fullname=$request->fullname;
            $notification->email=$request->email;
            $notification->subscriptionDate=$request->subscriptionDate;
            $notification->save();
            DB::commit();
           return response()->json(['message','data save successflly',200]);
        }

        catch(Exception $e)
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
            $validator = Validator::make($request->all(),[
                'fullname'=>'required',
                'email'=>'required',
                'subscriptionDate'=>'required',
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }
            $notification=NotificationSubscription::find($id);
            if($notification)
            {
                $notification->fullname=$request->fullname;
                $notification->email=$request->email;
                $notification->subscriptionDate=$request->subscriptionDate;
                $notification->save();
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
        $notification= NotificationSubscription::find($id);
        if($notification)
        {
            $notification->delete();
        return response()->json(['message','Data Deleted Successful']);
        }
        else
        {
            return response()->json(['message','Record not found']);
        }

    }
}
