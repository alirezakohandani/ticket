<?php

namespace Modules\Ticketing\Http\Controllers\V1\Admin;

use App\Models\Ticket;
use App\Http\Abstracts\ModularController;
use \Symfony\Component\HttpFoundation\Response;
use Modules\Ticketing\Http\Requests\V1\TicketCloseRequest;


class TicketsController extends ModularController
{

    /**
     * Show tickets and messages for managers who have access to reply and close tickets
     *
     * @return Response
     */
    public function index()
    {
        $tickets = Ticket::all();
        $result  = [];
        foreach ($tickets as $ticket) {
            $result[] = [
                'id'       => hashid($ticket->id),
                'status'   => $ticket->status,
                //'title'    => $ticket->messages()->first()->title,
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



    /**
     * Managers licensed to close tickets can close tickets
     *
     * @param TicketCloseRequest $request
     *
     * @return Response
     */
    public function close(TicketCloseRequest $request)
    {
        $request->model->closeStatus();
        return $this->success([
            'ref_number'       => $request->model->ref_number,
            'status'           => $request->model->status,
            'developerMessage' => trans("ticketing::developer.closed_status"),
            'userMessage'      => trans("ticketing::user.closed_status"),
        ], [
            'id' => hashid($request->model->id),
        ]);
    }
}
