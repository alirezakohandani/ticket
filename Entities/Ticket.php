<?php

namespace Modules\Ticketing\Entities;

use App\Http\Abstracts\ModularModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ticketing\Entities\Traits\TicketPermitsTrait;
use Modules\Ticketing\Http\Requests\V1\TicketSaveRequest;

class Ticket extends ModularModel
{
    use SoftDeletes;
    use TicketPermitsTrait;

    /**
     * Get the messages for the ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
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
     */
    public function createTicket(TicketSaveRequest $request, int $person_id, int $ref_number)
    {
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
     * @return Ticket
     */
    public function closeStatus()
    {
        return $this->batchSave([
            'status' => 'closed',
        ]);
    }



    /**
     * Changes the status of the ticket
     *
     * @param string $status
     *
     * @return Ticket
     */
    public function changeStatus(string $status)
    {
        return $this->batchSave([
            'status' => $status,
        ]);
    }



    /**
     * Return ticket status
     *
     * @return string
     */
    public function ticketStatus()
    {
        return $this->status;
    }
}
