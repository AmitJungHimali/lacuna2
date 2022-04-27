<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Rating::all();
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
                'rating'=>'required',
                'membership_id'=>'required'
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }
            $rating = new Rating();
            $rating->rating =$request->rating;
            $rating->membership_id =$request->membership_id;
            $rating->save();
            DB::commit();
            return response()->json(['message','data save successfully',200]);
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
        $rating = Rating::find($id);
        return response()->json($rating);
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
                'rating'=>'required',
                'membership_id'=>'required'
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }
            $rating = Rating::find($id);
            if($rating)
            {}
            else
            {
                return response()->json(['message','Record not found']);
            }
            $rating->rating =$request->rating;
            $rating->membership_id =$request->membership_id;
            $rating->save();
            DB::commit();
            return response()->json(['message','data update successfully',200]);
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
        $rating=Rating::find($id);
        if($rating)
        {
            $rating->delete();
        return response()->json(['message','Data Deleted Successful']);
        }
        else
        {
            return response()->json(['message','Record not found']);
        }

    }
}
