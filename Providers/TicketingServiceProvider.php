<?php

namespace Modules\Ticketing\Providers;

use App\Http\Abstracts\ModularProvider;
use Modules\Ticketing\Console\MessageCommand;
use Modules\Ticketing\Entities\Traits\TicketingRelatedWithPersonTrait;
use Modules\Ticketing\Events\TicketCreated;
use Modules\Ticketing\Http\Endpoints\V1\AdminStatusChangeEndpoint;
use Modules\Ticketing\Http\Endpoints\V1\AdminTicketCloseEndpoint;
use Modules\Ticketing\Http\Endpoints\V1\AdminTicketsShowEndpoint;
use Modules\Ticketing\Http\Endpoints\V1\AdminTicketTrackEndpoint;
use Modules\Ticketing\Http\Endpoints\V1\ShowTicketsUserEndpoint;
use Modules\Ticketing\Http\Endpoints\V1\TicketSaveEndpoint;
use Modules\Ticketing\Http\Endpoints\V1\TicketShowEndpoint;
use Modules\Ticketing\Listeners\SendEmail;


class TicketingServiceProvider extends ModularProvider
{
    /**
     * @inheritdoc
     */
    public function index()
    {
        $this->registerEndpoints();
        $this->registerModelTraits();
        $this->registerArtisanCommands();
        $this->registerEvents();
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
        endpoint()->register(AdminTicketsShowEndpoint::class);
        endpoint()->register(AdminTicketCloseEndpoint::class);
        endpoint()->register(AdminStatusChangeEndpoint::class);
        endpoint()->register(AdminTicketTrackEndpoint::class);
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



    /**
     * register artisan commands
     *
     * @return void
     */
    private function registerArtisanCommands()
    {
        $this->addArtisan(MessageCommand::class);
    }

    /**
     * register events
     *
     * @return void
     */
    private function registerEvents()
    {
        $this->listen(TicketCreated::class, SendEmail::class);
    }

}
