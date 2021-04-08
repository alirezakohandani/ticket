<?php

namespace Modules\Ticketing\Http\Requests\V1;

use App\Models\Ticket;
use App\Http\Abstracts\ModularListRequest;


/**
 * @property Ticket $model
 */
class TicketShowRequest extends ModularListRequest
{
    /** @var string */
    protected $model_name = "Ticket";

    /** @var bool */
    protected $should_load_model = true;

    /** @var bool */
    protected $should_load_model_with_slug = false;

    /** @var bool */
    protected $should_allow_create_mode = true;



    /**
     * Return ticket based on tracking code
     *
     * @param int $ref_number
     *
     * @return mixed
     */
    public function getTicketWithRefnumber(int $ref_number)
    {
        return $this->model->where('id', 50)->first();
    }



    /**
     * @inheritdoc
     */
    public function authorize()
    {
        return $this->model->canList();
    }


}
