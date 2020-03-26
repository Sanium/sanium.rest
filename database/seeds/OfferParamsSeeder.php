<?php

use App\Currency;
use App\Employment;
use App\Experience;
use App\Technology;
use Illuminate\Database\Seeder;

class OfferParamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::truncate();
        Employment::truncate();
        Experience::truncate();
        Technology::truncate();

        $this->pln = Currency::create(['name' => 'PLN']);
        $this->eur = Currency::create(['name' => 'EUR']);
        $this->usd = Currency::create(['name' => 'USD']);

        $this->b2b = Employment::create(['name' => 'B2B']);
        $this->perm = Employment::create(['name' => 'Permanent']);
        $this->contract = Employment::create(['name' => 'Mandate contract']);

        $this->junior = Experience::create(['name' => 'Junior']);
        $this->mid = Experience::create(['name' => 'Mid']);
        $this->senior = Experience::create(['name' => 'Senior']);

        $this->js = Technology::create(['name' => 'JavaScript']);
        $this->php = Technology::create(['name' => 'PHP']);
        $this->php = Technology::create(['name' => 'Python']);
        $this->php = Technology::create(['name' => '.Net']);
        $this->php = Technology::create(['name' => 'C/C++']);
        $this->php = Technology::create(['name' => 'Java']);
        $this->php = Technology::create(['name' => 'Ruby']);
        $this->php = Technology::create(['name' => 'Mobile']);
        $this->php = Technology::create(['name' => 'DevOps']);
        $this->php = Technology::create(['name' => 'Security']);
        $this->php = Technology::create(['name' => 'Others']);
    }
}
