<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Event::all();
        // return response()->json($data);
        return EventResource::collection($data);
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
                'title'=>'required',
                'description'=>'required'
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }

            $event = new Event();
            $event->title = $request->title;
            if ($request->hasFile('image')){
                $file = $request->image;
                $newName = time(). $file->getClientOriginalName();
                $file->move('uploads/event/',$newName);
                $event->image ='uploads/event/' .$newName;
            }
            $event->time = $request->time;
            $event->startdate = $request->startdate;
            $event->location = $request->location;
            $event->eventcategory_id = $request->eventcategory_id;
            $event->keyword = $request->keyword;
            $event->enddate = $request->enddate;
            $event->venue = $request->venue;
            $event->organizer = $request->organizer;
            $event->price = $request->price;
            $event->food = $request->food;
            $event->description = $request->description;
            $event->save();
            DB::commit();
            return response()->json(['message','data saved successfully',200]);
        }
        catch(Exception $e)
        {

            // return response()->json($event->errors() , 422);
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
        $event = Event::find($id);
        return response()->json($event);
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
                'title'=>'required',
                'description'=>'required'
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(),422);
            }
        $event = Event::find($id);
        if($event)
        {
            $event->title = $request->title;
        if ($request->hasFile('image')){
            $file = $request->image;
            $newName = time(). $file->getClientOriginalName();
            $file->move('uploads/event/',$newName);
            $event->image ='uploads/event/' .$newName;
        }
        $event->time = $request->time;
        $event->startdate = $request->startdate;
        $event->location = $request->location;
        $event->eventcategory_id = $request->eventcategory_id;
        $event->keyword = $request->keyword;
        $event->enddate = $request->enddate;
        $event->venue = $request->venue;
        $event->organizer = $request->organizer;
        $event->price = $request->price;
        $event->food = $request->food;
        $event->description = $request->description;
        $event->save();
        DB::commit();
        return response()->json(['message','data update successfully',200]);
        }
        else
        {
            return response()->json(['message','Record not Found']);
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
        $event = Event::find($id);
        if($event)
        {
            $event -> delete();
        return response()->json(['message','Data deleted successfully']);
        }
        else
        {
            return response()->json(['message','Record not found']);
        }

    }
}
