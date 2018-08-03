<?php
namespace app\library;

final class Log
{
    /**
     * Save the log to file
     * @param  string    $path       Log path
     * @param  mixed     $log        Log content
     * @return bool|int                Result
     */
    public static function saveTo($path, $log)
    {
        // Arrange
        $log = print_r($log, true);
        $logContent = date('Y-m-d H:i:s') . ' ' . $log . PHP_EOL;

        return file_put_contents($path, $logContent, FILE_APPEND);
    }
}

