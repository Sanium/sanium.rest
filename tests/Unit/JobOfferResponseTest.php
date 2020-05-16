<?php

namespace Tests\Unit;

use App\Currency;
use App\Employment;
use App\Experience;
use App\JobOfferResponse;
use App\Offer;
use App\Role;
use App\Technology;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JobOfferResponseTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @var User|null
     */
    private $employer;
    /**
     * @var Currency
     */
    private $pln;
    /**
     * @var Currency
     */
    private $eur;
    /**
     * @var Experience
     */
    private $junior;
    /**
     * @var Experience
     */
    private $mid;
    /**
     * @var Experience
     */
    private $senior;
    /**
     * @var Employment
     */
    private $b2b;
    /**
     * @var Employment
     */
    private $perm;
    /**
     * @var Employment
     */
    private $contract;
    /**
     * @var Technology
     */
    private $js;
    /**
     * @var Technology
     */
    private $php;
    /**
     * @var array
     */
    private $offer_attr;
    /**
     * @var Offer
     */
    private $offer;
    /**
     * @var User
     */
    private $client;
    /**
     * @var User|null
     */
    private $employer2;
    /**
     * @var Offer
     */
    private $offer2;

    public function setUp(): void
    {
        parent::setUp();

        Role::create(['name' => 'employer']);
        Role::create(['name' => 'client']);
        Role::create(['name' => 'admin']);

        $this->employer = User::createWithRole([
            'name' => 'baloo',
            'email' => 'baloo@baloo.baloo',
            'password' => 'baloo',
            'role' => 'employer'
        ]);
        $profile_attr = [
            'name' => $this->employer->name,
            'website' => 'http://baloo.baloo',
            'size' => 15,
            'logo' => 'path_to_logo'
        ];
        if (null !== $this->employer) {
            $this->employer->profile()->create($profile_attr);
        }

        $this->employer2 = User::createWithRole([
            'name' => 'baloo2',
            'email' => 'baloo2@baloo.baloo',
            'password' => 'baloo2',
            'role' => 'employer'
        ]);
        $profile_attr = [
            'name' => $this->employer2->name,
            'website' => 'http://baloo.baloo',
            'size' => 15,
            'logo' => 'path_to_logo'
        ];
        if (null !== $this->employer2) {
            $this->employer2->profile()->create($profile_attr);
        }

        $this->client = User::createWithRole([
            'name' => 'Baloo Bartix',
            'email' => 'baloo@bartix.com',
            'password' => 'baloo',
            'role' => 'client'
        ]);
        $profile_attr = [
            'name' => $this->client->name,
            'links' => 'http://links.baloo',
            'file' => 'path_to_logo'
        ];
        if (null !== $this->client) {
            $this->client->profile()->create($profile_attr);
        }

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

        $this->offer_attr = [
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
        ];

        $this->offer = $this->employer->offers()->create($this->offer_attr);
        $this->offer2 = $this->employer2->offers()->create($this->offer_attr);
    }

    /** @test */
    public function registered_client_can_create_job_offer_response(): void
    {
        $client_user_id = $this->client->id;
        /** @var JobOfferResponse $jor */
        $jor = $this->offer->jobOfferResponses()->create([
            'user_id' => $client_user_id,
            'name' => $this->client->profile->name,
            'email' => $this->client->email,
            'links' => $this->client->profile->links,
            'file' => $this->client->profile->file
        ]);

        $this->assertInstanceOf(JobOfferResponse::class, $jor);

        $this->assertEquals($this->client->profile->name, $jor->name);
        $this->assertEquals($this->client->email, $jor->email);
        $this->assertEquals($this->client->profile->links, $jor->links);
        $this->assertEquals($this->client->profile->file, $jor->file);

        // belongs to offer
        $this->assertEquals($this->offer->id, $jor->offer_id);
        $this->assertEquals($this->offer->name, $jor->offer->name);
        $this->assertEquals($jor->id, $this->offer->jobOfferResponses()->find($jor->id)->id);

        // belongs to client
        $this->assertEquals($this->client->id, $jor->user->id);
        $this->assertEquals($this->client->name, $jor->user->name);
        $this->assertEquals($jor->id, $this->client->jobOfferResponses()->find($jor->id)->id);
        $this->assertCount(1, $this->client->jobOfferResponses);

    }

    /** @test */
    public function guest_client_can_create_job_offer_response(): void
    {
        /** @var JobOfferResponse $jor */
        $jor = $this->offer->jobOfferResponses()->create([
            'name' => $this->client->profile->name,
            'email' => $this->client->email,
            'links' => $this->client->profile->links,
            'file' => $this->client->profile->file
        ]);

        $this->assertInstanceOf(JobOfferResponse::class, $jor);

        $this->assertEquals($this->client->profile->name, $jor->name);
        $this->assertEquals($this->client->email, $jor->email);
        $this->assertEquals($this->client->profile->links, $jor->links);
        $this->assertEquals($this->client->profile->file, $jor->file);

        // belongs to offer
        $this->assertEquals($this->offer->id, $jor->offer_id);
        $this->assertEquals($this->offer->name, $jor->offer->name);
        $this->assertEquals($jor->id, $this->offer->jobOfferResponses()->find($jor->id)->id);

        // belongs to client
        $this->assertNull($jor->user);
        $this->assertCount(0, $this->client->jobOfferResponses);

    }

    /** @test */
    public function employer_can_see_responses_for_offer(): void
    {
        /** @var JobOfferResponse $jor */
        $jor1 = $this->offer->jobOfferResponses()->create([
            'name' => $this->client->profile->name,
            'email' => $this->client->email,
            'links' => $this->client->profile->links,
            'file' => $this->client->profile->file
        ]);

        /** @var JobOfferResponse $jor */
        $jor2 = $this->offer2->jobOfferResponses()->create([
            'name' => $this->client->profile->name,
            'email' => $this->client->email,
            'links' => $this->client->profile->links,
            'file' => $this->client->profile->file
        ]);

        $this->assertCount(1, $this->employer->jobOfferResponses);
        $this->assertCount(1, $this->employer2->jobOfferResponses);
        $this->assertCount(0, $this->client->jobOfferResponses);
    }
}
