<?php

namespace Modules\Ticketing\Http\Controllers\V1;

use App\Classes\SimpleListRequest;
use App\Classes\TrackingNumber;
use App\Http\Abstracts\ModularController;
use App\Models\Message;
use App\Models\Person;
use Modules\Ticketing\Events\TicketCreated;
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

            $person->registerUser($request->email);
        }

        $person_id = $person->getPersonId($request->email);

        $ticket = $request->model->batchSave([
            'person_id'  => $person_id,
            'ref_number' => TrackingNumber::id2No(rand(1, 999999)),
            'type'       => $request->type,
            'status'     => 'pending',

        ], ['email']);

        Message::instance()->batchSave([
            'ticket_id'   => $ticket->id,
            'person_id'   => 2,
            'title'       => $request->title,
            'description' => $request->description,
        ])
        ;;
        event(new TicketCreated($ticket));
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
     * Show user tickets along with related messages
     *
     * @return Response
     */
    public function showTicketsUser(SimpleListRequest $request)
    {
        $result = [];
        foreach (\user()->tickets as $ticket) {
            $result[] = [
                'id'       => hashid($ticket->id),
                'status'   => $ticket->status,
                'title'    => $ticket->messages()->first()->title,
                'messages' => $ticket->messages->map(function ($message) {
                    return [
                        'id'          => hashid($message->id),
                        'description' => $message->description,
                    ];
                }),
            ];
        }
        return $this->success([$result]);
    }


}
