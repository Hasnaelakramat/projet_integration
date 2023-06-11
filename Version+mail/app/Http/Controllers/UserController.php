<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $user=User::findorfail(Auth::user()->id_user);
        return response()->json($user,200);
    }
    public function update_password(request $request )
    {
$request->validate([
    'password'=>'required|min:8'
]);
        $user=User::findorfail(Auth::User()->id_user);
        $user->password=$request->input('password');
        $user->save();
       
    }

   
}
