<?php

namespace App\Http\Controllers;

use App\Models\Userdetails;
use Illuminate\Http\Request;
use App\Http\Resources\UserdetailResource;
use Illuminate\Support\Facades\Validator;

class UserdetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserdetailResource::collection(Userdetails::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //done in authcontroller

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Userdetails  $userdetails
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new UserdetailResource(Userdetails::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Userdetails  $userdetails
     * @return \Illuminate\Http\Response
     */
    public function edit(Userdetails $userdetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Userdetails  $userdetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'firstName'=>['required'],
            'middleName'=>['required'],
            'lastName'=>['required'],
            'contact'=>['required','min:9'],
            'gender'=>['required','in:male,female,others'],
            'birthDate'=>['required','date'],
            'companyName'=>['required'],

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors() , 422);
        }
        $user=Userdetails::findOrFail($id);
        $user->fill($request->all());
        if($request->hasFile('profileImage')){
            $user->clearMediaCollection('profileImages');
            $user->addMediaFromRequest('profileImage')->toMediaCollection('profileImages');
            
        }
        $user->save();
        return new UserdetailResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Userdetails  $userdetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(Userdetails $userdetails)
    {
        //
    }
}
