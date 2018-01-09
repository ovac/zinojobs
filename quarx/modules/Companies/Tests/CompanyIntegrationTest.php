<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CompanyIntegrationTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->company = factory(App\Repositories\Company\Company::class)->make([
            // put fields here
        ]);
        $this->companyEdited = factory(App\Repositories\Company\Company::class)->make([
            // put fields here
        ]);
        $user = factory(App\Repositories\User\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', '/companies');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('companies');
    }

    public function testCreate()
    {
        $response = $this->actor->call('GET', '/companies/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'companies', $this->company->toArray());

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testEdit()
    {
        $this->actor->call('POST', 'companies', $this->company->toArray());

        $response = $this->actor->call('GET', '/companies/'.$this->company->id.'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('company');
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'companies', $this->company->toArray());
        $response = $this->actor->call('PATCH', '/companies/1', $this->companyEdited->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseHas('companies', $this->companyEdited->toArray());
        $this->assertRedirectedTo('/');
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'companies', $this->company->toArray());

        $response = $this->call('DELETE', '/companies/'.$this->company->id.'/delete');
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/companies');
    }

}
