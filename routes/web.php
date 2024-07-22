<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaaController;
use App\Http\Controllers\BaiController;
use App\Http\Controllers\BardController;
use App\Http\Controllers\BasoController;
use App\Http\Controllers\BastController;
use App\Http\Controllers\BautController;
use App\Http\Controllers\BeritaAcaraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\KontrakController;
use App\Http\Controllers\OblKlController;
use App\Http\Controllers\OblP1Controller;
use App\Http\Controllers\OblP2Controller;
use App\Http\Controllers\OblP3Controller;
use App\Http\Controllers\OblP4Controller;
use App\Http\Controllers\OblP5Controller;
use App\Http\Controllers\OblP6Controller;
use App\Http\Controllers\OblP7Controller;
use App\Http\Controllers\OblP8Controller;

Route::get('/', [AuthController::class, 'login']);
Route::post('/', [AuthController::class, 'auth_login']);
Route::get('logout', [AuthController::class, 'logout']);


Route::group(['middleware' => 'useradmin'], function (){


    // ROLE
    Route::get('panel/role', [RoleController::class, 'list']);
    Route::get('panel/role/add', [RoleController::class, 'add']);
    Route::post('panel/role/add', [RoleController::class, 'insert']);
    Route::get('panel/role/edit/{id}', [RoleController::class, 'edit']);
    Route::post('panel/role/edit/{id}', [RoleController::class, 'update']);
    Route::get('panel/role/delete/{id}', [RoleController::class, 'delete']);

    // DASHBOARD
    Route::get('panel/user', [DashboardController::class, 'dashboard']);
    Route::get('panel/user/add', [DashboardController::class, 'add']);
    Route::post('panel/user/add', [DashboardController::class, 'insert']);
    Route::get('panel/user/edit/{id}', [DashboardController::class, 'edit']);
    Route::post('panel/user/edit/{id}', [DashboardController::class, 'update']);
    Route::get('panel/user/delete/{id}', [DashboardController::class, 'delete']);

    // KONTRAK
    Route::get('panel/kontrak', [KontrakController::class, 'kontrak']);
    Route::get('panel/kontrak/add', [KontrakController::class, 'add']);

    // OBL
    //P1
    Route::get('panel/obl/p1', [OblP1Controller::class, 'p1']);
    Route::get('panel/obl/p1/add', [OblP1Controller::class, 'add']);
    //P2
    Route::get('panel/obl/p2', [OblP2Controller::class, 'p2']);
    Route::get('panel/obl/p2/add', [OblP2Controller::class, 'add']);
    //P3
    Route::get('panel/obl/p3', [OblP3Controller::class, 'p3']);
    Route::get('panel/obl/p3/add', [OblP3Controller::class, 'add']);
    //P4
    Route::get('panel/obl/p4', [OblP4Controller::class, 'p4']);
    Route::get('panel/obl/p4/add', [OblP4Controller::class, 'add']);
    //P5
    Route::get('panel/obl/p5', [OblP5Controller::class, 'p5']);
    Route::get('panel/obl/p5/add', [OblP5Controller::class, 'add']);
    //P6
    Route::get('panel/obl/p6', [OblP6Controller::class, 'p6']);
    Route::get('panel/obl/p6/add', [OblP6Controller::class, 'add']);
    //P7
    Route::get('panel/obl/p7', [OblP7Controller::class, 'p7']);
    Route::get('panel/obl/p7/add', [OblP7Controller::class, 'add']);
    //P8
    Route::get('panel/obl/p8', [OblP8Controller::class, 'p8']);
    Route::get('panel/obl/p8/add', [OblP8Controller::class, 'add']);
    //KL
    Route::get('panel/obl/kl', [OblKlController::class, 'kl']);
    Route::get('panel/obl/kl/add', [OblKlController::class, 'add']);

    // CLOSING
    //BASO
    Route::get('panel/closing/baso', [BasoController::class, 'baso']);
    Route::get('panel/closing/baso/add', [BasoController::class, 'add']);
    //BAST
    Route::get('panel/closing/bast', [BastController::class, 'bast']);
    Route::get('panel/closing/bast/add', [BastController::class, 'add']);
    //BAUT
    Route::get('panel/closing/baut', [BautController::class, 'baut']);
    Route::get('panel/closing/baut/add', [BautController::class, 'add']);
    //BARD
    Route::get('panel/closing/bard', [BardController::class, 'bard']);
    Route::get('panel/closing/bard/add', [BardController::class, 'add']);
    //BAA
    Route::get('panel/closing/baa', [BaaController::class, 'baa']);
    Route::get('panel/closing/baa/add', [BaaController::class, 'add']);
    //BAI
    Route::get('panel/closing/bai', [BaiController::class, 'bai']);
    Route::get('panel/closing/bai/add', [BaiController::class, 'add']);



    // BERITA ACARA
    Route::get('panel/ba', [BeritaAcaraController::class, 'berita']);
    Route::get('panel/ba/add', [BeritaAcaraController::class, 'add']);



});
