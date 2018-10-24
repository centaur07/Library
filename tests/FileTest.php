<?php
use PHPUnit\Framework\TestCase;
use app\library\File;

final class FileTest extends TestCase
{
    public function testReadRows()
    {
        // Arrange
        $filePath = './TestReadRows.txt';
        $data = 'line1' . "\r\n" . 'line2' . "\n";
        file_put_contents($filePath, $data);
        $expected = array('line1' . "\r\n", 'line2' . "\n", false);
        $errorMessage = __FUNCTION__ . ' failed';

        // Act
        $rows = File::readRows($filePath);
        $actual = array();
        foreach ($rows as $row) {
            $actual[] = $row;
        }
        unlink($filePath);
        
        // Assert
        $this->assertEquals($expected, $actual, $errorMessage);
    }
}