<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('ibm')->unique();
            $table->string('password');
            $table->text('permissions')->nullable();
            $table->integer('role');
            $table->integer('idunit')->nullable();
            $table->integer('status');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        DB::table('users')->insert(array(
            'id'=>'1',
            'name'=>'Daniel',
            'lastname'=>'Velasquez',
            'ibm'=>'37732',
            'password' => '$2y$10$0zfZ2x2r4TwbTZ4CNTSQ6u/l8KUDBAw65WTg3EYgD/W/6l2T7ye3C', 
            'permissions' => '{"dashboard":"true","dashboard_small_stats":"true","municipalities":"true","units":"true","unit_add":"true","unit_edit":"true","unit_delete":"true","unit_search":"true","diets":"true","diet_add":"true","diet_edit":"true","diet_delete":"true","services":"true","service_add":"true","service_edit":"true","service_delete":"true","journeys":"true","journey_add":"true","journey_edit":"true","journey_delete":"true","diet_requests":"true","diet_request_add":"true","diet_request_view":"true","diet_request_delete":"true","reports":"true","report_informatica":"true","report_user":"true","report_bitacora":"true","bitacoras":"true","user_list":"true","user_add":"true","user_edit":"true","user_search":"true","user_banned":"true","user_delete":"true","user_reset_password":"true","user_permissions":"true","user_info":"true","user_change_password":"true"}', 
            'role' =>'0', 
            'status'=>'1'
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
