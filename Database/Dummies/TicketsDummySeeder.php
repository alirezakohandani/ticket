<?php

namespace Modules\Ticketing\Database\Dummies;

use App\Classes\Dummy;
use App\Classes\TrackingNumber;
use App\Http\Abstracts\ModularDummySeeder;
use App\Models\Person;
use App\Models\Ticket;

//TODO  We should be able to provide the fake data just by running the dummy without running other artisan commands.
class TicketsDummySeeder extends ModularDummySeeder
{
    /** @var int */
    public static $order = 1; //TODO: The order of run, in relation to the other dummy classes of this module.

    /** @var int */
    protected $total;



    /**
     * seeder constructor. Params are automatically considered in the CLI dialogue when running the seeder.
     *
     * @param int $total
     */
    public function __construct(int $total = 10)
    {
        $this->total = $total;
    }



    /**
     * @inheritdoc
     */
    public function run()
    {
        for ($i = 1; $i <= $this->total; $i++) {
            $this->seedOneUser();
        }
    }



    /**
     * seed one ticket into the `tickets` table.
     *
     * @return void
     */
    private function seedOneUser()
    {
        //TODO You have to use the User model to have real users,the Person model also includes Organizations.
        $persons = Person::all('id');
        $type    = ['immediate', 'normal', 'nonsignificant'];
        $status  = ['pending', 'anwserd', 'closed'];

        $data = [
             "person_id"  => Person::where('id', rand(1, count($persons)))->select("id")
                                   ->firstOrCreate([])
                  ->id,
             "ref_number" => TrackingNumber::id2No(rand(1, 999999)),
             "type"       => $type[array_rand($type)],
             "status"     => $status[array_rand($status)],
        ];

        $ticket = Ticket::batchCreate($data);
        $ticket->messages()->create([
             "ticket_id"   => $ticket->id,
             "person_id"   => $ticket->person_id,
             "title"       => Dummy::persianTitle(),
             "description" => Dummy::persianText(),

        ])
        ;
    }
}
