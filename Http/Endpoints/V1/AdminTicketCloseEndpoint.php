<?php

namespace Modules\Ticketing\Http\Endpoints\V1;

use Modules\Endpoint\Services\EndpointAbstract;
use Modules\Ticketing\Http\Controllers\V1\TicketsController;

/**
 * @api               {POST}
 *                    /api/modular/v1/ticketing-admin-ticket-close
 * @apiDescription    Managers licensed to close tickets can close tickets
 * @apiVersion        1.0.0
 * @apiName           Managers licensed to close tickets can close tickets
 * @apiGroup          Ticketing
 * @apiPermission     Admin
 * @apiParam {int}    ref_number    ticket tracking code
 * @apiParam {enum}   status        includes: ['pending', 'answerd', 'finished']
 * @apiSuccessExample Success-Response:
 * HTTP/1.1 200 OK
 * {
 *      "status": 200,
 *      "metadata": {
 *          "id": "hA5h1d"
 *      },
 *      "results": {
 *          "ref_number": 21646355
 *          "status": "closed"
 *          "developerMessage": "Ticket closed successfully"
 *          "userMessage": "Ticket closed successfully"
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
 * @method Admin\TicketsController controller()
 */
class AdminTicketCloseEndpoint extends EndpointAbstract
{
    /**
     * @inheritdoc
     */
    public static function getTitle(): string
    {
        return "Managers licensed to close tickets can close tickets";
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
        return static::HTTP_POST;
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
        return 'AdminTicketsController@close';
    }
}
