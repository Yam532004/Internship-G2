<?php

use App\Http\Controllers\Controller;
use App\Services\Logger;

class Singleton extends Controller{
    public function index (){
        $logFilePath = storage_path('logs/app.log');
        $logger = Logger::getInstance($logFilePath);
        $logger->log('Write log from Controller');

        $logs = $logger->getLogs();
        dd($logs);
        return view('welcome');
    }
}
?>