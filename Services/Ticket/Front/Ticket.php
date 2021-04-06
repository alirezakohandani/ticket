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
            //TODO: user registration
            $person_id = 10000;
            $this->createTicket($request, $person_id);
            //TODO: Set message
        }
        $this->createTicket($request, $person_id);
        //TODO: Set message
    }



    /**
     * Checks if there is a person
     *
     * @param string $email
     *
     * @return mixed
     */
    private function isPersonExists(string $email)
    {
        return Person::where('email', $email)->first();
    }



    /**
     * Create new ticket
     *
     * @param TicketSaveRequest $request
     * @param int               $person_id
     *
     * @return \App\Models\Ticket
     */
    private function createTicekt(TicketSaveRequest $request, int $person_id)
    {
        return \App\Models\Ticket::create([
            'user_id'    => $person_id,
            'ref_number' => '12345678',  //TODO: generate ref_number
            'type'       => $request->type,
            'status'     => 'pending',
        ]);
    }

}
