<?php
use PHPUnit\Framework\TestCase;
use app\library\Input;

final class InputTest extends TestCase
{
    private $errorMessage = __FUNCTION__ . ' failed';

    public function testOnly()
    {
        // Arrange
        $path = '/tmp/test.txt';
        $source = array('a' => 'a1', 'c' => 'c3');
        $names = array('a', 'b', 'c');
        $errorMessage = __FUNCTION__ . ' failed';
        $expected = array('a' => 'a1', 'b' => '', 'c' => 'c3');

        // Act
        $actual = Input::only($source, $names);
        
        // Assert
        $this->assertEquals(
            $expected,
            $actual,
            $errorMessage
        );
    }
}