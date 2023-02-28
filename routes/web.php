<?php

use App\Http\Controllers\BarcodeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebcamController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

//QRCode
Route::get('/generate-qrcode', [QrCodeController::class, 'index']);

//QRCode
Route::get('/generate-barcode', [BarcodeController::class, 'index']);

//QRCode Scanner
Route::post('scan_cam', [QrCodeController::class, 'code'])->name('scan.cam');

//Camera
Route::get('webcam', [WebcamController::class, 'index']);
Route::post('webcam', [WebcamController::class, 'store'])->name('webcam.capture');

//Barcode Scanner

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Access website/storage-link after deploying to link the storage to public
Route::get('/storage-link', function(){
    $targetFolder = storage_path('app/public');
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder,$linkFolder);
    echo "Link Success";
});