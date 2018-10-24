<?php
namespace app\library;

final class Input
{
    /**
     * Filter the inputs
     * @param  array    $source    Input source
     * @param  array    $names     Accept list
     * @return array               Result
     */
    public static function only($source, $names)
    {
        $inputs = array();
        foreach ($names as $name) {
            if (isset($source[$name])) {
                $inputs[$name] = $source[$name];
            } else {
                $inputs[$name] = '';
            }
        }
        return $inputs;
    }

    /**
     * Get the value with default value
     * @param  mixed    $source    Source value
     * @param  mixed    $default   Default value
     * @return mixed               Value
     */
    public static function get($source, $default = '')
    {
        $value = '';
        if (empty($source)) {
            $value = $default;
        } else {
            $value = $source;
        }

        return $value;
    }
}