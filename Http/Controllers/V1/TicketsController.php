<?php

namespace Modules\Ticketing\Http\Controllers\V1;

use App\Http\Abstracts\ModularController;
use App\Models\Person;
use App\Models\User;
use Modules\Ticketing\Http\Requests\V1\TicketSaveRequest;
use Modules\Ticketing\Services\Ticket\Front\Ticket;
use Symfony\Component\HttpFoundation\Response;

class TicketsController extends ModularController
{
    /**
     * ticket variable
     *
     * @var [type]
     */
    private $ticket;



    /**
     * Save a new ticket
     *
     * @param TicketSaveRequest $request
     */
    public function store(TicketSaveRequest $request)
    {

        if ($this->isPersonExists($request->email) === null) {

            //TODO: user registration
            $this->createTicekt($request, $person_id);
            //TODO: Set message
        }
        $person_id = Person::where('email', $request->email)->first()->id;
        $this->createTicekt($request, $person_id);
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
        return $request->model->batchSave([
            'person_id'  => $person_id,
            'ref_number' => '12345678',  //TODO: generate ref_number
            'type'       => $request->type,
            'status'     => 'pending',

        ], ['email']);

    }


}
