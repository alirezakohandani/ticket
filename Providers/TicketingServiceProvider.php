<?php

namespace Modules\Ticketing\Providers;

use App\Http\Abstracts\ModularProvider;
use App\Models\Person;
use Modules\Ticketing\Entities\Traits\TicketingRelatedWithPersonTrait;
use Modules\Ticketing\Http\Endpoints\V1\ShowTicketsUserEndpoint;
use Modules\Ticketing\Http\Endpoints\V1\TicketSaveEndpoint;
use Modules\Ticketing\Http\Endpoints\V1\TicketShowEndpoint;
use Modules\Ticketing\Http\Endpoints\V1\Admin\TicketShowEndpoint as AdminTicketShowEndpoint;

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
        endpoint()->register(ShowTicketsUserEndpoint::class);
        endpoint()->register(AdminTicketShowEndpoint::class);
    }



    /**
     * register ModelTraits
     *
     * @return void
     */
    private function registerModelTraits()
    {
        $this->addModelTrait(TicketingRelatedWithPersonTrait::class, "Person");
        $this->addModelTrait(TicketingRelatedWithPersonTrait::class, "User");
    }


}
