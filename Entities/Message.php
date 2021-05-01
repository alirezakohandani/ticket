<?php

namespace Modules\Ticketing\Entities;

use App\Http\Abstracts\ModularModel;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\SoftDeletes;


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


}
