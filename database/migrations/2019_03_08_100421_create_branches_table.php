<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document', 20);
            $table->string('company_name');
            $table->string('phone', 50);
            $table->string('email');
            $table->string('address');
            $table->string('complement');
            $table->integer('address_number');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->boolean('active');
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
        Schema::drop('branches');
        Schema::drop('branches');
    }
}
