<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Http\Abstracts\ModularMigration;

class CreateTicketsTable extends ModularMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');

            $table->integer('ref_number');
            $table->enum('type', ['immediate', 'normal', 'nonsignificant']);
            $table->enum('staus', ['pending', 'anwserd', 'finished']);
            $table->timestamps();
            $this->additionalMigrations($table);
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }

}
