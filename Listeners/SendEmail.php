<?php

namespace Modules\Ticketing\Listeners;

use App\Http\Abstracts\ModularListener;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Modules\Ticketing\Events\TicketCreated;
use Modules\Ticketing\Notifications\SendEmailToManagerNotification;

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
        $event->user->adminUsers()->map(function ($user) use ($event) {
            Notification::send($user,
                new SendEmailToManagerNotification($event->ticket->ref_number));
        })
        ;

    }
}
