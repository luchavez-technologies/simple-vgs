<?php

/**
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */

use Luchavez\SimpleVgs\Services\SimpleVgs;

if (! function_exists('simpleVgs')) {
    /**
     * @return SimpleVgs
     */
    function simpleVgs(): SimpleVgs
    {
        return resolve('simple-vgs');
    }
}

if (! function_exists('simple_vgs')) {
    /**
     * @return SimpleVgs
     */
    function simple_vgs(): SimpleVgs
    {
        return simpleVgs();
    }
}
