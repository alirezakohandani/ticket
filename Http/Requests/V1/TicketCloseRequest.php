<?php

namespace Modules\Ticketing\Http\Requests\V1;

use App\Http\Abstracts\ModularFormRequest;
use App\Models\Ticket;

/**
 * @property Ticket $model
 */
class TicketCloseRequest extends ModularFormRequest
{
    /** @var string */
    protected $model_name = "Ticket";

    /** @var bool */
    protected $should_allow_create_mode = false;
    //TODO: Remove if you don't need.

    /** @var bool */
    protected $should_load_model_with_slug = true;

    //TODO: Remove if you don't need.
    /** @var string */
    protected $model_slug_attribute = "ref_number";

    /** @var string */
    protected $model_slug_column = "ref_number";



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'ref_number' => "required|int",
            'status'     => "required|in:closed",
        ];
    }



    /**
     * @inheritdoc
     */
    protected function fillableFields()
    {
        return [
            'status',
        ];
    }


}