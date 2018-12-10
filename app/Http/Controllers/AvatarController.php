<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
{
    public function process(Request $request){
        $id=Auth::user()->id;
        $user = User::find($id);
        $avatar = $request->file('avatar');
        $path = $avatar->store('avatars');
        $user->avatar =$path;
        $user->save();
        return response()->json(['status'=>200]);
    }
}
