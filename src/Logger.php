<?php
namespace AltoAi\JaicpUsedeskIntegration\Common;
class Logger{

    static function log_to_file($filename, $data){
        $log = date('Y-m-d H:i:s') . ' ' . print_r($data, true);
        file_put_contents($filename.'.txt', $log . PHP_EOL, FILE_APPEND);
    }
}