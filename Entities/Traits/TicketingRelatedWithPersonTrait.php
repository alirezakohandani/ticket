<?php

namespace Modules\Ticketing\Entities\Traits;

use App\Models\Person;
use App\Models\Ticket;
use App\Models\User;
use Modules\Ticketing\Http\Requests\V1\TicketSaveRequest;


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



    /**
     * user registration
     *
     * @param TicketSaveRequest $request
     *
     * @return \App\Models\Person
     */
    public function registerUser(TicketSaveRequest $request)
    {
        return $this->batchSave([
            'email' => $request->email,
        ]);
    }



    /**
     * @param string $email
     */
    public function getPersonId(TicketSaveRequest $request)
    {
        return Person::where('email', $request->email)->first()->id;
    }

}
