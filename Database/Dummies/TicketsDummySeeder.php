<?php

namespace Modules\Ticketing\Database\Dummies;

use App\Classes\Dummy;
use App\Classes\TrackingNumber;
use App\Http\Abstracts\ModularDummySeeder;
use App\Models\Person;
use App\Models\Ticket;

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

        Ticket::batchCreate($data);
    }
}
