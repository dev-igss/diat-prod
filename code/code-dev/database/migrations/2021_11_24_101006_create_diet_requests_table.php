<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diet_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idjourney');
            $table->integer('idapplicant'); 
            $table->integer('idapplicant_service');
            $table->integer('total_diets');
            $table->integer('diets_served');
            $table->integer('iduser_served');
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
        Schema::dropIfExists('diet_requests');
    }
}
