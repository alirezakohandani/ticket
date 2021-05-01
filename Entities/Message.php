<?php

namespace Modules\Ticketing\Entities;

use App\Http\Abstracts\ModularModel;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Message extends ModularModel
{
    use SoftDeletes;

    /**
     * Get the ticket that owns the message.
     *
     * @return BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

}
