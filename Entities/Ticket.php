<?php

namespace Modules\Ticketing\Entities;

use App\Http\Abstracts\ModularModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ticketing\Http\Requests\V1\TicketSaveRequest;

class Ticket extends ModularModel
{
    use SoftDeletes;



    /**
     * Get the messages for the ticket.
     *
     * @return  void
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }



    /**
     * Create new ticket
     *
     * @param TicketSaveRequest $request
     * @param int               $person_id
     *
     * @return \App\Models\Ticket
     *///TODO Misspellings (createTicket)
    public function createTicekt(TicketSaveRequest $request, int $person_id, int $ref_number)
    {
        //TOTO As a suggest you can use this code directly in the controller instead of having a method with 3 inputs
        return $request->model->batchSave([
             'person_id'  => $person_id,
             'ref_number' => $ref_number,
             'type'       => $request->type,
             'status'     => 'pending',

        ], ['email']);

    }



    /**
     * Changes the status of the ticket to closed
     *
     * @return boolean
     */
    public function closeStatus()
    {
        //TODO As a suggest you can use batchSave method
        return $this->update([
             'status' => 'closed',
        ]);
    }



    /**
     * Changes the status of the ticket
     *
     * @param string $status
     *
     * @return boolean
     */
    public function changeStatus(string $status)
    {
        //TODO As a suggest you can use batchSave method
        return $this->update([
             'status' => $status,
        ]);
    }
}
