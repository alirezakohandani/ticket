<?php

namespace Modules\Ticketing\Rules;

use App\Http\Abstracts\ModularRuleInterface;
use Modules\Ticketing\Http\Requests\V1\TicketSaveRequest;

/**
 * Class TypeRule
 *
 * @package Modules\Ticketing\Rules
 */
class TypeRule implements ModularRuleInterface
{
    /**
     * ticket type variable
     *
     * @var string
     */
    private $type;



    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(TicketSaveRequest $request)
    {
        $this->type = $request->type;
    }



    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $typeWhiteList = ['immediate', 'normal', 'nonsignificant'];
        return in_array($this->type, $typeWhiteList);
    }



    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans("ticketing::validation.type_enum");
    }
}
