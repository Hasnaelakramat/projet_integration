<?php

namespace App\Http\Controllers;
use App\Http\Requests\adminrequest;
use App\Http\Requests\enseignantrequest;
use App\Http\Requests\ForgotPassword;
use App\Http\Requests\loginuserrequest;
use App\Http\Requests\ResetPassword;
use App\Mail\EnseignantCreated;
use App\Models\Administrateur;
use App\Models\Enseignant;
use App\Models\Etablissement;
use App\Models\PasswordReset;
use App\Traits\httpresponses;
use App\Models\User;
use App\Notifications\mailforgotpassword;
use Illuminate\Auth\Access\Gate;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    use  HasApiTokens,httpresponses,Notifiable;

    public function login(loginuserrequest $request)
{
    $credentials = $request->only('email', 'password');
    
    if (!Auth::attempt($credentials)) {
        return $this->error(
            '',
            'Credentiels do not match',
            401
        );
    }

    $user = Auth::user();
    $token = $user->createToken('API token of '.$user->username,['access_level' => $user->type]);
    return $this->success([
        'user' => $user,
        'token' => $token,
        'access_level'=>$user->type
    ], 200);
}

public function register_administrateur(adminrequest $request)
{
    $request->validated();
// Check if the etablissement exists
// $user=Auth::user();
// $userType = $user->type;
// if ($userType !== 0 && $userType !== 1) {
//     return response()->json(['message' => 'you are not allowed to insert an admin'], 404);
// }
$id_etab=$request->input('id_etab');
    $etab = Etablissement::findorfail($id_etab);
    // if (!$etab) {
    //     return $this->error('Invalid etablissement ID');
    // }
  

 $user = User::create([
         'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
        'type' => $request->input('type'),
    ]);
    $user_id = $user->id_user;

    // Create a new administrateur
    $administrateur = Administrateur::create([
        'ppr' =>$request->input('ppr'),
        'nom' => $request->input('nom'),
        'prenom' => $request->input('prenom'),
        'id_etab' => $id_etab,
        'id_user' => $user_id,
    ]);

    // Create a token for the user
    $token = $user->createToken('API token of ' . $user->username)->plainTextToken;

    return $this->success([
        'user' => $user,
        'token' => $token,
    ]);
}

function register_enseignant(enseignantrequest $request)
{
    $request->validated();
    $user=Auth::user();
    // $userType = $user->type;
    // if ($userType !== 2 && $userType !== 3) {
    //     return response()->json(['message' => 'you are not allowed to insert a teacher'], 403);
    // }
    $id_etab = Administrateur::join('users', function ($join) {
        $join->on('administrateurs.id_user', '=', 'users.id_user')
             ->where('users.id_user', '=', Auth::user()->id_user);
    })
    ->value('administrateurs.id_etab');

$etab = Etablissement::find($id_etab);
        if (!$etab) {
        return $this->error('Invalid etablissement ID');
    }
    $user = User::create([
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
        'type' => 4,
    ]);
    $user_id = $user->id_user;

    $enseignant = Enseignant::create([
        'ppr' => $request->input('ppr'),
        'nom' => $request->input('nom'),
        'prenom' => $request->input('prenom'),
        'date_nais'=>$request->input('date_nais'),
        'id_etab' => $id_etab,
        'id_grade'=>$request->input('id_grade'),
        'id_user' => $user_id,
    ]);
    $token = $user->createToken('API token of ' . $user->username)->plainTextToken;
     //======envoyer le mail <enseignant ajouter >=========>>>> 
     $mailData = [
        'user' => $user,
        'password' => bcrypt($request->input('password')),
    ];
    
    Mail::to($user->email)->send(new EnseignantCreated($user, $request->input('password')));
    //========<<<<<>>>>>>>>>>>>>>==========//
    return $this->success([
        'user' => $user,
        'token' => $token,
    ]);



}

public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return response()->json(['message' => 'Logged out successfully']);
}


    function forgotpassword(ForgotPassword $request)
{
    $user = User::where('email', $request->input('email'))->first();

    if(!$user)
    {
        return $this->error(
            '',
            'no user with this email',
            401
        );
    }

$resetpasswordtoken = Str::random(10);

    // to avoid adding the same user more than once in reset password table
    $userpassreset = PasswordReset::where('email', $user->email)->first();
    if(!$userpassreset)
    {
        // PasswordReset::create([
        //     'email' => $user->email,
        //     'token' => $resetpasswordtoken
        // ]);
        $passwordreset_new_line=new PasswordReset();
        $passwordreset_new_line->email=$user->email;
        $passwordreset_new_line->token=$resetpasswordtoken;
        $passwordreset_new_line->save();

    }
    else
    {
        //store token in db with expiration time
        $userpassreset->update(['token' => $resetpasswordtoken]);
        $userpassreset->save();
    }
//send notification
    $user->notify(new mailforgotpassword($user,$resetpasswordtoken));
    return response()->json('we have sent you an email  with the verification code' );
}


function resetpassword(ResetPassword $request)
{
    $request->validated();
    $user = User::where('email', $request->input('email'))->first();

    if (!$user) {
        return response()->json(["no user with this email"]);
    }

    $resetpassword = PasswordReset::where('email', $request->input('email'))->first();

    if (!$resetpassword || $resetpassword->token != $request->token) {
        return response()->json(["non authorized or invalid token"]);
    }

    $user->fill([
        'password' => bcrypt($request->input('password'))
    ]);
    $user->save();
    $user->tokens()->delete();
    $token = $user->createToken('auth token')->plainTextToken;

    return $this->success([
        'user' => $user,
        'token' => $token
    ], 'password reset successfully', 200);
}
public function register(Request $request)
{
    $request->validate([
        'email' => 'required|max:30|email',
        'password' => 'required|min:8',
    ]);

    $user = new User();
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->type = 0;
    $user->save();

    $token = $user->createToken('API token of ' . $user->email)->plainTextToken;

    return $this->success([
        'user' => $user,
        'token' => $token,
    ]);
}

public function getAdministrateurs()
{
  
    $administrateurs = Administrateur::join('etablissements', 'administrateurs.id_etab', '=', 'etablissements.id_etab')
        ->select(
            'administrateurs.ppr',
            'administrateurs.nom',
            'administrateurs.prenom',
            'etablissements.nom as etablissement_nom'
        )->get();

    //     foreach ($administrateurs as $administrateur) {
    //         $ppr=$administrateur->ppr;
    //         if (Str::startsWith($ppr, 'base64:')) {
    //         try {
                
    //             $decryptedValue = Crypt::decrypt($ppr);
    //             $administrateur->ppr = 3;
    //         } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
    //             // Log or handle the decryption exception
    //             // For example, you can log the error message:
    //             Log::error('Decryption failed: ' . $e->getMessage());
    //         }
    //     }
    // }
     return response()->json($administrateurs, 200);
}
}



