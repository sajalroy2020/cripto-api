<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function profile()
    {
        $data['user'] = User::where('id', auth()->id())->first();
        return view('profile', $data);
    }

    public function profileUpdate(Request $request)
    {
        try {
            $user = User::find(auth()->id());

            if ($request->old_password != null) {
                if (Hash::check($request->old_password, $user->password) == false) {
                    return redirect()->back()->withInput()->with('ERROR_MESSAGE', 'Current Password Not Match !..');
                }
            }
            if ($request->current_password != null) {
                $user->password = Hash::make($request->current_password);
            }
            $user->name = $request->name;
            $user->email = $request->email;

            if($request->hasFile("image")){
                $file=$request->file("image");
                $imageName=time().'_'.$file->getClientOriginalName();
                $file->move(\public_path("profile/"),$imageName);
                $user['image'] = $imageName;
            }

            $user->save();
            return redirect()->route('profile')->with('SUCCESS_MESSAGE', 'Profile updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('ERROR_MESSAGE', 'something went rong !..');
        }
    }
}
