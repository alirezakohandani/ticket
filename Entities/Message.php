<?php

namespace Modules\Ticketing\Entities;

use App\Http\Abstracts\ModularModel;
use App\Models\Person;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Mix;
use Modules\Ticketing\Http\Requests\V1\TicketSaveRequest;

class Message extends ModularModel
{
    use SoftDeletes;

    /**
     * Get the ticket that owns the message.
     *
     * @return void
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }



    /**
     * Set the first message by the user for a new ticket
     *
     * @param TicketSaveRequest $request
     * @param Ticket            $ticket
     *
     * @return Message
     */
    public function setMessage(TicketSaveRequest $request, Ticket $ticket)
    {
        return $this->batchSave([
            'ticket_id'   => $ticket->id,
            'person_id'   => Person::where('email', $request->eamil)->first()->id,
            'title'       => $request->title,
            'description' => $request->description,
        ]);
    }


}
