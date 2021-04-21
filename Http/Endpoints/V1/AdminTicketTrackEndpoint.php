<?php

namespace Modules\Ticketing\Http\Endpoints\V1;

use Modules\Endpoint\Services\EndpointAbstract;
use Modules\Ticketing\Http\Controllers\V1\AdminTicketsController;

/**
 * @api               {POST}
 *                    /api/modular/v1/ticketing-admin-ticket-track
 *                    Track ticket
 * @apiDescription    Tickets are tracked and answered by managers
 * @apiVersion        1.0.0
 * @apiName           Tickets are tracked and answered by managers
 * @apiGroup          Ticketing
 * @apiPermission     Admin
 * @apiParam {string} id            the hashid of the record
 * @apiParam {int}    ref_number    ticket ref_number
 * @apiParam {string} description   ticket description
 * @apiSuccessExample Success-Response:
 * HTTP/1.1 200 OK
 * {
 *      "status": 200,
 *      "metadata": {
 *          "id": "hA5h1d"
 *      },
 *      "results": {
 *          "done": "1"
 *          "ref_number": 12345678
 *          "status": "answerd"
 *          "developerMessage": "The ticket response was recorded"
 *          "userMessage" : "The ticket response was recorded"
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
 * @method AdminTicketsController controller()
 */
class AdminTicketTrackEndpoint extends EndpointAbstract
{
    /**
     * @inheritdoc
     */
    public static function getTitle(): string
    {
        return "Tickets are tracked and answered by managers";
    }



    /**
     * @inheritdoc
     */
    public function hasPermit(): bool
    {
        return user()->exists;
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
        return 'AdminTicketsController@test';
    }
}
