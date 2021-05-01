<?php

namespace Modules\Ticketing\Http\Endpoints\V1;

use Modules\Endpoint\Services\EndpointAbstract;
use Modules\Ticketing\Http\Controllers\V1\Controller;

/**
 * @api               {GET}
 *                    /api/modular/v1/ticketing-admin-tickets-show
 * @apiDescription    Show tickets for managers who have access to reply and close tickets
 * @apiVersion        1.0.0
 * @apiName           show tickets
 * @apiGroup          Ticketing
 * @apiPermission     Admin
 * @apiParam {string} id    the hashid of the record
 * @apiSuccessExample Success-Response:
 * HTTP/1.1 200 OK
 * {
 *      "status": 200,
 *      "metadata": {
 *          "count": 5 //Count of tickets in pending status
 *      },
 *      "results": {
 *          {
 *             "id": "hA5h1d"
 *             "ref_number": 21646355
 *             "status": "pending"
 *             "messages": {
 *                [
 *                    "title": "folan title1",
 *                    "description": "folan description1",
 *                    "role": "admin"
 *                ],
 *          },
 *          {
 *             "id": "hA5h1f"
 *             "status": "answerd"
 *             "messages": {
 *                [
 *                    "title": "folan title2",
 *                    "description": "folan description2",
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
 * @method Admin\TicketsController controller()
 */
class AdminTicketsShowEndpoint extends EndpointAbstract
{

    /**
     * @inheritdoc
     */
    public static function getTitle(): string
    {
        return "Show tickets for managers who have access to reply and close tickets";
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
        return static::HTTP_GET;
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
        return 'AdminTicketsController@index';
    }
}
