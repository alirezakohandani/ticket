<?php

namespace Modules\Ticketing\Http\Controllers\V1;

use App\Http\Abstracts\ModularController;
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
     * Create a new event instance of ticket.
     *
     * @param Ticket $ticket
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     *
     *
     */
    public function store(TicketSaveRequest $request)
    {
        $this->ticket->store($request);
    }
}
