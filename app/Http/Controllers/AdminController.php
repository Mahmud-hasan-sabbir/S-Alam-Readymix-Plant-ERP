<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function profile(){
        $id = Auth::user()->id;

        $admin = User::find($id);
        return view('layouts.pages.admin.profile', compact('admin'));
    }


    public function editProfile(){
        $id = Auth::user()->id;

        $admin = User::find($id);
        return view('layouts.pages.admin.edit', compact('admin'));
    }


    public function storeProfile(request $request){

        $id = Auth::user()->id;

        $admin = User::find($id);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->contact_number = $request->contact_number;
        $admin->role_name = $request->role_name;

        if ($request->file('profile_photo_path')) {
           $file = $request->file('profile_photo_path');

           $filename = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('images/profile/fix/'),$filename);
           $admin['profile_photo_path'] = $filename;
        }
        $admin->save();

        return redirect()->route('admin.profile');
    }


    public function ChangePassword(){
        return view('layouts.pages.admin.ChangePassword');
    }


    public function UpdatePassword(Request $request){
        $validateData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',

        ]);

        $hashedPassword = Auth::user()->password;
        
        if (Hash::check($request->old_password,$hashedPassword )) {
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->new_password);
            $users->save();

            session()->flash('message','Password Updated Successfully');
            return redirect()->back();
        } else{
            session()->flash('message','Old password is not match');
            return redirect()->back();
        }
    }




}
