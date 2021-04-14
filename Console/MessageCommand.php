<?php

namespace Modules\Ticketing\Console;

use App\Classes\Dummy;
use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Console\Command;
//TODO  We should be able to provide the fake data just by running the dummy without running other artisan commands.
class MessageCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:message {numberOfMessage} {startTicketId} {endTicketId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the desired number of messages for the desired ticket.';



    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {

        $number_of_Messages = $this->argument('numberOfMessage');
        $start_ticket_id    = $this->argument('startTicketId');
        $end_ticket_id      = $this->argument('endTicketId');
        Ticket::whereBetween('id', [$start_ticket_id, $end_ticket_id])->orderBy('id')
                                                                      ->get()
                                                                      ->map(function ($ticket) use ($number_of_Messages) {
                                                                             for ($i = 0; $i < $number_of_Messages; $i++) {
                                                                              Message::batchCreate([
                                                                                  "ticket_id"   => $ticket->id,
                                                                                  "person_id"   => ($i % 2 == 0) ? 2 : 3, //TODO
                                                                                  "title"       => Dummy::persianTitle(),
                                                                                  "description" => Dummy::persianText(),
                                                                              ]);
                                                                          }

                                                                      });


        $this->info('Messages were applied for the ticket');
    }


}
