<?php

namespace Modules\Ticketing\Listeners;

use App\Http\Abstracts\ModularListener;
use App\Models\User;
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
        foreach (User::all() as $user) {
            if ($user->isAdmin()) {
                Notification::send($user,
                    new SendEmailToManagerNotification($event->ticket->ref_number));
            }
        }
    }
}
