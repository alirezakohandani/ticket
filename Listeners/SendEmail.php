<?php

namespace Modules\Ticketing\Listeners;

use App\Http\Abstracts\ModularListener;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Ticketing\Events\TicketCreated;
use Modules\Ticketing\Jobs\SendEmailJob;


class SendEmail extends ModularListener implements ShouldQueue
{
    /** @var int $tries */
    public $tries = 5;



    /**
     * Handle the event.
     *
     * @param TicketCreated $event
     *
     * @return void
     */
    public function handle(TicketCreated $event)
    {
        SendEmailJob::dispatch($event);
    }
}
