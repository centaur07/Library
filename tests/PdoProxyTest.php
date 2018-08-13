<?php
use PHPUnit\Framework\TestCase;
use app\library\PdoProxy;

final class PdoProxyTest extends TestCase
{
    /**
     * Test saveTo function
     * @return void
     */
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

        // Act
        $actual = PdoProxy::get($dbInfo);

        // Assert
        $this->assertNotEmpty(
            $actual,
            $errorMessage
        );
        $actual = null;
    }

}