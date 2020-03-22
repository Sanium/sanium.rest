<?php

use App\Currency;
use App\Employment;
use App\Experience;
use App\Technology;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->pln = Currency::create(['name' => 'PLN']);
        $this->eur = Currency::create(['name' => 'EUR']);

        $this->b2b = Employment::create(['name' => 'B2B']);
        $this->perm = Employment::create(['name' => 'Permanent']);
        $this->contract = Employment::create(['name' => 'Mandate contract']);

        $this->junior = Experience::create(['name' => 'Junior']);
        $this->mid = Experience::create(['name' => 'Mid']);
        $this->senior = Experience::create(['name' => 'Senior']);

        $this->js = Technology::create(['name' => 'JS']);
        $this->php = Technology::create(['name' => 'PHP']);
    }
}
