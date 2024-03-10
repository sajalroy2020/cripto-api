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
                $domain = URL::to('/');
                $url = $domain.'/mail-verify/'.$random;

                $data['url'] = $url;
                $data['email'] = $email;
                $data['title'] = "Email Verification";
                $data['body'] = "Please click here to below to verify your mail";

                Mail::send('mail.verifyMail', ['data'=>$data], function($message) use ($data){
                    $message->to($data['email'])->subject($data['title']);
                });

                $userData = User::find($user[0]['id']);
                $userData->remember_token = $random;
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

    public function getuser($id){
        $user =User::find($id);

        return response()->json([
            'success' => true,
            'user' => $user,
        ], 200);
    }

}
