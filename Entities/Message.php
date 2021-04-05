<?php

namespace Modules\Ticketing\Entities;

use App\Http\Abstracts\ModularModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends ModularModel
{
    use SoftDeletes;
    use test;

    /**
     * Get the ticket that owns the message.
     *
     * @return void
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class)
    }


    /**
     * get the main meta fields of the table.
     *
     * @return array
     */
    public function mainMetaFields()
    {
        return [
            //TODO: Fill this with the names of your meta fields, or remove the method if you do not want meta fields at all.
        ];
    }
}
