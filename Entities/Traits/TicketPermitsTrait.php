<?php

namespace Modules\Ticketing\Entities\Traits;

use Modules\Persons\Services\Permissions;


/**
 * establish the relationship between the persons module and ticketing
 */
trait TicketPermitsTrait
{


    /**
     * determine if the online user is permitted to get a edit of the records.
     *
     * @return bool
     */
    public static function canEdit()
    {
        return static::canDo(Permissions::PERMIT_EDIT);
    }



    /**
     * determine if the online user is permitted to view the model.
     *
     * @return bool
     */
    public function canView()
    {
        return static::canDo(Permissions::PERMIT_VIEW);
    }



    /**
     * determine if the online user can perform a certain action.
     *
     * @param string $permit
     *
     * @return bool
     */
    private static function canDo(string $permit = "*")
    {
        return user()->can("general.form-maker.$permit");
    }



    /**
     * determine if the online user is permitted to get a list-view of the records.
     *
     * @return bool
     */
    public static function canList()
    {
        return user()->can(Permissions::PERMIT_LIST);
    }
}
