<?php

namespace Modules\Ticketing\Events;

use App\Http\Abstracts\ModularEvent;
use App\Models\Ticket;
use App\Models\User;

class TicketCreated extends ModularEvent
{

    /** @var Ticket */
    public $ticket;

    /** @var User */
    public $user;



    /**
     * Create a new event instance.
     *
     * @param Ticket $ticket
     * @param User   $user
     */
    public function __construct(Ticket $ticket, User $user)
    {
        $this->ticket = $ticket;
        $this->user   = $user;
    }
}
