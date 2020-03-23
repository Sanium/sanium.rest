<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugsToOfferParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->string('city_slug')->after('city');
        });
        Schema::table('currencies', function (Blueprint $table) {
            $table->string('slug')->after('name');
        });
        Schema::table('experiences', function (Blueprint $table) {
            $table->string('slug')->after('name');
        });
        Schema::table('employments', function (Blueprint $table) {
            $table->string('slug')->after('name');
        });
        Schema::table('technologies', function (Blueprint $table) {
            $table->string('slug')->after('name');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('city_slug');
        });
        Schema::table('currencies', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('employments', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('technologies', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
