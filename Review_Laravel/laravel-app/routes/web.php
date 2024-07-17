<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\TicketController;
use App\Services\Logger;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/promote', [TicketController::class, 'promote']);

Route::get('/logger', function () {
    $logFilePath = storage_path('logs/app.log');
    $logger = Logger::getInstance($logFilePath);
    $logger->log('Ghi log từ Route.');
    $logs = $logger->getLogs();
    return response()->json(['logs' => $logs]);
});
