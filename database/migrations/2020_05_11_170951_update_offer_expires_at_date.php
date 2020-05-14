<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOfferExpiresAtDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $offers = DB::table('offers')->select('id', 'created_at')->get();
        foreach ($offers as $offer) {
            $created_at = new \Illuminate\Support\Carbon($offer->created_at);
            $expires_at = $created_at->addDays(30);
            DB::table('offers')->where('id', $offer->id)->update(['expires_at' => $expires_at]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('offers')->update(['expires_at' => null]);
    }
}
