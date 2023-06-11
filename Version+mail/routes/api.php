<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\check_is_president;
use App\Http\Middleware\check_is_uae_admins_pres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\check_its_not_enseignant;
use App\Http\Middleware\only_administrators;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::put('/enseignants/{id}', [EnseignantController::class,'@updatenseignant']);
// //protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/add_etab',[EtablissementController::class,'add_etab'])->middleware(check_is_uae_admins_pres::class);
    Route::post('/logout', [Authcontroller::class, 'logout']);
    Route::get('/profile',[UserController::class,'profile']);
    Route::Post('/register_administrateur',[Authcontroller::class,'register_administrateur']);
    Route::Post('/register_enseignant',[Authcontroller::class,'register_enseignant']);
    Route::get('/show_enseignants', [EnseignantController::class, 'indexProf'])->middleware(check_its_not_enseignant::class);
    Route::get('/show_etablissements',[EtablissementController::class,'indexetab']);
    Route::get('/show_etab/{id_etab}',[EtablissementController::class,'show_etab']);
    Route::match(['post', 'put'], '/update_etab/{id_etab}', [EtablissementController::class, 'update_etab'])->middleware(check_its_not_enseignant::class);
    Route::get('/show_prof/{id_prof}', [EnseignantController::class, 'show_prof'])->middleware(check_its_not_enseignant::class);
    Route::post('/update_enseignant/{id}',[EnseignantController::class, 'updateEnseignant'])->middleware(check_its_not_enseignant::class);
    Route::delete('/destroy_Enseignant/{id}',[EnseignantController::class, 'destroy_Enseignant'])->middleware(only_administrators::class);
    Route::post('/update_password',[UserController::class,'update_password']);
    Route::post('/logout',[AuthController::class,'logout']);


    Route::get('/interventions',[InterventionController::class,'index']);
    Route::get('/visa_uae/{id}',[InterventionController::class,'visa_uae'])->middleware(check_is_president::class);
Route::get('/visa_etab/{id}',[InterventionController::class,'visa_etab']);

// Route::put('/update_etab/{id_etab}', [EtablissementController::class, 'update_etab'])->middleware(check_is_uae_admins_pres::class);
});



   
Route::get('/login',[AuthController::class,'login']);

Route::get('/register',[AuthController::class,'register']);


Route::post('/forgot_password',[AuthController::class,'forgotpassword']);
Route::get('/resetpassword',[AuthController::class,'resetpassword']);










