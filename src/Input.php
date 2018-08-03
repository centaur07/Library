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
}