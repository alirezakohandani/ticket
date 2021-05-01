<?php

namespace Modules\Ticketing\Entities;

use App\Http\Abstracts\ModularModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ticketing\Entities\Traits\StatusResourcesTrait;
use Modules\Ticketing\Entities\Traits\TestResourcesTrait;
use Modules\Ticketing\Entities\Traits\TestTrait;
use Modules\Ticketing\Entities\Traits\TicketPermitsTrait;

class Ticket extends ModularModel
{
    use SoftDeletes;
    use TicketPermitsTrait;
    use StatusResourcesTrait;

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



    /**
     * get messages resource.
     *
     * @return string|null
     */
    protected function getMessagesResource()
    {
        return $this->messages->map(function ($message) {
            return [
                'id'          => hashid($message->id),
                'description' => $message->description,
            ];
        });
    }


}
