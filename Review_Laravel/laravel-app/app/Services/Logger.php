<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class Logger
{
    private static $instance = null;
    private $logFilePath;
    private $logs = '';

    private function __construct($logFilePath = null)
    {
        $this->logFilePath = $logFilePath;
    }

    public static function getInstance($logFilePath = null)
    {
        if (self::$instance === null) {
            self::$instance = new self($logFilePath);
        }
        return self::$instance;
    }

    public function log($message)
    {
        // Sử dụng flock để đảm bảo chỉ một process có thể ghi log vào cùng một thời điểm
        $handle = fopen($this->logFilePath, 'a');
        if ($handle && flock($handle, LOCK_EX)) {
            fwrite($handle, $message . PHP_EOL);
            flock($handle, LOCK_UN); // Giải phóng lock
            fclose($handle);
        } else {
            // Xử lý khi không thể ghi log (optional)
        }
    }

    public function getLogs()
    {
        // Đọc nội dung của tệp log
        if (file_exists($this->logFilePath)) {
            return file_get_contents($this->logFilePath);
        }
        return '';
    }
}
