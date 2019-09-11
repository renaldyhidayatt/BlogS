<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\Profile\UpdateProfileRequest;


class UsersController extends Controller
{
    public function index(){
        return view('users.index')->with('users', User::all());
    }
    public function edit(){
        return view('users.edit')->with('user', auth()->user());
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'about' => $request->about
        ]);
        session()->flash('success', 'User updated successfully.');
        return redirect( route('users.index'));
    }
    public function makeAdmin(User $user){
        $user->role = 'admin';
        $user->save();
        session()->flash('success', 'User Made Admin Succesfully');
        return redirect(route('users.index'));
    }
}
