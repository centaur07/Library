<?php
use PHPUnit\Framework\TestCase;
use app\library\Log;

final class LogTest extends TestCase
{
    /**
     * Test saveTo function
     * @return void
     */
    public function testSaveTo()
    {
        // Arrange
        $content = array('a1', 'b2');
        $logPath = './unit_test_log.txt';
        $errorMessage = __FUNCTION__ . ' failed';

        // Act
        Log::saveTo($logPath, $content);
        
        // Assert
        $this->assertFileExists(
            $logPath,
            $errorMessage
        );
        unlink($logPath);
    }
}