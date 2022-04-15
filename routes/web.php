<?php

use App\Http\Controllers\DonemController;
use App\Http\Controllers\HocaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjeController;
use App\Http\Controllers\TakipController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/generate', function(){
    Artisan::call('key:generate');
    return "hehehehe";
});
Route::get('/confifg', function(){
    Artisan::call('config:cache');
    return "config hehehe ";
});
Route::get('/new-admin',[UsersController::class,'newAdmin']);

Route::prefix('/')->middleware('isLogin')->group(function(){
    Route::get('/',function(){
        return view('client.auth.login');
    })->name('login');
    Route::post('/login',[LoginController::class,'login']);
    //Route::post('/login',)
});

Route::prefix('/takip')->middleware('authLogin')->group(function(){

    Route::get('/',[HomeController::class,'index']);
    Route::get('/logout',[LoginController::class,'logout']);

    Route::post('/user-data',[HomeController::class,'userData']);

    // users
    Route::get('/users',[UsersController::class,'index']);
    Route::post('/user-data',[UsersController::class,'data']);
    Route::post('/online-user-data',[UsersController::class,'online_user']);
    Route::post('/user-add',[UsersController::class,'store']);
    Route::post('/user-delete/{id}',[UsersController::class,'delete']);

    // Dönem
    Route::get('/donem',[DonemController::class,'index']);
    Route::post('/donem-data',[DonemController::class,'data']);
    Route::post('/donem-add',[DonemController::class,'store']);
    Route::post('/donem-delete/{id}',[DonemController::class,'delete']);
    Route::post('/donem-active/{id}',[DonemController::class,'active']);
    Route::post('/odev-start',[TakipController::class,'takip']);

   // Ogrenci Odev
   Route::get('/proje',[ProjeController::class,'index']);
   Route::post('/proje-data',[ProjeController::class,'data']);
   Route::post('/proje-add',[ProjeController::class,'store']);
   Route::post('/proje-delete/{id}',[ProjeController::class,'delete']);
   Route::post('/proje-rapor-red/{id}',[ProjeController::class,'rapor_red']);
   Route::post('/proje-tez-red/{id}',[ProjeController::class,'tez_red']);
   Route::post('/proje-revize/{id}',[ProjeController::class,'revize']);
   Route::post('/proje-seen/{id}',[ProjeController::class,'seen']);
   Route::post('/proje-seen-rapor/{id}',[ProjeController::class,'seen_rapor']);
   Route::post('/proje-seen-tez/{id}',[ProjeController::class,'seen_tez']);
   Route::post('/proje-onay/{id}',[ProjeController::class,'onay']);
   Route::post('/proje-onay-rapor/{id}',[ProjeController::class,'onay_rapor']);
   Route::post('/proje-onay-tez/{id}',[ProjeController::class,'onay_tez']);
   Route::post('/proje-rapor-add',[ProjeController::class,'raporAsamasi']);
   Route::post('/proje-tez-add',[ProjeController::class,'tezAsamasi']);

   // Hoca Odev
   Route::get('/ogrenciler',[HocaController::class,'index']);
   Route::post('/ogrenciler-data',[HocaController::class,'data']);
   Route::post('/proje-add-2',[HocaController::class,'store']);
   Route::post('/proje-delete/{id}',[HocaController::class,'delete']);
    
});