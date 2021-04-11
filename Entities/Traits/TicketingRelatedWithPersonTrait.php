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
        return $this->hasMany(Ticket::class, 'person_id');
    }



    /**
     * Checks if a person with the given email exists.
     *
     * @param string $email
     *
     * @return boolean
     */
    public static function isPersonExists(string $email)
    {
        return static::where('email', $email)->exists();
    }



    /**
     * register a new user with the given email address.
     *
     * @param string $email
     *
     * @return \App\Models\Person
     */
    public static function registerUser(string $email)
    {
        return static::batchCreate([
            'email' => $email,
        ]);
    }



    /**
     * get the id of the person with the given id.
     *
     * @param string $email
     *
     * @return int
     */
    public static function getPersonId(string $email)
    {
        return Person::where('email', $email)->select("id")->firstOrCreate([])->id;
    }

}
