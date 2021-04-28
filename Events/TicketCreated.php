<?php

namespace Modules\Ticketing\Events;

use App\Http\Abstracts\ModularEvent;
use App\Models\Ticket;
use App\Models\User;

class TicketCreated extends ModularEvent
{

    /** @var Ticket */
    public $ticket;



    /**
     * Create a new event instance.
     *
     * @param Ticket $ticket
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }
}
