<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietRequestsOutTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diet_requests_out_time', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idjourney');
            $table->integer('idapplicant');
            $table->integer('amount_diets');
            $table->integer('time_available');
            $table->integer('status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diet_requests_out_time');
    }
}
