<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToDietRequestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diet_request_details', function (Blueprint $table) {
            $table->integer('type_pack')->after('bed_number')->nullable();
            $table->integer('type_diet_1')->after('type_pack')->nullable();
            $table->integer('type_diet_hiposodicas')->after('type_diet_1')->nullable();
            $table->integer('type_diet_renal')->after('type_diet_hiposodicas')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diet_request_details', function (Blueprint $table) {
            //
        });
    }
}
