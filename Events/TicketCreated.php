<?php

namespace Modules\Ticketing\Events;

use App\Http\Abstracts\ModularEvent;

class TicketCreated extends ModularEvent
{
    /** @var string */
    public $model_name = "Ticket";

}
