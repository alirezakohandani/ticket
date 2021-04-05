<?php

namespace Modules\Ticketing\Http\Requests\V1;

use App\Http\Abstracts\ModularFormRequest;
use App\Models\Ticket;

/**
 * @property Ticket $model
 */
class TicketInsertRequest extends ModularFormRequest
{
    /** @var string */
    protected $model_name = "Ticket";

    /** @var bool */
    protected $should_allow_create_mode = true;
    //TODO: Remove if you don't need.

    /** @var bool */
    protected $should_load_model_with_slug = false;
    //TODO: Remove if you don't need.



    /**
     * @inheritdoc
     */
    public function authorize()
    {
        if ($this->createMode()) {
            return Ticket::canCreate();
        }

        return $this->model->canEdit();
        //TODO:: Change as appropriate or remove the method if you don't need.
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'unique:users'],
            'type' => ['required', 'string'],
            'title' => ['required', 'max:255'],
            'description' => ['required'],
        ];
        //TODO: Return rules or remove the method if you don't need.
    }



    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
            //"id.required" => trans("folan");
        ];
        //TODO: Return special validation errors the method if you don't need.
    }



    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            //"id" => trans("id");
        ];
        //TODO: Return attribute names that are not in the kernel or remove the method if you don't need.
    }



    /**
     * @inheritdoc
     */
    public function purifier()
    {
        return [
            //"date"   => "date",
            //"number" => "ed",
        ];
        //TODO: Return purification rules or remove the method if you don't need.
    }



    /**
     * @inheritdoc
     */
    public function corrections()
    {
        //TODO: Apply corrections or remove the method if you don't need.
    }



    /**
     * @inheritdoc
     */
    protected function fillableFields()
    {
        return [
        ];
        //TODO: Return fillable fields or remove the method if you don't need.
    }



    /**
     * @inheritdoc
     */
    protected function mutators()
    {
        //TODO: Delete the method if you don't need it.
    }
}
