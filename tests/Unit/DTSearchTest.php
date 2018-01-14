<?php

namespace Tests\Unit;



use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\DTSearch\DTSearch;

class DTSearchTest extends TestCase
{
    
    public function setUp()
    {
        parent::setUp();
        $data = [
            'start' => '0',
            'draw' => '1',
            'length' => '10',
            'search' => ['regex' => "false", 'value' => 'king'],
            'order' => [ ['column' => '0', 'dir' => 'asc'] ],
            'columns' => [
                            ['data' => 'id', 'name' => null, 'orderable' => 'true', 'searchable' => 'true', 
                            'search' => ['value' => null, 'regex' => 'false'] ],
                            
                            ['data' => 'bag_number', 'name' => null, 'orderable' => 'true', 'searchable' => 'true', 
                            'search' => ['value' => null, 'regex' => 'false'] ],

                            ['data' => 'field_inventory', 'name' => null, 'orderable' => 'true', 'searchable' => 'true', 
                            'search' => ['value' => null, 'regex' => 'false'] ],

                            ['data' => 'emperor', 'name' => null, 'orderable' => 'true', 'searchable' => 'true', 
                            'search' => ['value' => null, 'regex' => 'false'] ],

                            ['data' => 'denomination', 'name' => null, 'orderable' => 'true', 'searchable' => 'true', 
                            'search' => ['value' => null, 'regex' => 'false'] ],

                            ['data' => 'name', 'name' => null, 'orderable' => 'true', 'searchable' => 'true', 
                            'search' => ['value' => null, 'regex' => 'false'] ],

                            ['data' => 'mark', 'name' => null, 'orderable' => 'true', 'searchable' => 'true', 
                            'search' => ['value' => null, 'regex' => 'false'] ],

                            ['data' => 'weight', 'name' => null, 'orderable' => 'true', 'searchable' => 'true', 
                            'search' => ['value' => null, 'regex' => 'false'] ],

                            ['data' => 'diameter', 'name' => null, 'orderable' => 'true', 'searchable' => 'true', 
                            'search' => ['value' => null, 'regex' => 'false'] ],

                            ['data' => 'emission', 'name' => null, 'orderable' => 'true', 'searchable' => 'true', 
                            'search' => ['value' => null, 'regex' => 'false'] ],

                            ['data' => 'axis', 'name' => null, 'orderable' => 'true', 'searchable' => 'true', 
                            'search' => ['value' => null, 'regex' => 'false'] ],

                            ['data' => 'find_date', 'name' => null, 'orderable' => 'true', 'searchable' => 'true', 
                            'search' => ['value' => null, 'regex' => 'false'] ],

                            ['data' => 'reference', 'name' => null, 'orderable' => 'true', 'searchable' => 'true', 
                            'search' => ['value' => null, 'regex' => 'false'] ],

                            ['data' => 'square', 'name' => null, 'orderable' => 'true', 'searchable' => 'true', 
                            'search' => ['value' => null, 'regex' => 'false'] ],
            ]
        ];

        $dtm = new \App\DTSearch\DTTableMap;
        $this->dt = new DTSearch(\Request::create('/search', 'POST', $data), $dtm);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * Test getters
     */
    public function testGetters(){
        $this->assertEquals('0', $this->dt->getStart());
        $this->assertEquals('1', $this->dt->getDraw());
        $this->assertEquals('10', $this->dt->getLength());
        $this->assertEquals('king', $this->dt->getQuery());
        $this->assertEquals([['column' => '0', 'dir'=> 'asc' ]]
        , $this->dt->getOrder());
        $this->assertTrue(is_array($this->dt->getColumns()));      
    }

    public function testqueryType(){
        $this->assertEquals(
            $this->dt->queryType($this->dt->getQuery()),
            'string' 
        );

        $this->dt->setSearchQuery('1');
        $this->assertEquals(
            $this->dt->queryType($this->dt->getQuery()),
            'integer' 
        );

        $this->dt->setSearchQuery('1.0');
        $this->assertEquals(
            $this->dt->queryType($this->dt->getQuery()),
            'float' 
        );

        $this->dt->setSearchQuery('1234-12-12');
        $this->assertEquals(
            $this->dt->queryType($this->dt->getQuery()),
            'date' 
        );
    }

    public function testSearchableColumns()
    {
        $this->assertEquals(array_diff_key($this->dt->searchableColumns(), 
        ['field_inventory', 'emperor', 'denomination', 'emission',
         'reference', 'square', 'mark', 'name']), []);
         $this->dt->setSearchQuery('2017-12-15');
         $this->assertEquals($this->dt->searchableColumns(),
         ['find_date']);
         
         $this->dt->setSearchQuery('10');
         $this->assertEquals($this->dt->searchableColumns(),
         ['id', 'bag_number', 'diameter', 'axis']);

         $this->dt->setSearchQuery('2017.12');
         $this->assertEquals($this->dt->searchableColumns(),
         ['weight']);


        }

    
    public function testbuildQuery()
    {
        $this->assertNotFalse($this->dt->getQb());
        $this->dt->buildQuery();
        $data = $this->dt->executeQuery()['data'];
        $this->assertEquals(0, $data->count());

        $this->dt->setSearchQuery('15 denars');
        $this->dt->buildQuery();
        $data = $this->dt->executeQuery()['data'];
        $this->assertEquals(1, $data->count());

        $this->dt->setSearchQuery('AE');
        $this->dt->buildQuery();
        $data = $this->dt->executeQuery()['data'];
        $this->assertEquals(9, $data->count());

        $this->dt->setSearchQuery('A');
        $this->dt->buildQuery();
        $data = $this->dt->executeQuery()['data'];
        $this->assertEquals(10, $data->count());

        $this->dt->setSearchQuery('mkmk');
        $this->dt->buildQuery();
        $data = $this->dt->executeQuery()['data'];
        $this->assertEquals(2, $data->count());

        $this->dt->setSearchQuery('15');
        $this->dt->buildQuery();
        $data = $this->dt->executeQuery()['data'];
        $this->assertEquals(1, $data->count());

        $this->dt->setSearchQuery('RIC 15');
        $this->dt->buildQuery();
        $data = $this->dt->executeQuery()['data'];
        $this->assertEquals(8, $data->count());

        $this->dt->setSearchQuery('A100/1000');
        $this->dt->buildQuery();
        $data = $this->dt->executeQuery()['data'];
        $this->assertEquals(2, $data->count());

        $this->dt->setSearchQuery('2017-12-11');
        $this->dt->buildQuery();
        $data = $this->dt->executeQuery()['data'];
        $this->assertEquals(2, $data->count());

        $this->dt->setSearchQuery('10.00');
        $this->dt->buildQuery();
        $data = $this->dt->executeQuery()['data'];
        $this->assertEquals(9, $data->count());
    }

}
