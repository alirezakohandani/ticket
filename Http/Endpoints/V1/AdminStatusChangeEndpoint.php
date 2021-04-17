<?php

namespace Modules\Ticketing\Http\Endpoints\V1;

use Modules\Endpoint\Services\EndpointAbstract;
use Modules\Ticketing\Http\Controllers\V1\TicketsController;

/**
 * @api               {PUT}
 *                    /api/modular/v1/ticketing-admin-status-change
 * @apiDescription    Administrators with reply access can change the status of the ticket
 * @apiVersion        1.0.0
 * @apiName           Change status
 * @apiGroup          Ticketing
 * @apiPermission     Admin
 * @apiParam {int}    ref_number    ticket tracking code
 * @apiParam {string} status        includes: ['pending', 'answerd', 'finished']
 * @apiSuccessExample Success-Response:
 * HTTP/1.1 200 OK
 * {
 *      "status": 200,
 *      "metadata": {
 *          "id": "hA5h1d"
 *      },
 *       "results": {
 *          "ref_number": 21646355
 *          "status": "answerd"
 *          "developerMessage": trans(ticketing::developer.closed)
 *          "userMessage": trans(ticketing::user.closed)
 *      }
 * }
 * @apiErrorExample
 * HTTP/1.1 400 Bad Request
 * {
 *      "status": 400,
 *      "developerMessage": "endpoint::developerMessages.endpoint-403",
 *      "userMessage": "Forbidden!",
 *      "errorCode": "endpoint-403",
 *      "moreInfo": "endpoint.moreInfo.endpoint-403",
 *      "errors": []
 * }
 * @method TicketsController controller()
 */
class AdminStatusChangeEndpoint extends EndpointAbstract
{
    /**
     * @inheritdoc
     */
    public static function getTitle(): string
    {
        return "Administrators with reply access can change the status of the ticket";
    }



    /**
     * @inheritdoc
     */
    public function hasPermit(): bool
    {
        return true;
    }



    /**
     * @inheritdoc
     */
    public function getValidMethod(): string
    {
        return static::HTTP_PUT;
    }



    /**
     * @inheritdoc
     */
    public function getControllerNamespace(): string
    {
        return 'Modules\Ticketing\Http\Controllers\V1';
    }



    /**
     * @inheritdoc
     */
    public function getController(): string
    {
        return 'AdminTicketsController@updateStatus';
    }
}

