<?php

namespace Modules\Ticketing\Http\Endpoints\V1;

use Modules\Endpoint\Services\EndpointAbstract;
use Modules\Ticketing\Http\Controllers\V1\TicketsController;

/**
 * @api               {POST}
 *                    /api/modular/v1/ticketing-ticket-save
 *                    Create a ticket
 * @apiDescription    Guest users can send a support ticket and receive a tracking code and are automatically
 *                    registered on the site.
 * @apiVersion        1.0.0
 * @apiName           Create a ticket
 * @apiGroup          Ticketing
 * @apiPermission     Guest
 * @apiParam {string} email       User email for registration
 * @apiParam {string} title       Ticket title
 * @apiParam {string} description Ticket description
 * @apiParam {enum}   type        Ticket type
 * @apiSuccessExample Success-Response:
 * HTTP/1.1 200 OK
 * {
 *      "status": 200,
 *      "metadata": {
 *          "id": "hA5h1d",
 *      },
 *      "results": {
 *          'ref_number' => 123456,
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
class TicketSaveEndpoint extends EndpointAbstract
{
    /**
     * @inheritdoc
     */
    public static function getTitle(): string
    {
        return "Create a ticket";
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
        return 'TicketsController@store';
    }
}
