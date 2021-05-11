<?php

namespace Modules\Ticketing\Entities\Traits;

use Modules\Persons\Services\Permissions;


/**
 * establish the relationship between the persons module and ticketing
 */
trait TicketResourcesTrait
{
    /**
     * boot MainModelResourceTrait
     *
     * @return void
     */
    public static function bootTicketResourcesTrait()
    {
        static::addDirectResources([
            'id',
            'status',
        ]);
    }



    /**
     * get messages resource.
     *
     * @return string|null
     */
    public function getMessagesResource()
    {
        return $this->messages->map(function ($message) {
            return [
                'id'          => hashid($message->id),
                'description' => $message->description,
            ];
        });
    }

}
