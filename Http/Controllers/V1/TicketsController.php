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
    public function store(TicketSaveRequest $request, Person $person)
    {
        if (!$person->isPersonExists($request->email)) {

            $person->registerUser($request);
        }
        $person_id = $person->getPersonId($request);
        $ticket    = $request->model
            ->createTicekt($request, $person_id, $this->generateRefNumber());
        $message   = $this->setMessage($request, $ticket);
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

        return $this->success([
            'id'       => hashid($request->model->id),
            'status'   => $request->model->status,
            'title'    => $request->model->messages()->first()->title,
            'messages' => $request->model->messages->map(function ($message) {
                return [
                    'id'          => hashid($message->id),
                    'description' => $message->description,
                ];
            }),
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
