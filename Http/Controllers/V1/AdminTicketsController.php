<?php

namespace Modules\Ticketing\Http\Controllers\V1;

use App\Models\Ticket;
use App\Http\Abstracts\ModularController;
use Modules\Ticketing\Http\Requests\V1\TicketChangeStatusRequest;
use \Symfony\Component\HttpFoundation\Response;
use Modules\Ticketing\Http\Requests\V1\TicketCloseRequest;

// TODO As a suggest you can put all your controllers under the V1 directory to avoid changing the controller namespace the endpoints
class AdminTicketsController extends ModularController
{

    /**
     * Show tickets and messages for managers who have access to reply and close tickets
     *
     * @return Response
     */
    public function index()
    {
        //TODO Read about the Quark resource system and see similar uses for the getResourcesFromBuilder() method
        $tickets = Ticket::all();
        $result  = [];
        foreach ($tickets as $ticket) {
            $result[] = [
                'id'       => hashid($ticket->id),
                'status'   => $ticket->status,
                //'title'    => $ticket->messages()->first()->title,
                'messages' => $ticket->messages->map(function ($message) {
                    return [
                        'id'          => hashid($message->id),
                        'description' => $message->description,
                    ];
                }),
            ];
        }
        return $this->success([$result]);
    }



    /**
     * Managers licensed to close tickets can close tickets
     *
     * @param TicketCloseRequest $request
     *
     * @return Response
     */
    public function close(TicketCloseRequest $request)
    {
        $request->model->closeStatus();
        //TODO Do you set the status twice?
        return $this->success([
            'ref_number'       => $request->model->ref_number,
            'status'           => $request->model->status,
            'developerMessage' => trans("ticketing::developer.closed_status"),
            'userMessage'      => trans("ticketing::user.closed_status"),
        ], [
            'id' => hashid($request->model->id),
        ]);
    }



    /**
     *Administrators with reply access can change the status of the ticket
     *
     * @param TicketChangeStatusRequest $request
     *
     * @return Response
     */
    public function updateStatus(TicketChangeStatusRequest $request)
    {
        $request->model->changeStatus($request->status);
        //TODO Do you set the status twice?
        return $this->success([
            'ref_number'       => $request->model->ref_number,
            'status'           => $request->model->status,
            'developerMessage' => trans("ticketing::developer.change_status"),
            'userMessage'      => trans("ticketing::user.change_status"),
        ], [
            'id' => hashid($request->model->id),
        ]);
    }
}
