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


Route::group(['middleware' => 'useradmin'], function () {


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
    Route::post('panel/kontrak/add', [KontrakController::class, 'insert'])->name('kontrak.insert');;
    Route::get('panel/kontrak/download/{dokumen}', [KontrakController::class, 'download'])->name('kontrak.download');;
    Route::get('panel/kontrak/edit/{id}', [KontrakController::class, 'edit'])->name('kontrak.edit');
    Route::put('panel/kontrak/edit/{id}', [KontrakController::class, 'update'])->name('kontrak.update');
    Route::get('panel/kontrak/preview/{id}', [KontrakController::class, 'preview'])->name('kontrak.preview');
    Route::get('panel/kontrak/delete/{id}', [KontrakController::class, 'delete'])->name('kontrak.delete');


    // OBL
    //P1
    Route::get('panel/obl/p1', [OblP1Controller::class, 'p1']);
    Route::get('panel/obl/p1/add', [OblP1Controller::class, 'add']);
    Route::post('panel/obl/p1/add', [OblP1Controller::class, 'insert'])->name('p1.insert');;
    Route::get('panel/obl/p1/download/{dokumen}', [OblP1Controller::class, 'download'])->name('p1.download');;
    Route::get('panel/obl/p1/edit/{id}', [OblP1Controller::class, 'edit'])->name('p1.edit');
    Route::put('panel/obl/p1/edit/{id}', [OblP1Controller::class, 'update'])->name('p1.update');
    Route::get('panel/obl/p1/preview/{id}', [OblP1Controller::class, 'preview'])->name('p1.preview');
    Route::get('panel/obl/p1/delete/{id}', [OblP1Controller::class, 'delete'])->name('p1.delete');
    //P2
    Route::get('panel/obl/p2', [OblP2Controller::class, 'p2']);
    Route::get('panel/obl/p2/add', [OblP2Controller::class, 'add']);
    Route::post('panel/obl/p2/add', [OblP2Controller::class, 'insert'])->name('p2.insert');;
    Route::get('panel/obl/p2/download/{dokumen}', [OblP2Controller::class, 'download'])->name('p2.download');;
    Route::get('panel/obl/p2/edit/{id}', [OblP2Controller::class, 'edit'])->name('p2.edit');
    Route::put('panel/obl/p2/edit/{id}', [OblP2Controller::class, 'update'])->name('p2.update');
    Route::get('panel/obl/p2/preview/{id}', [OblP2Controller::class, 'preview'])->name('p2.preview');
    Route::get('panel/obl/p2/delete/{id}', [OblP2Controller::class, 'delete'])->name('p2.delete');
    //P3
    Route::get('panel/obl/p3', [OblP3Controller::class, 'p3']);
    Route::get('panel/obl/p3/add', [OblP3Controller::class, 'add']);
    Route::post('panel/obl/p3/add', [OblP3Controller::class, 'insert'])->name('p3.insert');;
    Route::get('panel/obl/p3/download/{dokumen}', [OblP3Controller::class, 'download'])->name('p3.download');;
    Route::get('panel/obl/p3/edit/{id}', [OblP3Controller::class, 'edit'])->name('p3.edit');
    Route::put('panel/obl/p3/edit/{id}', [OblP3Controller::class, 'update'])->name('p3.update');
    Route::get('panel/obl/p3/preview/{id}', [OblP3Controller::class, 'preview'])->name('p3.preview');
    Route::get('panel/obl/p3/delete/{id}', [OblP3Controller::class, 'delete'])->name('p3.delete');
    //P4
    Route::get('panel/obl/p4', [OblP4Controller::class, 'p4']);
    Route::get('panel/obl/p4/add', [OblP4Controller::class, 'add']);
    Route::post('panel/obl/p4/add', [OblP4Controller::class, 'insert'])->name('p4.insert');;
    Route::get('panel/obl/p4/download/{dokumen}', [OblP4Controller::class, 'download'])->name('p4.download');;
    Route::get('panel/obl/p4/edit/{id}', [OblP4Controller::class, 'edit'])->name('p4.edit');
    Route::put('panel/obl/p4/edit/{id}', [OblP4Controller::class, 'update'])->name('p4.update');
    Route::get('panel/obl/p4/preview/{id}', [OblP4Controller::class, 'preview'])->name('p4.preview');
    Route::get('panel/obl/p4/delete/{id}', [OblP4Controller::class, 'delete'])->name('p4.delete');
    //P5
    Route::get('panel/obl/p5', [OblP5Controller::class, 'p5']);
    Route::get('panel/obl/p5/add', [OblP5Controller::class, 'add']);
    Route::post('panel/obl/p5/add', [OblP5Controller::class, 'insert'])->name('p5.insert');;
    Route::get('panel/obl/p5/download/{dokumen}', [OblP5Controller::class, 'download'])->name('p5.download');;
    Route::get('panel/obl/p5/edit/{id}', [OblP5Controller::class, 'edit'])->name('p5.edit');
    Route::put('panel/obl/p5/edit/{id}', [OblP5Controller::class, 'update'])->name('p5.update');
    Route::get('panel/obl/p5/preview/{id}', [OblP5Controller::class, 'preview'])->name('p5.preview');
    Route::get('panel/obl/p5/delete/{id}', [OblP5Controller::class, 'delete'])->name('p5.delete');
    //P6
    Route::get('panel/obl/p6', [OblP6Controller::class, 'p6']);
    Route::get('panel/obl/p6/add', [OblP6Controller::class, 'add']);
    Route::post('panel/obl/p6/add', [OblP6Controller::class, 'insert'])->name('p6.insert');;
    Route::get('panel/obl/p6/download/{dokumen}', [OblP6Controller::class, 'download'])->name('p6.download');;
    Route::get('panel/obl/p6/edit/{id}', [OblP6Controller::class, 'edit'])->name('p6.edit');
    Route::put('panel/obl/p6/edit/{id}', [OblP6Controller::class, 'update'])->name('p6.update');
    Route::get('panel/obl/p6/preview/{id}', [OblP6Controller::class, 'preview'])->name('p6.preview');
    Route::get('panel/obl/p6/delete/{id}', [OblP6Controller::class, 'delete'])->name('p6.delete');
    //P7
    Route::get('panel/obl/p7', [OblP7Controller::class, 'p7']);
    Route::get('panel/obl/p7/add', [OblP7Controller::class, 'add']);
    Route::post('panel/obl/p7/add', [OblP7Controller::class, 'insert'])->name('p7.insert');;
    Route::get('panel/obl/p7/download/{dokumen}', [OblP7Controller::class, 'download'])->name('p7.download');;
    Route::get('panel/obl/p7/edit/{id}', [OblP7Controller::class, 'edit'])->name('p7.edit');
    Route::put('panel/obl/p7/edit/{id}', [OblP7Controller::class, 'update'])->name('p7.update');
    Route::get('panel/obl/p7/preview/{id}', [OblP7Controller::class, 'preview'])->name('p7.preview');
    Route::get('panel/obl/p7/delete/{id}', [OblP7Controller::class, 'delete'])->name('p7.delete');
    //P8
    Route::get('panel/obl/p8', [OblP8Controller::class, 'p8']);
    Route::get('panel/obl/p8/add', [OblP8Controller::class, 'add']);
    Route::post('panel/obl/p8/add', [OblP8Controller::class, 'insert'])->name('p8.insert');;
    Route::get('panel/obl/p8/download/{dokumen}', [OblP8Controller::class, 'download'])->name('p8.download');;
    Route::get('panel/obl/p8/edit/{id}', [OblP8Controller::class, 'edit'])->name('p8.edit');
    Route::put('panel/obl/p8/edit/{id}', [OblP8Controller::class, 'update'])->name('p8.update');
    Route::get('panel/obl/p8/preview/{id}', [OblP8Controller::class, 'preview'])->name('p8.preview');
    Route::get('panel/obl/p8/delete/{id}', [OblP8Controller::class, 'delete'])->name('p8.delete');
    //KL
    Route::get('panel/obl/kl', [OblKlController::class, 'kl']);
    Route::get('panel/obl/kl/add', [OblKlController::class, 'add']);
    Route::post('panel/obl/kl/add', [OblKlController::class, 'insert'])->name('kl.insert');;
    Route::get('panel/obl/kl/download/{dokumen}', [OblKlController::class, 'download'])->name('kl.download');;
    Route::get('panel/obl/kl/edit/{id}', [OblKlController::class, 'edit'])->name('kl.edit');
    Route::put('panel/obl/kl/edit/{id}', [OblKlController::class, 'update'])->name('kl.update');
    Route::get('panel/obl/kl/preview/{id}', [OblKlController::class, 'preview'])->name('kl.preview');
    Route::get('panel/obl/kl/delete/{id}', [OblKlController::class, 'delete'])->name('kl.delete');

    // CLOSING
    //BASO
    Route::get('panel/closing/baso', [BasoController::class, 'baso']);
    Route::get('panel/closing/baso/add', [BasoController::class, 'add']);
    Route::post('panel/closing/baso/add', [BasoController::class, 'insert'])->name('baso.insert');;
    Route::get('panel/closing/baso/download/{dokumen}', [BasoController::class, 'download'])->name('baso.download');;
    Route::get('panel/closing/baso/edit/{id}', [BasoController::class, 'edit'])->name('baso.edit');
    Route::put('panel/closing/baso/edit/{id}', [BasoController::class, 'update'])->name('baso.update');
    Route::get('panel/closing/baso/preview/{id}', [BasoController::class, 'preview'])->name('baso.preview');
    Route::get('panel/closing/baso/delete/{id}', [BasoController::class, 'delete'])->name('baso.delete');
    //BAST
    Route::get('panel/closing/bast', [BastController::class, 'bast']);
    Route::get('panel/closing/bast/add', [BastController::class, 'add']);
    Route::post('panel/closing/bast/add', [BastController::class, 'insert'])->name('bast.insert');;
    Route::get('panel/closing/bast/download/{dokumen}', [BastController::class, 'download'])->name('bast.download');;
    Route::get('panel/closing/bast/edit/{id}', [BastController::class, 'edit'])->name('bast.edit');
    Route::put('panel/closing/bast/edit/{id}', [BastController::class, 'update'])->name('bast.update');
    Route::get('panel/closing/bast/preview/{id}', [BastController::class, 'preview'])->name('bast.preview');
    Route::get('panel/closing/bast/delete/{id}', [BastController::class, 'delete'])->name('bast.delete');
    //BAUT
    Route::get('panel/closing/baut', [BautController::class, 'baut']);
    Route::get('panel/closing/baut/add', [BautController::class, 'add']);
    Route::post('panel/closing/baut/add', [BautController::class, 'insert'])->name('baut.insert');;
    Route::get('panel/closing/baut/download/{dokumen}', [BautController::class, 'download'])->name('baut.download');;
    Route::get('panel/closing/baut/edit/{id}', [BautController::class, 'edit'])->name('baut.edit');
    Route::put('panel/closing/baut/edit/{id}', [BautController::class, 'update'])->name('baut.update');
    Route::get('panel/closing/baut/preview/{id}', [BautController::class, 'preview'])->name('baut.preview');
    Route::get('panel/closing/baut/delete/{id}', [BautController::class, 'delete'])->name('baut.delete');
    //BARD
    Route::get('panel/closing/bard', [BardController::class, 'bard']);
    Route::get('panel/closing/bard/add', [BardController::class, 'add']);
    Route::post('panel/closing/bard/add', [BardController::class, 'insert'])->name('bard.insert');;
    Route::get('panel/closing/bard/download/{dokumen}', [BardController::class, 'download'])->name('bard.download');;
    Route::get('panel/closing/bard/edit/{id}', [BardController::class, 'edit'])->name('bard.edit');
    Route::put('panel/closing/bard/edit/{id}', [BardController::class, 'update'])->name('bard.update');
    Route::get('panel/closing/bard/preview/{id}', [BardController::class, 'preview'])->name('bard.preview');
    Route::get('panel/closing/bard/delete/{id}', [BardController::class, 'delete'])->name('bard.delete');
    //BAA
    Route::get('panel/closing/baa', [BaaController::class, 'baa']);
    Route::get('panel/closing/baa/add', [BaaController::class, 'add']);
    Route::post('panel/closing/baa/add', [BaaController::class, 'insert'])->name('baa.insert');;
    Route::get('panel/closing/baa/download/{dokumen}', [BaaController::class, 'download'])->name('baa.download');;
    Route::get('panel/closing/baa/edit/{id}', [BaaController::class, 'edit'])->name('baa.edit');
    Route::put('panel/closing/baa/edit/{id}', [BaaController::class, 'update'])->name('baa.update');
    Route::get('panel/closing/baa/preview/{id}', [BaaController::class, 'preview'])->name('baa.preview');
    Route::get('panel/closing/baa/delete/{id}', [BaaController::class, 'delete'])->name('baa.delete');
    //BAI
    Route::get('panel/closing/bai', [BaiController::class, 'bai']);
    Route::get('panel/closing/bai/add', [BaiController::class, 'add']);
    Route::post('panel/closing/bai/add', [BaiController::class, 'insert'])->name('bai.insert');;
    Route::get('panel/closing/bai/download/{dokumen}', [BaiController::class, 'download'])->name('bai.download');;
    Route::get('panel/closing/bai/edit/{id}', [BaiController::class, 'edit'])->name('bai.edit');
    Route::put('panel/closing/bai/edit/{id}', [BaiController::class, 'update'])->name('bai.update');
    Route::get('panel/closing/bai/preview/{id}', [BaiController::class, 'preview'])->name('bai.preview');
    Route::get('panel/closing/bai/delete/{id}', [BaiController::class, 'delete'])->name('bai.delete');

    // BERITA ACARA
    Route::get('panel/ba', [BeritaAcaraController::class, 'berita']);
    Route::get('panel/ba/add', [BeritaAcaraController::class, 'add']);
    Route::post('panel/ba/add', [BeritaAcaraController::class, 'insert'])->name('berita.insert');;
    Route::get('panel/ba/download/{dokumen}', [BeritaAcaraController::class, 'download'])->name('berita.download');;
    Route::get('panel/ba/edit/{id}', [BeritaAcaraController::class, 'edit'])->name('berita.edit');
    Route::put('panel/ba/edit/{id}', [BeritaAcaraController::class, 'update'])->name('berita.update');
    Route::get('panel/ba/preview/{id}', [BeritaAcaraController::class, 'preview'])->name('berita.preview');
    Route::get('panel/ba/delete/{id}', [BeritaAcaraController::class, 'delete'])->name('berita.delete');
});
