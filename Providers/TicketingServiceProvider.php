<?php

namespace Modules\Ticketing\Providers;

use App\Http\Abstracts\ModularProvider;
use Modules\Ticketing\Http\Endpoints\V1\TicketSaveEndpoint;
use Modules\Ticketing\Http\Endpoints\V1\TicketShowEndpoint;

class TicketingServiceProvider extends ModularProvider
{
    /**
     * @inheritdoc
     */
    public function index()
    {
        $this->registerEndpoints();
        $this->registerModelTraits();

    }



    /**
     * register endpoints
     *
     * @return void
     */
    private function registerEndpoints()
    {
        endpoint()->register(TicketSaveEndpoint::class);
        endpoint()->register(TicketShowEndpoint::class);
    }



    /**
     * register ModelTraits
     *
     * @return void
     */
    private function registerModelTraits()
    {
        $this->addModelTrait("TicketingRelatedWithPersonTrait", "Person");
    }


}
