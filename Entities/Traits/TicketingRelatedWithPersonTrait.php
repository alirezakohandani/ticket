<?php

namespace Modules\Ticketing\Entities\Traits;

use Modules\Ticketing\Entities\Ticket;

/**
 * establish the relationship between the persons module and ticketing
 *
 */
trait TicketingRelatedWithPersonTrait
{
    /**
     * Get the tickets for the user
     *
     * @return void
     */
    public function tickets()
    {
        $this->hasMany(Ticket::class);
    }
}
