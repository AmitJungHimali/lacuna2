<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\AboutusResource;
use App\Models\Aboutus;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutus = Aboutus::all();
        return AboutusResource::collection($aboutus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Validator $validate)
    {
        DB::beginTransaction();
        try
        {
          $validate = validator::make($request->all(),[
              'coverImage' => ['required'],
              'description' => ['required']
          ]);
         if($validate->fails())
         {
             return response()->json($validate->errors() , 422);
         }
           $aboutus = new Aboutus();
           if($request-> hasFile('coverImage')){
               $file =$request->coverImage;
               $newName =time(). $file->getClientOriginalName();
               $file->move('upload/aboutus/',$newName);
               $aboutus->coverImage = 'upload/aboutus/' .$newName;
           }
           $aboutus->description = $request->description;
           $aboutus->save();
           DB::commit();
           return response()->json(['message','Data Saved Successfully']);
        }
        catch(Exception $e)
        {
            Db::rollBack();
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
        $aboutus = Aboutus::find($id);
        return response()->json($aboutus);
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
            $validate = validator::make($request->all(),[
                'coverImage' => ['required'],
                'description' => ['required']
            ]);
           if($validate->fails())
           {
               return response()->json($validate->errors() , 422);
           }
           $aboutus = Aboutus::find($id);
           if($aboutus)
           {
            if($request->hasFile('coverImage')){
                $file =$request->coverImage;
                $newName =time(). $file->getClientOriginalName();
                $file->move('upload/aboutus/',$newName);
                $aboutus->coverImage = 'upload/aboutus/' .$newName;
            }

            $aboutus->description = $request->description;
            // $path =public_path($aboutus->coverImage);
            // if(file_exists($path))
            // {
            //     unlink($path);
            // }
            $aboutus->save();
            DB::commit();
            return response()->json(['message','Data Update Successfully']);
           }
           else
           {
               return response()->json(['message','Record not found']);
           }

        }
        catch(Exception $e)
        {
            Db::rollBack();
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
        $aboutus = Aboutus::find($id);

        if($aboutus)
        {
            $path = public_path($aboutus->coverImage);
            if(file_exists($path)){
                    unlink($path);
                }

            $aboutus -> delete();
        return response()->json(['message','Data deleted successfully']);
        }
        else
        {
            return response()->json(['message','Record not found']);
        }

    }
}
