<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthController extends Controller{

    public function register(Request $request){
        try {
            $validatedData = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ])->validate();
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->errors(),
            ], 400);
        }

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['name'] = Str::random(6);
        $validatedData['uu_id'] = rand(100000, 999999);
        $user = User::create($validatedData);
        $token = $user->createToken('token')->plainTextToken;
        $user =User::find($user->id);

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token,
            'message' => 'Registration successfully completed',
        ], 200);
    }

    public function login(Request $request){
        try {
            $credentials = $request->validate([
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string', 'min:8'],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->errors(),
            ], 400);
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;

            return response()->json([
                'success' => true,
                'user' => $user,
                'token' => $token,
                'message' => 'Login successful',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function mailVerify($email){

        // if (auth()->user()) {
            $user = User::where('email', $email)->get();

            if (count($user) > 0) {

                $random = Str::random(40);
                $otp = rand(1000, 9999);

                $data['otp'] = $otp;
                $data['email'] = $email;
                $data['title'] = "Email Verification";
                $data['body'] = "Please Verify your user's identity by sending your OTP";

                Mail::send('mail.verifyMail', ['data'=>$data], function($message) use ($data){
                    $message->to($data['email'])->subject($data['title']);
                });

                $userData = User::find($user[0]['id']);
                $userData->otp = $otp;
                $userData->save();

                return response()->json(['success' => true, 'message' => 'Mail sent successfully']);

            }else{
                return response()->json(['success' => false, 'message' => 'This email is invalid..!']);
            }
        // }else{
        //     return response()->json(['success' => false, 'message' => 'User is not authenticated']);
        // }
    }

    public function verifyMailLink($token){
        $user = User::where('remember_token', $token)->get();
        if (count($user) > 0) {
            $dateTime = Carbon::now()->format('Y-m-d H:i:s');
            $userData = User::find($user[0]['id']);

            $userData->remember_token = '';
            $userData->email_verified = 1;
            $userData->email_verified_at = $dateTime;
            $userData->status = 1;
            $userData->save();
            return response()->json(['success' => true, 'message' => 'Mail verify successfully']);
        }else{
            return response()->json(['success' => false, 'message' => 'Your token has expired please try again']);
        }
    }

    public function getuser($uu_id){
        $user =User::where('uu_id', $uu_id)->first();

        if ($user->email_verified == 1) {
            return response()->json([
                'email_verified' => true,
                'success' => true,
                'user' => $user,
            ], 200);
        }

        return response()->json([
            'email_verified' => false,
            'success' => true,
            'user' => $user,
        ], 200);
    }

    public function checkOtp(Request $request){

        try {
            $request->validate([
                'otp' => ['required', 'string'],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->errors(),
            ], 400);
        }

        $user =User::where('uu_id', $request->uu_id)->first();
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');

        if ($user->otp == $request->otp) {
            $user->email_verified = 1;
            $user->email_verified_at = $dateTime;
            $user->status = 1;
            $user->save();

            return response()->json([
                'otp_verified' => true,
                'success' => true,
                'user' => $user,
            ], 200);
        }

        return response()->json([
            'otp_verified' => false,
            'success' => true,
            'user' => $user,
        ], 200);
    }

    public function deleteOtp($uu_id){
        $user =User::where('uu_id', $uu_id)->get();
        if (count($user) > 0) {
            $userOne = User::where('uu_id', $uu_id)->first();
            $userOne->email_verified = 0;
            $userOne->otp = null;
            $userOne->status = 0;
            $userOne->save();
            return response()->json([
                'otp_verified' => true,
                'success' => true,
                'user' => $userOne,
            ], 200);
        }else{
            return response()->json([
                'otp_verified' => false,
                'success' => false,
                'user' => $user,
            ], 404);
        }
    }

    public function profileUpdate(Request $request){
        try {
            $validationRules = [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'username' => 'required',
            ];

            if ($request->has('uu_id')) {
                $validationRules['email'][] = $request->uu_id;
            }

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->errors(),
            ], 400);
        }

        $hashedPassword = User::where('uu_id', $request->uu_id)->first();
        $user = User::find($hashedPassword->id);

        if ($request->current_password != '') {
            if (Hash::check($request->current_password, $hashedPassword->password)) {
                $user->password = Hash::make($request->password);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Current password dose not match...!',
                ], 400);
            }
        }

        $user->email = $request->email;
        $user->username = $request->username;

        if ($request->image != '') {
            if($request->hasFile("image")){
                $file=$request->file("image");
                $imageName=time().'_'.$file->getClientOriginalName();
                $file->move(\public_path("profile/"),$imageName);
                $user['image'] = $imageName;
            }
        }

        $user->save();

        $token = $user->createToken('token')->plainTextToken;
        $user =User::find($user->id);

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token,
            'message' => 'Profile updated successfully',
        ], 200);
    }

}
