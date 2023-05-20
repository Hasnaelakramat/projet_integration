<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\InterventionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/enseignants', [EnseignantController::class, 'store']);
// Route::get('/enseignants', [EnseignantController::class, 'index']);


Route::apiResource('/enseignants','App\Http\Controllers\EnseignantController')->only(['index','store','show','edit','destroy']);

// Route pour afficher les informations pour l'utilisateur 1
Route::get('/utilisateur1', [EnseignantController::class, 'indexProf']);

Route::get('/utilisateur2', [EnseignantController::class, 'indexEtab']);





// La méthode match est utilisée pour spécifier plusieurs méthodes HTTP acceptées pour une route
// donnée. Dans cet exemple, nous utilisons ['get', 'post'] pour autoriser à la fois les
// requêtes GET et POST sur la route /utilisateur1
// Route pour afficher les informations pour l'utilisateur 2



//Route::put('/enseignants/{enseignant}', 'App\Http\Controllers\EnseignantController@update');



//update enseignant et user


Route::put('/enseignants/{id}', 'App\Http\Controllers\EnseignantController@updateEnseignant');
Route::put('/users/{id}', 'App\Http\Controllers\EnseignantController@updateUserEmail');




Route::get('/interventions', 'App\Http\Controllers\InterventionController@allInterventions');
Route::get('/interventions/{enseignant}', 'App\Http\Controllers\InterventionController@showEnseignantInterventions');
Route::put('/interventions/{intervention}/validate', 'App\Http\Controllers\InterventionController@validateIntervention')->name('interventions.validate');
Route::put('/interventions/{intervention}/validate-director', 'App\Http\Controllers\InterventionController@validateInterventionByDirector')->name('interventions.validate.director');
Route::put('/interventions/{id}', 'App\Http\Controllers\InterventionController@update')->name('interventions.update');



//mail
Route::post('/users/send-credentials', 'App\Http\Controllers\UserController@sendUserCredentialsEmail');
