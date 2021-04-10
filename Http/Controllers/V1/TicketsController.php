<?php

namespace Modules\Ticketing\Http\Controllers\V1;

use App\Classes\TrackingNumber;
use App\Http\Abstracts\ModularController;
use App\Models\Message;
use App\Models\Person;
use App\Models\User;
use App\Models\Ticket;
use Modules\Ticketing\Http\Requests\V1\TicketSaveRequest;
use Modules\Ticketing\Http\Requests\V1\TicketShowRequest;
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

            $person  = $this->registerUser($request);
            $ticket  = $this->createTicekt($request, $person->id);
            $message = $this->setMessage($request, $ticket);
            if ($ticket === null || $message === null) {
                return $this->clientError(400); //TODO: response better replace
            }
            return $this->success([
                'ref_number' => $ticket->ref_number,
            ]);

        }
        $person_id = Person::where('email', $request->email)->first()->id;
        $ticket    = $this->createTicekt($request, $person_id);
        $message   = $this->setMessage($request, $ticket);
        if ($ticket === null || $message === null) {
            return $this->clientError(400); //TODO: response better replace
        }
        return $this->success([
            'ref_number' => $ticket->ref_number,
        ]);


    }



    /**
     * Show the current status on the guest users ticket
     *
     * @param TicketShowRequest $request
     *
     * @return Response
     */
    public function show(TicketShowRequest $request)
    {
        $ticket = $request->getTicketWithRefnumber($request->ref_number);

        if ($ticket !== null) {
            return $this->success([
                'status'   => $ticket->status,
                'title'    => $ticket->messages()->first()->title,
                'messages' => $ticket->messages->map(function ($message) {
                    return [
                        'description' => $message->description,
                    ];
                }),
            ]);
        }
        return $this->clientError();

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
        $person = Person::where('email', $email)->first();
        return isset($person);
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
            'ref_number' => $this->generateRefNumber(),
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
        ])
            ;
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
        ])
            ;
    }



    /**
     * Generates ref_number which is not in the table
     *
     * @return int
     */
    protected function generateRefNumber()
    {
        do {

            $ref_number = TrackingNumber::id2No(rand(1, 999999));

        } while (Ticket::where('ref_number', $ref_number)->exists());

        return $ref_number;
    }


}
