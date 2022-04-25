<?php

namespace App\Http\Controllers;

use App\Models\gallery;
use Illuminate\Http\Request;
use App\Http\Resources\GalleryResource;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GalleryResource::collection(Gallery::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'image'=>['required'],
            'rank'=>['required','numeric'],
            'status'=>['required','boolean'],
            'event_id'=>['required','exists:events,id'],
            'workshop_id'=>['required','exists:workshops,id']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors() , 422);
        }
        
        $gallery=gallery::create($request->all());
        return new GalleryResource($gallery);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gall=Gallery::findOrFail($id);
        return new GalleryResource($gall);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator=Validator::make($request->all(),[
            'rank'=>['required','numeric'],
            'status'=>['required','boolean'],
            'event_id'=>['required','exists:events,id'],
            'workshop_id'=>['required','exists:workshops,id']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors() , 422);
        }
        $ment=gallery::findOrFail($id);
        $ment->fill($request->all());
        $ment->save();
        return new GalleryResource($ment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gallery::whereId($id)->delete();
        $return = ["status" => "Success",
                "error" => [
                    "code" => 200,
                    "errors" => 'Deleted successfully'
                            ]
                    ];
            return response()->json($return, 200);
    }
}
