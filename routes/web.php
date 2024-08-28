<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InternetServiceProviderController;
use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::post('api/mpt/invoice-amount', function (Request $request) {
    $controller = new InternetServiceProviderController();
    return $controller->getInvoiceAmount($request, 'Mpt');
});

Route::post('api/ooredoo/invoice-amount', function (Request $request) {
    $controller = new InternetServiceProviderController();
    return $controller->getInvoiceAmount($request, 'Ooredoo');
});

