<?php

namespace Tests\Unit;

use App\Currency;
use App\Employment;
use App\Experience;
use App\Offer;
use App\Role;
use App\Technologies;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OfferTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @var User|\Illuminate\Database\Eloquent\Model
     */
    private $user;
    /**
     * @var Currency|\Illuminate\Database\Eloquent\Model
     */
    private $pln;
    /**
     * @var Currency|\Illuminate\Database\Eloquent\Model
     */
    private $eur;
    /**
     * @var Experience|\Illuminate\Database\Eloquent\Model
     */
    private $junior;
    /**
     * @var Experience|\Illuminate\Database\Eloquent\Model
     */
    private $mid;
    /**
     * @var Experience|\Illuminate\Database\Eloquent\Model
     */
    private $senior;
    /**
     * @var Employment|\Illuminate\Database\Eloquent\Model
     */
    private $b2b;
    /**
     * @var Employment|\Illuminate\Database\Eloquent\Model
     */
    private $perm;
    /**
     * @var Employment|\Illuminate\Database\Eloquent\Model
     */
    private $contract;
    /**
     * @var Technologies|\Illuminate\Database\Eloquent\Model
     */
    private $js;
    /**
     * @var Technologies|\Illuminate\Database\Eloquent\Model
     */
    private $php;

    public function setUp(): void
    {
        parent::setUp();

        Role::create(['name' => 'employer']);

        $this->user = User::create([
            'name' => 'baloo',
            'email' => 'baloo@baloo.baloo',
            'password' => 'baloo'
        ]);

        $this->pln = Currency::create(['name' => 'PLN']);
        $this->eur = Currency::create(['name' => 'EUR']);

        $this->b2b = Employment::create(['name' => 'B2B']);
        $this->perm = Employment::create(['name' => 'Permanent']);
        $this->contract = Employment::create(['name' => 'Mandate contract']);

        $this->junior = Experience::create(['name' => 'Junior']);
        $this->mid = Experience::create(['name' => 'Mid']);
        $this->senior = Experience::create(['name' => 'Senior']);

        $this->js = Technologies::create(['name' => 'JS']);
        $this->php = Technologies::create(['name' => 'PHP']);

    }

    /** @test */
    public function it_can_create_an_offer()
    {
        $attr = [
            'name' => 'Junior JS Dev',
            'description' => $this->faker->sentence,
            'disclaimer' => $this->faker->sentence,
            'city' => 'Poznań',
            'street' => 'Mostowa 12',
            'contact' => $this->faker->email,
            'expires_at' => $this->faker->dateTime,
            'tech_id' => $this->js->id,
            'exp_id' => $this->junior->id,
            'emp_id' => $this->b2b->id,
        ];

        /** @var Offer $offer */
        $offer = Offer::create($attr);

        $this->assertInstanceOf('App\Offer', $offer);
        $this->assertEquals($attr['name'], $offer->name);
        $this->assertEquals($attr['description'], $offer->description);
        $this->assertEquals($attr['disclaimer'], $offer->disclaimer);
        $this->assertEquals($attr['city'], $offer->city);
        $this->assertEquals($attr['street'], $offer->street);
        $this->assertEquals($attr['contact'], $offer->contact);
        $this->assertEquals($attr['expires_at'], $offer->expires_at);
        $this->assertEquals($attr['tech_id'], $offer->tech_id);
        $this->assertEquals($attr['exp_id'], $offer->exp_id);
        $this->assertEquals($attr['emp_id'], $offer->emp_id);

        $this->assertEquals($this->js->name, $offer->technologies()->first()->name);
        $this->assertEquals($this->junior->name, $offer->experience()->first()->name);
        $this->assertEquals($this->b2b->name, $offer->employment()->first()->name);
    }
}
