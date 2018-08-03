<?php
// *** hold ***
namespace app\library;

use app\library\Input;
use app\library\Log;
use app\library\Output;

// class MysqlPdo
// {
//     /**
//      * Host name(required)
//      * @var string
//      */
//     protected $host = '0.0.0.0';

//     /**
//      * DB name(required)
//      * @var string
//      */
//     protected $dbName = '';

//     /**
//      * DB user(required)
//      * @var string
//      */
//     protected $dbUser = '';

//     /**
//      * DB password(required)
//      * @var string
//      */
//     protected $dbPassword = '';

//     /**
//      * PDO
//      * @var object
//      */
//     public $pdo = null;

//     // /**
//     //  * Primary key name(required)
//     //  * @var string
//     //  */
//     // protected $pkField = '';

//     /**
//      * Is in debug mode(optional)
//      * @var bool
//      */
//     protected $debugMode = false;

//     /**
//      * Debug info(optional)
//      * @var bool
//      */
//     protected $debugAction = 'display';

//     /**
//      * Debug log Path
//      * @var string
//      */
//     private $debugLogPath = '';

//     /**
//      * Debug log content
//      * @var string
//      */
//     private $debugLogContent = '';

//     /**
//      * DB default charset
//      * @var string
//      */
//     private $charset = 'UTF8';

//     /**
//      * Statement
//      * @var object
//      */
//     private $statement = null;

//     // /**
//     //  * Table name
//     //  * @var string
//     //  */
//     // protected $from = '';

//     // /**
//     //  * SELECT columns
//     //  * @var array
//     //  */
//     // private $selectColumns = array();

//     // /**
//     //  * WHERE array element name
//     //  * @var array
//     //  */
//     // private $wheresName = array('column', 'operator', 'value');

//     // /**
//     //  * WHERE info
//     //  * @var array
//     //  */
//     // private $wheres = array();

//     public function __construct($pdo)
//     {
//         // Arrange
//         $this->pdo = $pdo;
//         $this->pdoConfig();
//         $this->debugLogPath = './' . $this->dbName . '_log_' . date('ymd') . '.txt';
//     }

//     public function pdoConfig()
//     {
//         // $dsn = $this->getDsn();
//         // $this->pdo = new \PDO($dsn, $this->dbUser, $this->dbPassword);
//         // unset($dsn);

//         // Set to prevent SQL injection(Prior to 5.3.6)
//         $currentVersion = phpversion();
//         if (version_compare($currentVersion, '5.3.6') >= 0) {
//             $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false); // Use native prepared statements
//             $this->pdo->exec('set names utf8'); // Prior to 5.3.6, the charset option was ignored
//         }
//         unset($currentVersion);
//     }

//     /**
//      * Prepares a statement for execution
//      * @return Object            Self
//      */
//     public function prepare()
//     {
//         // Get the inputs
//         $inputs = func_get_args();

//         // Fill space to array

//         // Do debug action
//         $this->debugAction($inputs);

//         // Arrange
//         $sql = $inputs[0];

//         // Do the pdo action
//         $this->statement = $this->pdo->prepare($sql);

//         return $this;
//     }

//     /**
//      * Executes a prepared statement
//      * @return Object                  Self
//      */
//     public function execute()
//     {
//         // Get the inputs
//         $inputs = func_get_args();

//         // Do debug action
//         $this->debugAction($inputs);

//         $this->statement->execute($parameters);

//         return $this;
//     }

//     /**
//      * Returns an array containing all of the result set rows
//      * @return array                   Result
//      */
//     public function fetchAll()
//     {
//         return $this->statement->fetchAll();
//     }

//     // /**
//     //  * Get DSN
//     //  * @return string              DSN
//     //  */
//     // private function getDsn()
//     // {
//     //     $pattern = 'mysql:dbname=%s;host=%s;charset=%s';
//     //     return sprintf($pattern, $this->dbName, $this->host, $this->charset);
//     // }

//     /**
//      * Do the debug action
//      * @param  mixed    $log    Debug log content
//      * @return void
//      */
//     private function debugAction($log)
//     {
//         // Arrange
//         $debugMode = $this->debugMode;
//         $debugAction = $this->debugAction;
//         $this->debugLogContent = print_r($log, true);

//         if ($debugMode) {
//             $method = 'debug' . \ucfirst($debugAction);
//             call_user_func(array($this, $method));
//         }
//     }

//     /**
//      * Debug action: display the log
//      * @return void
//      */
//     private function debugDisplay()
//     {
//         // Arrange
//         $debugLogContent = $this->debugLogContent;

