<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request,$id)
    {
        $user = User::find($id);
        if(!$user){
            return redirect()->route('profile.index')->with('error', 'this profile not found');
        }
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request , $id): RedirectResponse
    {
        $user = User::find($id);
        if(!$user){
            return Redirect::route('profile.show')->with('error', 'this profile not found');
        }
        if($request->filled('password')){
            $user->password = Hash::make($request->password);
        }
        if($request->hasFile('user_image')){
            $path = $request->file('user_image')->store('profiles','public');
            $user->user_image = $path;
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $user->password,
            'user_image' => $user->user_image,
        ]);
        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show_admin_profile(){
        $admin = Auth::user();
        return view('backend.admin-profile.show' ,compact('admin'));
    }

    public function edit_admin_profile(){
        $admin = Auth::user();
        return view('backend.admin-profile.edit' ,compact('admin'));
    }

    public function update_admin_profile(Request $request, $id){
        $admin = User::find($id);
        if(!$admin){
            return Redirect::route('admin.adminprofile.show')->with('error', 'this profile not found');
        }
        if($request->filled('password')){
            $admin->password = Hash::make($request->password);
        }
        if($request->hasFile('user_image')){
            $path = $request->file('user_image')->store('profiles','public');
            $admin->user_image = $path;
        }

        $admin->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $admin->password,
            'user_image' => $admin->user_image,
        ]);
        return Redirect::route('admin.adminprofile.show')->with('status', 'profile-updated');
    }
}
