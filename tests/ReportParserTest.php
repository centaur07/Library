<?php
use PHPUnit\Framework\TestCase;
use app\library\ReportParser;
use app\library\File;

final class ReportParserTest extends TestCase
{
    public function testGetReport()
    {
        // Arrange
        $filePath = './testGetReport.txt';
        $readRowsReturn = array('line1' . "\r\n", 'line2' . "\n", false);
        $expected = array('line1', 'line2');
        $errorMessage = __FUNCTION__ . ' failed';

        $file = $this->getMockBuilder('File')
            ->setMethods(array('readRows'))
            ->getMock();
        $file->expects($this->any())
            ->method('readRows')
            ->will($this->returnValue($readRowsReturn));
        $target = new ReportParser($file);

        // Act
        $actual = $target->getReport($filePath);

        // Assert
        $this->assertEquals($expected, $actual, $errorMessage);
    }

    public function testGetItemType()
    {
        // Arrange
        $row = 'SQL Injection\Path 110: ';
        $expected = 'SQL Injection';
        $errorMessage = __FUNCTION__ . ' failed';
        $file = $this->getMockBuilder('File')->getMock();
        $target = new ReportParser($file);

        // Act
        $actual = $target->getItemType($row);

        // Assert
        $this->assertEquals($expected, $actual, $errorMessage);
    }

    public function testGetFilePath()
    {
        // Arrange
        $row = 'File Name /dirA/dirB/test.php ';
        $expected = '/dirA/dirB/test.php';
        $errorMessage = __FUNCTION__ . ' failed';
        $file = $this->getMockBuilder('File')->getMock();
        $target = new ReportParser($file);

        // Act
        $actual = $target->getFilePath($row);

        // Assert
        $this->assertEquals($expected, $actual, $errorMessage);

    }

    /**
     * @depends testGetReport
     * @depends testGetItemType
     * @depends testGetFilePath
     */
    public function testGetItemInfo()
    {
        // Arrange
        $filePath = './testGetReport.txt';
        $readRowsReturn = array(
            'SQL Injection\Path 1: ' . "\r\n",
            'not use info... ' . "\r\n",
            'Code Snippet' . "\r\n",
            'File Name /dirA/dirB/testGetReport1.php' . "\r\n",
            'SQL Injection\Path 2: ' . "\r\n",
             "\r\n",
            'Code Snippet' . "\r\n",
            '/dirA/dirB/testGetReport2.php' . "\r\n",
        );
        $errorMessage = __FUNCTION__ . ' failed';
        $expected = array(
            array(
                'type' => 'SQL Injection',
                'description' => 'SQL Injection\Path 1: ',
                'path' => '/dirA/dirB/testGetReport1.php',
            ),
            array(
                'type' => 'SQL Injection',
                'description' => 'SQL Injection\Path 2: ',
                'path' => '/dirA/dirB/testGetReport2.php',
            )
        );

        $file = $this->getMockBuilder('File')
            ->setMethods(array('readRows'))
            ->getMock();
        $file->expects($this->any())
            ->method('readRows')
            ->will($this->returnValue($readRowsReturn));
        $target = new ReportParser($file);
        
        // Act
        $actual = $target->getItemInfo($filePath);

        // foreach($actual as $row) {
        //     if ($row['type'] === 'SQL Injection') {
        //         // var_dump($row);
        //         // echo $row['description'] . $row['path'] . PHP_EOL;
                
        //     }
        // }
        
        // Assert
        $this->assertEquals($expected, $actual, $errorMessage);
    }
}