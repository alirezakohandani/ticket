<?php

namespace Modules\Ticketing\Http\Controllers\V1;

use App\Http\Abstracts\ModularController;
use App\Models\Message;
use App\Models\Person;
use App\Models\User;
use App\Models\Ticket;
use Modules\Ticketing\Http\Requests\V1\TicketSaveRequest;
use Symfony\Component\HttpFoundation\Response;

class TicketsController extends ModularController
{

    /**
     * Save a new ticket
     *
     * @param TicketSaveRequest $request
     */
    public function store(TicketSaveRequest $request)
    {

        if ($this->isPersonExists($request->email) === null) {

            $person = $this->registerUser($request);
            $ticket = $this->createTicekt($request, $person->id);
            $this->setMessage($request, $ticket);
            return $this->success([
                'ref_number' => $ticket->ref_number,
            ]);

        }
        $person_id = Person::where('email', $request->email)->first()->id;
        $ticket    = $this->createTicekt($request, $person_id);
        $this->setMessage($request, $ticket);
        return $this->success([
            'ref_number' => $ticket->ref_number,
        ]);


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



    /**
     * user registration
     *
     * @param TicketSaveRequest $request
     *
     * @return \App\Models\Person
     */
    private function registerUser(TicketSaveRequest $request)
    {
        return User::instance()->batchSave([
            'email' => $request->email,
        ]);
    }



    /**
     * Set the first message by the user for a new ticket
     *
     * @param TicketSaveRequest $request
     * @param Ticket            $ticket
     *
     * @return \App\Models\Message
     */
    private function setMessage(TicketSaveRequest $request, Ticket $ticket)
    {
        return Message::instance()->batchSave([
            'ticket_id'   => $ticket->id,
            'person_id'   => Person::where('email', $request->eamil)->first()->id,
            'title'       => $request->title,
            'description' => $request->description,
        ]);
    }
}
