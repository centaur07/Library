<?php
namespace app\library\Log;

class Log
{
    /**
     * @var string      Log root directory
     */
    private $logRoot = '';

    /**
     * @var string      Log file name
     */
    private $logName = '';

    /**
     * Log constructor.
     */
    public function __construct()
    {
        // Set defualt value
        $this->logRoot = '/tmp';
        $this->logName = 'debug_log_' . date('ymd') . '.txt';
    }

    /**
     * Save log
     * @param   string      $log        Log content
     * @return  bool|int                Result
     */
    public function save($log = '')
    {
        $logPath = $this->logRoot . '/' . $this->logName;

        // Check log content type
        $parseList = array('array', 'object');
        $dataType = gettype($log);
        if (in_array($dataType, $parseList) === true) {
            $log = print_r($log, true);
        }

        $logContent = date('Y-m-d H:i:s') . ' ' . $log . PHP_EOL;
        return file_put_contents($logPath, $logContent, FILE_APPEND);
    }

    /**
     * Set the log root path
     * @param   string      $path       Log root path
     * @return  bool                    Result
     */
    public function setLogRoot($path = '')
    {
        if (file_exists($path) === false) {
            return false;
        }
        $this->logRoot = $path;
        return true;
    }

    /**
     * Set the log file name
     * @param   string      $name       Log file name
     * @return  bool                    Result
     */
    public function setLogName($name = '')
    {
        if (empty($name) === true) {
            return false;
        }
        $this->logName = $name;
        return true;
    }
}

