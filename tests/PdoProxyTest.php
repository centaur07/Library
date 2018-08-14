<?php
use PHPUnit\Framework\TestCase;
use app\library\PdoProxy;

final class PdoProxyTest extends TestCase
{
    public function testGetPdo()
    {
        // Arrange
        $dbInfo = array(
            'db' => 'mysql',
            'host' => 'localhost',
            'charset' => 'utf8',
            'user' => 'root',
            'password' => ''
        );
        $errorMessage = __FUNCTION__ . ' failed';

        // Actual
        $actual = PdoProxy::get($dbInfo);

        // Assert
        $this->assertNotEmpty(
            $actual,
            $errorMessage
        );
        $actual = null;
    }

    public function testGetInsertValues()
    {
        // Arrange
        $value = array(
            'a' => 'A',
            'b' => 'B',
        );
        $expected = array(
            ':a' => 'A',
            ':b' => 'B',
        );
        $errorMessage = __FUNCTION__ . ' failed';

        // Actual
        $actual = PdoProxy::getInsertValues($value);

        // Assert
        $this->assertEquals(
            $expected,
            $actual,
            $errorMessage
        );
    }
}