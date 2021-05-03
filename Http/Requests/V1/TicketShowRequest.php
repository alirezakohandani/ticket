<?php

namespace Modules\Ticketing\Http\Requests\V1;

use App\Models\Ticket;
use App\Http\Abstracts\ModularFormRequest;


/**
 * @property Ticket $model
 */
class TicketShowRequest extends ModularFormRequest // list request is for list, when receiving more than one item is probable. Here you look for one and only one model.
{
    /** @var string */
    protected $model_name = "Ticket";

    /** @var bool */
    protected $should_load_model = true;

    /** @var bool */
    protected $should_load_model_with_slug = true;

    /** @var bool */
    protected $should_allow_create_mode = false;

    /** @var string */
    protected $model_slug_attribute = "ref_number";

    /** @var string */
    protected $model_slug_column = "ref_number";



    /**
     * get the main validation rules.
     *
     * @return array
     */
    public function mainRules()
    {
        return [
            'ref_number' => "required|numeric",
        ];
    }



    /**
     * @inheritdoc
     */
    public function authorize()
    {
        return true;
    }


}
