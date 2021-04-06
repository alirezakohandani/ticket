<?php

namespace Modules\Ticketing\Providers;

use App\Http\Abstracts\ModularProvider;
use Modules\Ticketing\Http\Endpoints\V1\TicketSaveEndpoint;

class TicketingServiceProvider extends ModularProvider
{
    /**
     * @inheritdoc
     */
    public function index()
    {
        $this->registerEndpoints();
    }



    /**
     * register endpoints
     *
     * @return void
     */
    private function registerEndpoints()
    {
        endpoint()->register(TicketSaveEndpoint::class);
    }

}
