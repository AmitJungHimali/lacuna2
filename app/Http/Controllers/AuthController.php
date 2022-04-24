<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Hash;
use App\Models\Userlogin as Userlogin;
use App\Models\Userdetails as Userdetail;
use App\Http\Resources\UserloginResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'firstName'=>['required'],
            'middleName'=>['required'],
            'lastName'=>['required'],
            'contact'=>['required','min:9'],
            'gender'=>['required','in:male,female,others'],
            'birthDate'=>['required','date'],
            'companyName'=>['required'],

            'email'=>['required','email','unique:users,email'],
            'password'=>['required','confirmed'],
            'recoveryEmail'=>['required','email']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors() , 422);
        }
        $userlogins['email']=$request->email;
        $userlogins['recoveryEmail']=$request->recoveryEmail;
        $userlogins['password']=bcrypt($request->password);

        $userLoginDetail=User::create($userlogins);
        
        $token=$userLoginDetail->createToken('myapptoken')->plainTextToken;
        $userLoginDetail->remember_token=$token;
        $userLoginDetail->save();

        $userdetails['firstName']=$request->firstName;
        $userdetails['middleName']=$request->middleName;
        $userdetails['lastName']=$request->lastName;
        $userdetails['gender']=$request->gender;
        $userdetails['contact']=$request->contact;
        $userdetails['companyName']=$request->companyName;
        $userdetails['birthDate']=$request->birthDate;
        $userdetails['user_id']=$userLoginDetail->id;
        $userdetails['role_id']=$request->role_id;

        $usercreation=UserDetail::create($userdetails);

        $response=[
            'user'=>$userLoginDetail,
            'token'=>$token
        ];

        return response($response,201);
        }

        public function login(Request $request){
            $validator = Validator::make($request->all(),[
                'email'=>['required','email'],
                'password'=>['required'],
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors() , 422);
            }
            //checkemail
            $user=User::where('email',$request->email)->first();
            if(!$user || !Hash::check($request->password,$user->password)){
                return response([
                    'message'=>'credentials are not matching'
                ],401);
            }
            $token=$user->createToken('myapptoken')->plainTextToken;
            $user->remember_token=$token;
            $user->save();

            return response([
                'user'=>$user,
                'token'=>$token
            ]);
        }


        public function logout(Request $request){
            $user=Auth::user();
            $user->remember_token=0;
            $user->currentAccessToken()->delete();
            
            return[
                'message'=>'user has been logged out'
            ];
        }
    
}
