<?php

namespace Nomadez\SDK\Helpers;

use AndreasGlaser\Helpers\ArrayHelper;

/**
 * Class ArrayHelperExt
 *
 * @package Nomadez\SDK\Helpers
 * @author  Andreas Glaser
 */
class ArrayHelperExt extends ArrayHelper
{
    /**
     * @param array $indexes
     * @param array $arrayToCompare
     *
     * @return bool
     * @author Andreas Glaser
     */
    public static function indexesExist(array $indexes, array $arrayToCompare)
    {
        foreach ($indexes AS $key => $index) {

            if (is_array($index)) {
                return static::indexesExist($index, $arrayToCompare[$key]);
            }

            if (!array_key_exists($index, $arrayToCompare)) {
                throw new \RuntimeException(sprintf('Index "%s" does not exist in provided array', $index));
            }
        }

        return true;
    }
}