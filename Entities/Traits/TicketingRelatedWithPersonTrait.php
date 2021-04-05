<?php

namespace Modules\Ticketing\Entities\Traits;

use Modules\Ticketing\Entities\Ticket;

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
