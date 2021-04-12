<?php

namespace Modules\Ticketing\Http\Controllers\V1\Admin;


use App\Http\Abstracts\ModularController;
use App\Models\Ticket;


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
}
