<?php
namespace app\library;

use PDO;
use app\library\Input;

final class PdoProxy
{
    /**
     * Get PDO object
     * @param  array    $info    DB info
     * @return object            PDO object
     */
    public static function get($info)
    {
        // Get the inputs
        $list = array(
            'db',
            'host',
            'charset',
            'user',
            'password'
        );
        $inputs = Input::only($info, $list);

        $dsn = self::getDsn($inputs['host'], $inputs['db'], $inputs['charset']);
        $pdo = new PDO($dsn, $inputs['user'], $inputs['password']);
        self::config($pdo, $inputs['charset']);

        return $pdo;
    }

    /**
     * Get prepare string value
     * @param  array     $source          Source value
     * @return array                      PDO prepare string value
     */
    public static function getPrepareValues($source)
    {
        $insertValues = array();

        if (!empty($source)) {
            foreach ($source as $name => $value) {
                $insertValues[':' . $name] = $value;
            }
        }

        return $insertValues;
    }

    /**
     * Get the prepare string fields with value
     * @param  array     $fields       Fields
     * @param  string    $separator    Fields separator
     * @return string                  Fields with value
     */
    public static function getFieldsWithValue($fields, $separator = ', ')
    {
        $result = '';
        $glue = '';

        if (!empty($fields)) {
            foreach ($fields as $field) {
                $result .= $glue . $field . '=:' . $field;
                $glue = $separator;
            }
        }

        return $result;
    }

    /**
     * Get DSN
     * @param  string    $host    Host
     * @param  string    $db      DB name
     * @param  string    $charset Charset
     * @return string             DSN
     */
    private static function getDsn($host, $db, $charset)
    {
        $pattern = 'mysql:dbname=%s;host=%s;charset=%s';

        return sprintf($pattern, $db, $host, $charset);
    }

    /**
     * Config the PDO
     * @param  object    &$pdo    PDO
     * @param  string    $charset Charset
     * @return void
     */
    private static function config(&$pdo, $charset)
    {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Set to prevent SQL injection(Prior to 5.3.6)
        $currentVersion = phpversion();
        if (version_compare($currentVersion, '5.3.6') >= 0) {
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Use native prepared statements
            $pdo->exec('set names ' . $charset); // Prior to 5.3.6, the charset option was ignored
        }
        unset($currentVersion);

    }
}