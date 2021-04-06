<?php


namespace Modules\Ticketing\Services\Ticket\Front;


use App\Models\Person;
use Modules\Ticketing\Http\Requests\V1\TicketSaveRequest;

class Ticket
{

    /**
     * Store new ticket
     *
     * @param TicketSaveRequest $request
     *
     * @return \App\Models\Ticket
     */
    public function store(TicketSaveRequest $request)
    {
        if ($this->isPersonExists($request->email) === null) {
            //registration
            //create ticket
        }
        //create ticket
    }



    /**
     * @param string $email
     *
     * @return mixed
     */
    private function isPersonExists(string $email)
    {
        return Person::where('email', $email)->first();
    }

}