//         // Display on console
//         Output::display($debugLogContent);
//     }

//     /**
//      * Debug action: Save the log to file
//      * @return void
//      */
//     private function debugLog()
//     {
//         // Arrange
//         $debugLogPath = $this->debugLogPath;
//         $debugLogContent = $this->debugLogContent;

//         // Save to the log
//         Log::saveTo($debugLogPath, $debugLogContent);
//     }

//     // /**
//     //  * Set SELECT fields
//     //  * @param  array    $fields    Select fields
//     //  * @return object              Self
//     //  */
//     // public function select($fields = array())
//     // {
//     //     if (empty($fields)) {
//     //         $fields = array('*');
//     //     }

//     //     $this->set('selectColumns', $fields);

//     //     return $this;
//     // }

//     // /**
//     //  * Get SELECT SQL
//     //  * @return string              SELECT SQL
//     //  */
//     // public function getSelectSql()
//     // {
//     //     $selectSql = '';
//     //     $selectColumns = $this->selectColumns;
//     //     $from = $this->from;
//     //     if (empty($selectColumns)) {
//     //         return $selectSql;
//     //     }

//     //     // Get SELECT SQL
//     //     $pattern = 'SELECT %s FROM %s';
//     //     $fieldString = implode(',', $selectColumns);
//     //     $selectSql = sprintf($pattern, $fieldString, $from);

//     //     return $selectSql;
//     // }

//     // /**
//     //  * Set WHERE info
//     //  * @param  array    $wheres    Where fields and value
//     //  * @return object              Self
//     //  */
//     // public function where($wheres)
//     // {
//     //     $wheresName = $this->wheresName;
//     //     if (!empty($wheres)) {
//     //         foreach ($wheres as $row) {
//     //             $where = Input::only($row, $wheresName);
//     //             $this->wheres[] = $where;
//     //             unset($where);
//     //         }
//     //     }

//     //     return $this;
//     // }

//     // /**
//     //  * Get WHERE SQL string
//     //  * @return string              WHERE SQL
//     //  */
//     // public function getWhereSql()
//     // {
//     //     $whereSql = '';
//     //     $wheres = $this->wheres;
//     //     if (empty($wheres)) {
//     //         return $whereSql;
//     //     }

//     //     // Get WHERE SQL
//     //     $whereSql .= ' WHERE ';
//     //     $andSql = '';
//     //     foreach ($wheres as $row) {
//     //         $whereSql .= $andSql . $row['column'] . $row['operator'] . '?';
//     //         $andSql = ' AND ';
//     //     }
//     //     return $whereSql;
//     // }

//     // /**
//     //  * Get WHERE SQL value
//     //  * @return array              WHERE SQL value
//     //  */
//     // public function getWhereSqlValues()
//     // {
//     //     $values = array();
//     //     $wheres = $this->wheres;
//     //     if (empty($wheres)) {
//     //         return $values;
//     //     }

//     //     // Get WHERE SQL value
//     //     foreach ($wheres as $row) {
//     //         array_push($values, $row['value']);
//     //     }
//     //     return $values;
//     // }

//     // /**
//     //  * Set the target table
//     //  * @param  string    $table    Table name
//     //  * @return object              Self
//     //  */
//     // public function from($table)
//     // {
//     //     $this->set('from', $table);

//     //     return $this;
//     // }

//     // /**
//     //  * Select by raw SQL
//     //  * @param  string    $sql             SELECT SQL
//     //  * @param  array     $whereValues     WHERES value
//     //  * @return array|bool                 SELECT result
//     //  */
//     // public function rawQuery($sql, $whereValues = array())
//     // {
//     //     $this->debugAction($sql);

//     //     if (empty($whereValues)) {
//     //         $stmt = $this->pdo->query($sql);
//     //     } else {
//     //         $stmt = $this->pdo->prepare($sql);
//     //         $stmt->execute($whereValues);
//     //     }
//     //     $result = $stmt->fetchAll();

//     //     return $result;
//     // }

//     // /**
//     //  * Query
//     //  * @return array|bool                 SELECT result
//     //  */
//     // public function query()
//     // {
//     //     $select = $this->getSelectSql();
//     //     $where = $this->getWhereSql();
//     //     $sql = $select . $where;
//     //     $whereValues = $this->getWhereSqlValues();
//     //     $result = $this->rawQuery($sql, $whereValues);

//     //     return $result;
//     // }

// }