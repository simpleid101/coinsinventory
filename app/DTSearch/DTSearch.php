<?php 
namespace App\DTSearch;

//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
/**

 * TODO: extract DTSearchRequestClass
 */
class DTSearch
{

    const TABLE = "coins";
    protected $searchRequestData;
    protected $qb;
    protected $dtm;

    public function __construct(Request $srd, DTTableMap $dtm)
    {
        $this->searchRequestData = $srd->all();
        $this->resetQb();
        $this->dtm = $dtm;
    }

    /**
     * Returns the start field
     * 
     * @return int
     */
    public function getStart()
    {
        return $this->searchRequestData['start'];
    }

    /**
     * Returns the draw field
     * 
     * @return int
     */
    public function getDraw()
    {
        return $this->searchRequestData['draw'];
    }

    /**
     * Returns the length field
     * 
     * @return int
     */
    public function getLength()
    {
        return $this->searchRequestData['length'];
    }

    /**
     * Returns the search[value] field
     * 
     * @return mixed
     */
    public function getQuery()
    {
        return $this->searchRequestData['search']['value'];
    }

    /**
     * Returns the order array
     * 
     * @return array
     */
    public function getOrder()
    {
        return $this->searchRequestData['order'];
    }

    /**
     * Return the columns array
     * 
     * @return array
     */
    public function getColumns()
    {
        return $this->searchRequestData['columns'];
    }

    /**
     * Construct array of searchable column names
     * 
     * @return void
     * 
     * TODO:
     * db queries with columns names from user input is dumb
     */
    public function searchableColumns()
    {
        $columns = [];
        $query_type = $this->queryType($this->getQuery());

        foreach ($this->getColumns() as $c) {
            $column = $c['data'];
            if ($query_type == Schema::getColumnType($this->dtm->table($column), $column)) {
                $columns[] = $column;
            }
        }
        return $columns;
    }

    /**
     * Return data type of search query
     * 
     * @param mixed $q
     * @return string
     */
    public function queryType($q)
    {
        $type = '';
        if (is_numeric($q)) {
            $type = strpos($q, '.') ? 'float' : 'integer';
        } elseif (preg_match('/(\d{4})-(\d{2})-(\d{2})/', $q)) {
            $type = 'date';
        } else {
            $type = 'string';
        }
        return $type;
    }

    /**
     * Build database query
     * 
     * @return void
     */
    public function buildQuery()
    {
        $this->resetQb();
        foreach ($this->searchableColumns() as $column) {
            $this->qb->when(
                $this->queryType($this->getQuery()) == 'string',
                 function($query) use ($column) {
                    $this->qb->orWhere($column, 'ILIKE', '%' . $this->getQuery() . '%') ;

            }, 
            function($query) use ($column) {
                $this->qb->orWhere($this->dtm->table($column) . '.' . $column, $this->getQuery($this->getQuery())) ;
            } );  
        }

        $this->appendOrder();
    }

    public function appendOrder(){
        $this->qb->offset($this->getStart());
        $this->qb->limit($this->getLength());
        $o = $this->getOrder();
        foreach ($o as $i) {
            $this->qb->orderBy(
               'coins.'. $this->dtm->column($i['column']),
                $i['dir']
            );
        }
        return $this->qb;
    }

     /**
      * Execute database query
      * 
      * @return Collection
      */
    public function executeQuery()
    {
        return ['filtered' => $this->qb->count(), 
        'data' => $this->appendOrder()
                                
                                ->get()
    
        ];
    }

    public function get(){
        if(empty($this->getQuery())) {
            return $this->executeQuery();
        }
        $this->buildQuery();
        return $this->executeQuery();
    }

    public function setSearchQuery($v)
    {
        $this->searchRequestData['search']['value'] = $v;
    }

    public function getQb()
    {
        return $this->qb;
    }

    public function resetQb()
    {
        $this->qb = \DB::table('coins')
            ->join('mints', 'mints.id', '=', 'coins.mint_id')
            ->join('mintmarks', 'mintmarks.id', '=', 'coins.mintmark_id')
            ->select(
                'coins.id', 'bag_number', 'field_inventory', 'emperor',
                'denomination', 'mints.name', 'mintmarks.mark', 'weight',
                'diameter', 'emission', 'axis', 'find_date', 'reference',
                'square'
            );
    }
}


?>