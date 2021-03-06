<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $this->validate($request,[
                'rating'=>'required',
                'membership_id'=>'required'
            ]);
            $rating = new Rating();
            $rating->rating =$request->rating;
            $rating->membership_id =$request->membership_id;
            $rating->save();
            DB::commit();
            return response()->json(['message','data save successfully']);
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
            $this->validate($request,[
                'rating'=>'required',
                'membership_id'=>'required'
            ]);
            $rating = Rating::find($id);
            $rating->rating =$request->rating;
            $rating->membership_id =$request->membership_id;
            $rating->save();
            DB::commit();
            return response()->json(['message','data update successfully']);
        }
        catch(Exception $e)
        {
            DB::rollBack();
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
        $rating=Rating::findOrFail($id);
        $rating->delete();
        return response()->json(['message','Data Deleted Successful']);
    }
}
