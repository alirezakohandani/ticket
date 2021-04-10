<?php

namespace Modules\Ticketing\Entities\Traits;

use App\Models\Person;
use App\Models\Ticket;


/**
 * establish the relationship between the persons module and ticketing
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



    /**
     * Checks if there is a person
     *
     * @param string $email
     *
     * @return mixed
     */
    public function isPersonExists(string $email)
    {
        $person = $this->where('email', $email)->first();
        return isset($person);
    }


}
