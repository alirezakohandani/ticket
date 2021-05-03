<?php

namespace Modules\Ticketing\Http\Endpoints\V1;

use Modules\Endpoint\Services\EndpointAbstract;
use Modules\Ticketing\Http\Controllers\V1\TicketsController;

/**
 * @api               {POST}
 *                    /api/modular/v1/ticketing-ticket-show
 *                    Show tickets based on tracking code
 * @apiDescription    Guest users can see their current status and messages by sending a ticket tracking code.
 * @apiVersion        1.0.0
 * @apiName           Show tickets based on tracking code
 * @apiGroup          Ticketing
 * @apiPermission     Guest
 * @apiParam {int}    ref_number
 * @apiSuccessExample Success-Response:
 * HTTP/1.1 200 OK
 * {
 *      "status": 200,
 *      "metadata": {
 *          "id": "hA5h1d",
 *          "count": 10,
 *      },
 *      "results": {
 *          "status": "pending"
 *          "messages": {
 *                [
 *                    "title": "folan title",
 *                    "description": "folan description",
 *                    "role": "admin"
 *                ],
 *          },
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
class TicketShowEndpoint extends EndpointAbstract
{
    /**
     * @inheritdoc
     */
    public static function getTitle(): string
    {
        return "Show tickets based on tracking code";
    }



    /**
     * @inheritdoc
     */
    public function hasPublicAccess(): bool
    {
        return true;
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
        return 'TicketsController@show';
    }
}
