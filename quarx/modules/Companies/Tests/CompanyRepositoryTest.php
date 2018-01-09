<?php

use App\Repositories\Company\CompanyRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CompanyRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->repo = $this->app->make(CompanyRepository::class);

        $this->originalArray = [];
        $this->editedArray = [];
        $this->searchTerm = '';
    }

    public function testAll()
    {
        $response = $this->repo->all();
        $this->assertEquals(get_class($response), 'Illuminate\Database\Eloquent\Collection');
        $this->assertTrue(is_array($response->toArray()));
        $this->assertEquals(0, count($response->toArray()));
    }

    public function testPaginated()
    {
        $response = $this->repo->paginated(25);
        $this->assertEquals(get_class($response), 'Illuminate\Pagination\LengthAwarePaginator');
        $this->assertEquals(0, $response->total());
    }

    public function testSearch()
    {
        $response = $this->repo->search($this->searchTerm, 25);
        $this->assertEquals(get_class($response), 'Illuminate\Pagination\LengthAwarePaginator');
        $this->assertEquals(0, $response->total());
    }

    public function testCreate()
    {
        $response = $this->repo->create($this->originalArray);
        $this->assertEquals(get_class($response), 'App\Repositories\Company\Company');
        $this->assertEquals(1, $response->id);
    }

    public function testFind()
    {
        $item = $this->repo->create($this->originalArray);

        $response = $this->repo->find($item->id);
        $this->assertEquals(1, $response->id);
    }

    public function testUpdate()
    {
        // create the item
        $item = $this->repo->create($this->originalArray);

        $response = $this->repo->update($item->id, $this->editedArray);

        $this->assertEquals(1, $response->id);
        $this->assertDatabaseHas('companies', $this->editedArray);
    }

    public function testDestroy()
    {
        // create the item
        $item = $this->repo->create($this->originalArray);

        $response = $this->repo->destroy($item->id);
        $this->assertTrue($response);
    }

}

