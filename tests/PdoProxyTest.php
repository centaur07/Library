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
            'password' => 'test1234'
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

    public function testGetPrepareValues()
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
        $actual = PdoProxy::getPrepareValues($value);

        // Assert
        $this->assertEquals(
            $expected,
            $actual,
            $errorMessage
        );
    }
}