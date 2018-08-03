<?php
namespace app\library;

final class Output
{
    /**
     * Display the content
     * @param  string    $content    Content
     * @return void
     */
    public static function display($content)
    {
        echo date('Y-m-d H:i:s') . '    ' . print_r($content, true) . PHP_EOL;
    }
}