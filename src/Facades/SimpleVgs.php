<?php

namespace Luchavez\SimpleVgs\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class SimpleVgs
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 *
 * @see \Luchavez\SimpleVgs\Services\SimpleVgs
 */
class SimpleVgs extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'simple-vgs';
    }
}
