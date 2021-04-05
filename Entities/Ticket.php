<?php

namespace Modules\Ticketing\Entities;

use App\Http\Abstracts\ModularModel;
use Illuminate\Database\Eloquent\SoftDeletes;

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
