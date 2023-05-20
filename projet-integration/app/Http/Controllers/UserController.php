<?php

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserCredentialsNotification;

class UserController extends Controller
{
    public function sendCredentialsEmail()
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->notify(new UserCredentialsNotification);
        }

        return response()->json(['message' => 'E-mails sent to all users.']);
    }
    function generateRandomPassword($length = 8) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $password = '';
        
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        return $password;
    }
    
}
