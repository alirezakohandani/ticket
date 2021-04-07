<?php

namespace Modules\Ticketing\Http\Requests\V1;

use App\Http\Abstracts\ModularFormRequest;
use App\Models\Ticket;
use Modules\Ticketing\Rules\TypeRule;

/**
 * @property Ticket $model
 */
class TicketSaveRequest extends ModularFormRequest
{
    /** @var string */
    protected $model_name = "ticket";

    /** @var bool */
    protected $should_allow_create_mode = true;



    /**
     * get the main validation rules.
     *
     * @return array
     */
    public function mainRules()
    {
        return [
            'email'       => "required|email",
            'type'        => "required|string|in:immediate,normal,nonsignificant",
            'title'       => "required|max:255",
            'description' => "required|string",
        ];
    }



    /**
     * @inheritdoc
     */
    protected function fillableFields()
    {
        return [
            'type',
            'email',
            'title',
            'description',
        ];
    }

}
