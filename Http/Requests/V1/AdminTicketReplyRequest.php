<?php

namespace Modules\Ticketing\Http\Requests\V1;

use App\Http\Abstracts\ModularFormRequest;
use App\Models\Ticket;

/**
 * @property Ticket $model
 */
class AdminTicketReplyRequest extends ModularFormRequest
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
     * @inheritdoc
     */
    public function authorize()
    {

        return $this->model->canEdit();
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'ref_number'  => "required|numeric|max:9",
            'description' => "required|string",
        ];
    }



    /**
     * @inheritdoc
     */
    protected function fillableFields()
    {
        return [
            'ref_number',
            'description',
        ];
    }
}
