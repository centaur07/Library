<?php
// *** hold ***
use PHPUnit\Framework\TestCase;
use app\library\MysqlPdo;
final class MysqlPdoTest extends TestCase
{
    protected function getMockedPdo()
    {
        $query = $this->getMock('\PDOStatement');
        $query->method('execute')->willReturn(true);
        $db = $this->getMockBuilder('\PDO')
            ->disableOriginalConstructor()
            ->setMethods(['prepare'])
            ->getMock();
        $db->method('prepare')->willReturn($query);
        
        return $db;
    }
}