<?php

namespace Modules\Ticketing\Entities\Traits;

use Modules\Persons\Services\Permissions;


/**
 * establish the relationship between the persons module and ticketing
 */
trait StatusResourcesTrait
{
    /**
     * boot MainModelResourceTrait
     *
     * @return void
     */
    public static function bootStatusResourcesTrait()
    {
        static::addDirectResources([
            'status',
        ]);
    }


}
