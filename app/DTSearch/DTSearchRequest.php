<?php 

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * @category
 * @package
 * @author
 * @license
 * @link
 * TODO: use in DTSearch
 */
class DTSearchRequest
{

    const TABLE = "coins";
    protected $searchRequestData;
    protected $qb;

    public function __constructor($srd)
    {
        $this->searchRequestData = $srd;
    }

    /**
     * Returns the start field
     * 
     * @return int
     */
    protected function start()
    {
        return $searchRequestData['start'];
    }

    /**
     * Returns the draw field
     * 
     * @return int
     */
    protected function draw()
    {
        return $searchRequestData['draw'];
    }

    /**
     * Returns the length field
     * 
     * @return int
     */
    protected function length()
    {
        return $searchRequestData['length'];
    }

    /**
     * Returns the search[value] field
     * 
     * @return mixed
     */
    protected function query()
    {
        return $searchRequestData['search']['value'];
    }

    /**
     * Returns the order array
     * 
     * @return array
     */
    protected function order()
    {
        return $searchRequestData['order'];
    }

    /**
     * Return the columns array
     * 
     * @return array
     */
    protected function columns()
    {
        return $this->columns;
    }

?>