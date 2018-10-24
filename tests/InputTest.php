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
        $expected = array('a' => 'a1', 'b' => '', 'c' => 'c3');
        $errorMessage = __FUNCTION__ . ' failed';

        // Act
        $actual = Input::only($source, $names);
        
        // Assert
        $this->assertEquals(
            $expected,
            $actual,
            $errorMessage
        );
    }

    public function testGetDefault()
    {
        // Arrange
        $source = '';
        $default = 'default value';
        $expected = $default;
        $errorMessage = __FUNCTION__ . ' failed';

        // Actual
        $actual = Input::get($source, $default);

        // Assert
        $this->assertEquals(
            $expected,
            $actual,
            $errorMessage
        );
    }

    public function testGet()
    {
        // Arrange
        $source = 'source value';
        $default = 'default value';
        $expected = $source;
        $errorMessage = __FUNCTION__ . ' failed';

        // Actual
        $actual = Input::get($source, $default);

        // Assert
        $this->assertEquals(
            $expected,
            $actual,
            $errorMessage
        );
    }
}