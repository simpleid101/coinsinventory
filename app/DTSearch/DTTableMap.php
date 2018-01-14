<?php

namespace App\DTSearch;

class DTTableMap
{
    protected $map;

    public function __construct()
    {
        $this->map = [
            'id'             => 'coins',
           "bag_number"      => 'coins',
           "field_inventory" => 'coins',
           "emperor"         => 'coins',
           "denomination"    => 'coins',
           "name"            => 'mints',
           "mark"            => 'mintmarks',
           "weight"          => 'coins',
           "diameter"        => 'coins',
           "emission"        => 'coins',
           "axis"            => 'coins',
           "find_date"       => 'coins',
           "reference"       => 'coins',
           "square"          => 'coins'
        ];
    }

    public function map(){
        return $this->map;
    }

    public function table($column)
    {
        return $this->map[$column];    
    }

    public function column($c)
    {
        $columns = array_keys($this->map());
        return $columns[$c];
    }

    public function for_dt_columns(){
        $return = [];
        foreach (array_keys($this->map) as $key) {
            array_push($return, ['data' => $key]);
        }
        return json_encode($return);
    }

}

?>