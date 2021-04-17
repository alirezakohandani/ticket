<?php

namespace Modules\Ticketing\Http\Endpoints\V1;

use Modules\Endpoint\Services\EndpointAbstract;
use Modules\Ticketing\Http\Controllers\V1\TicketsController;

/**
 * @api               {POST}
 *                    /api/modular/v1/ticketing-show-tickets-user
 *                    Show user tickets
 * @apiDescription    Users should be able to log in and view their tickets.
 * @apiVersion        1.0.0
 * @apiName           Show user tickets
 * @apiGroup          Ticketing
 * @apiParam {string} id    the hashid of the record
 * @apiSuccessExample Success-Response:
 * HTTP/1.1 200 OK
 * {
 *      "status": 200,
 *      "metadata": {
 *          "count": 2
 *      },
 *      "results": {
 *          {
 *             "status": "pending"
 *             "messages": {
 *                [
 *                    "title": "folan title1",
 *                    "description": "folan description1",
 *                    "role": "admin"
 *                ],
 *          },
 *          {
 *             "status": "answerd"
 *             "messages": {
 *                [
 *                    "title": "folan title1",
 *                    "description": "folan description1",
 *                    "role": "admin"
 *                ],
 *              },
 *          }
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
class ShowTicketsUserEndpoint extends EndpointAbstract
{
    /**
     * @inheritdoc
     */
    public static function getTitle(): string
    {
        return "Show user tickets";
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
        return 'AdminTicketsController@showTicketsUser';
    }
}

