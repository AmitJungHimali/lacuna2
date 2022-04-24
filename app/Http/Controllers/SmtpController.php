<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Models\User;
use App\Models\Userdetails;

use Illuminate\Support\Facades\Auth;
use App\Models\emailverification;


class SmtpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        //generate random number
        $otp=random_int(00000,99999);
        //assign otp to a user
        $id=Auth::id();
        $user=User::find($id);
     $user->OTP->otpToken==$otp;
     return $otp;
        

        $details=['name'=>'ajahi','data'=>'Hello bishal ,extended car warranty'];
        $user['to']='himaliamit1@gmail.com';
        Mail::send('mail',$data,function($msg) use($user){
            $msg->to($user['to']);
            $msg->subject('EmailVerification,OTP');
            
        });
    }
    public function sendmailOTP(){
        //delete old otp
        emailverification::where('user_id',Auth::id())->delete();
        //generate otp
        $otp=random_int(11111,99999);
        //assign otp to signedin user
        $otpToBeVerified=emailverification::create([
            'user_id'=>Auth::id(),
            'status'=>'OTPsent',
            'otpToken'=>$otp
        ]);
        $details=User::find(Auth::id())->details;
        //send detail through mail
        $details=[
            'title'=>'This is OTP,Please do not share',
            'name'=>$details->firstName,
            'OTP'=>$otpToBeVerified->otpToken,
            'recipiant'=>Auth::user()->email
        ];
        \Mail::to('himaliamit1@gmail.com')->send(new \App\Mail\MyTestMail($details));//to=>$Auth::user()->email;
        return 'email is sent ??';
    }

    public function inputOTP(Request $request){
        //check if OTP is already verified
        //compare email otp with current saved otp of user
        $emailveri=emailverification::where('user_id',Auth::id())->first();
        
        if($emailveri->otpToken==$request->code){
            $emailveri->status='OTPverified';
            $emailveri->save();
            return response()->json([
                'message'=>'Successfully verified OTP',
                
            ],200);
        }
        return 'notgood';
        //if success verifyemailthrough otp
        //else please re send otp
    }


    public function OTP(Request $request){
        $emailOTP=emailverification::where('user_id',Auth::id());
        if($emailOTP->created_at())
        return now();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function emailVerification(){
        $email=Auth::user()->email;
        $details=[
            'name'=>Auth::user()->userdetails->firstName
    ];

        \Mail::to($email)->send(new \App\Mail\VerificationMail($details));
        return response()->json([
            'message'=>'Verification mail is sent to you email,please check your mail inbox'
        ],200);
    }

    public function verified(){
        
       $user=User::find(Auth::id());
        $user->email_verified_at=now();
        $user->save();
        return response()->json([
            'message'=>'you have verified your email,Thank you'
        ],200);
        
    }
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
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
