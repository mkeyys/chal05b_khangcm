<?php

namespace App\Http\Controllers;

use App\Messages;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    public function getMessagesToUser($username)
    {
        $to_user = User::where('username', $username)->first()->name;
        $users = User::all();
        $auth = Auth::user()->username;

        $messages = DB::select(DB::raw("SELECT * FROM `messages` WHERE (from_username='$username' and to_username='$auth') or (from_username='$auth' and to_username='$username')"));
        return view('auth.list_messages',
            ['users' => $users, 'messages' => $messages, 'to_user' => $to_user, 'to_username' => $username]);
    }

    public function sendMessage(Request $request, $to_username)
    {
        $mess = new Messages();
        $mess->message = $request->message_input;
        $mess->to_username = $to_username;
        $mess->from_username = Auth::user()->username;
        $mess->save();
        return redirect()->back();
    }

    public function deleMessage($idMessage)
    {
        Messages::where('id', $idMessage)->delete();
        return redirect()->back();
    }
    public function editMessage(Request $request, $idMessage) {
        $new_mess = $request->mess_edited;
        if ($new_mess == "") Messages::where('id', $idMessage)->delete();
        else Messages::where('id', $idMessage)
            ->first()
            ->update([
                'message'=>$new_mess
            ]);
        return redirect()->back();
    }
}
