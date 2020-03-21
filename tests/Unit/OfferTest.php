<?php

namespace Tests\Unit;

use App\Currency;
use App\Employment;
use App\Experience;
use App\Offer;
use App\Role;
use App\Technologies;
use App\User;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
    /**
     * @var array
     */
    private $attr;
    /**
     * @var Offer|\Illuminate\Database\Eloquent\Model
     */
    private $offer;

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

        $this->attr = [
            'name' => 'Junior JS Dev',
            'description' => $this->faker->sentence,
            'disclaimer' => $this->faker->sentence,
            'exp_id' => $this->junior->id,
            'emp_id' => $this->b2b->id,
            'salary_from' => 1000,
            'salary_to' => 3000,
            'currency_id' => $this->pln->id,
            'city' => 'Poznań',
            'street' => 'Mostowa 12',
            'tech_id' => $this->js->id,
            'tech_stack' => '{js: 5, php: 4}',
            'contact' => $this->faker->email,
            'expires_at' => $this->faker->dateTime,
        ];

        $this->offer = $this->user->offers()->create($this->attr);
    }

    /** @test */
    public function it_can_create_an_offer()
    {
        $this->assertInstanceOf('App\Offer', $this->offer);
        $this->assertEquals($this->attr['name'], $this->offer->name);
        $this->assertEquals($this->attr['description'], $this->offer->description);
        $this->assertEquals($this->attr['disclaimer'], $this->offer->disclaimer);
        $this->assertEquals($this->attr['exp_id'], $this->offer->exp_id);
        $this->assertEquals($this->attr['emp_id'], $this->offer->emp_id);
        $this->assertEquals($this->attr['salary_from'], $this->offer->salary_from);
        $this->assertEquals($this->attr['salary_to'], $this->offer->salary_to);
        $this->assertEquals($this->attr['currency_id'], $this->offer->currency_id);
        $this->assertEquals($this->attr['city'], $this->offer->city);
        $this->assertEquals($this->attr['street'], $this->offer->street);
        $this->assertEquals(false, $this->offer->remote);
        $this->assertEquals($this->attr['tech_stack'], $this->offer->tech_stack);
        $this->assertEquals($this->attr['contact'], $this->offer->contact);
        $this->assertEquals($this->attr['expires_at'], $this->offer->expires_at);
        $this->assertEquals($this->attr['tech_id'], $this->offer->tech_id);

    }

    /** @test */
    public function offer_belongs_to_user()
    {
        $this->assertEquals($this->user->name, $this->offer->user()->first()->name);
        $this->assertEquals($this->user->offers()->where('name', $this->attr['name'])->first()->name, $this->offer->name);
    }

    /** @test */
    public function offer_has_one_technology()
    {
        $this->assertInstanceOf(HasOne::class, $this->offer->technologies());
        $this->assertEquals($this->js->name, $this->offer->technologies()->first()->name);
    }

    /** @test */
    public function offer_has_one_experience()
    {
        $this->assertInstanceOf(HasOne::class, $this->offer->experience());
        $this->assertEquals($this->junior->name, $this->offer->experience()->first()->name);
    }

    /** @test */
    public function offer_has_one_employment()
    {
        $this->assertInstanceOf(HasOne::class, $this->offer->employment());
        $this->assertEquals($this->b2b->name, $this->offer->employment()->first()->name);
    }
    /** @test */
    public function offer_has_one_currency()
    {
        $this->assertInstanceOf(HasOne::class, $this->offer->currency());
        $this->assertEquals($this->pln->name, $this->offer->currency()->first()->name);
    }

}
