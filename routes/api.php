<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AudioController;
use App\Http\Controllers\ValidationDataController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CommentsController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function(){
    // Route::get('/user/data',[UserController::class,'getData']);
    
    // Route::put('/user/updateUser',[UserController::class,'updateUser']);
    // Route::delete('/user/deleteUser/{id}',[UserController::class,'deleteUser']);

    // Route::get('/getData',[ValidationDataController::class,'getAllData']);
    // Route::post('/saveData',[ValidationDataController::class,'multiUserSave']);
    // Route::delete('/deleteValidationData/{id}',[ValidationDataController::class,'deleteValidationData']);
    // Route::put('/updateValidationData',[ValidationDataController::class,'updateValidationData']);

    // Route::get('/user/audio',[AudioController::class,'index']);
    // Route::post('/user/addAudio',[AudioController::class,'uploadAudios']);
    // Route::put('/user/updateAudio',[UserController::class,'updateAudio']);
    // Route::delete('/user/deleteaudio/{id}',[AudioController::class,'deleteAudio']);

    // Route::get('/user/video',[VideoController::class,'index']);
    // Route::post('/user/addVideo',[VideoController::class,'uploadVideo']);
    // Route::put('/user/updatevideo',[UserController::class,'updateVideo']);
    // Route::delete('/user/deletevideo/{id}',[VideoController::class,'deleteVideo']);

});
Route::get('/user/data',[UserController::class,'getData']);

Route::get('/user/active',[UserController::class,'getActiveUsers']);
Route::get('/user/pending',[UserController::class,'getPendingUsers']);

Route::get('/user/data/{id}',[UserController::class,'getDataById']);
Route::post('/user/saveUser',[UserController::class,'saveUser']);
Route::put('/user/updateUser',[UserController::class,'updateUser']);
Route::delete('/user/deleteUser/{id}',[UserController::class,'deleteUser']);

Route::get('/dashboard',[UserController::class,'dashboardCount']);

Route::get('/getData',[ValidationDataController::class,'getAllData']);
Route::post('/saveData',[ValidationDataController::class,'multiUserSave']);
Route::delete('/deleteValidationData/{id}',[ValidationDataController::class,'deleteValidationData']);
Route::put('/updateValidationData',[ValidationDataController::class,'updateValidationData']);

Route::get('/user/audio',[AudioController::class,'index']);
Route::post('/user/addAudio',[AudioController::class,'uploadAudios']);
Route::put('/user/updateAudio',[UserController::class,'updateAudio']);
Route::delete('/user/deleteaudio/{id}',[AudioController::class,'deleteAudio']);

Route::get('/user/video',[VideoController::class,'index']);
Route::post('/user/addVideo',[VideoController::class,'uploadVideo']);
Route::put('/user/updatevideo',[UserController::class,'updateVideo']);
Route::delete('/user/deletevideo/{id}',[VideoController::class,'deleteVideo']);
//URL
Route::get('/video/url/{id}',[VideoController::class,'getUrlById']);

Route::post('/loginDataValidation',[UserController::class,'loginDataValidation']);

Route::post('/store',[FileUploadController::class,'store']);

Route::post('/comment',[CommentsController::class,'commentsStore']);
Route::get('/getcomment',[CommentsController::class,'getAllCommentsBasedOnVideoId']);



