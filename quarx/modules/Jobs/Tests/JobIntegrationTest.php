<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class JobIntegrationTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->job = factory(App\Repositories\Job\Job::class)->make([
            // put fields here
        ]);
        $this->jobEdited = factory(App\Repositories\Job\Job::class)->make([
            // put fields here
        ]);
        $user = factory(App\Repositories\User\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', '/jobs');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('jobs');
    }

    public function testCreate()
    {
        $response = $this->actor->call('GET', '/jobs/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'jobs', $this->job->toArray());

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testEdit()
    {
        $this->actor->call('POST', 'jobs', $this->job->toArray());

        $response = $this->actor->call('GET', '/jobs/'.$this->job->id.'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('job');
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'jobs', $this->job->toArray());
        $response = $this->actor->call('PATCH', '/jobs/1', $this->jobEdited->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseHas('jobs', $this->jobEdited->toArray());
        $this->assertRedirectedTo('/');
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'jobs', $this->job->toArray());

        $response = $this->call('DELETE', '/jobs/'.$this->job->id.'/delete');
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/jobs');
    }

}
