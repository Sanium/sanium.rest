<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->longText('description');
            $table->string('disclaimer');
            $table->integer('exp_id')->unsigned()->nullable();
            $table->integer('emp_id')->unsigned()->nullable();
            $table->integer('salary_from')->unsigned()->nullable();
            $table->integer('salary_to')->unsigned()->nullable();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->string('city');
            $table->string('street');
            $table->boolean('remote')->default(false);
            $table->text('tech_stack')->nullable()->comment('Stored as JSON');
            $table->integer('tech_id')->unsigned();
            $table->string('contact');
            $table->timestamp('expires_at');
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
        Schema::dropIfExists('offers');
    }
}
