<?php

namespace Modules\Ticketing\Jobs;

use App\Http\Abstracts\ModularJob;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Modules\Ticketing\Notifications\SendEmailToManagerNotification;

class SendEmailJob extends ModularJob
{
    /**
     * event variable
     */
    private $event;



    /**
     * SendEmailJob constructor.
     *
     * @param $event
     */
    public function __construct($event)
    {
        $this->event = $event;
    }



    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (User::all() as $user) {
            if ($user->isAdmin()) {
                Notification::send($user,
                    new SendEmailToManagerNotification($this->event->ticket->ref_number));
            }
        }
    }
}
