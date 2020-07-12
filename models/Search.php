<?php

include_once 'services/QueryBuilder.php';

class Search
{

    private $json;

    public function __construct()
    {
        $this->json = new QueryBuilder();
    }

    public function searchProducts()
    {
        return (array)$this->json;
    }

    public function filterProducts($city = "",$type= "",$price = "")
    {
        $data   = $this->searchProducts()["_map"];
        $f = [];
        $filter = array_filter($data,function($el) use($city,$type,$price)
        {
            $remove = array("$",",");
            $p      = str_replace($remove,"",$el["Precio"]);

            return ($city != "" ? $el["Ciudad"] == $city : $el["Ciudad"]) &&
                   ($type != "" ? $el["Tipo"]   == $type : $el["Tipo"])   &&
                   ( (int)$p >= (int)$price[0] && (int)$p <= (int)$price[1] );
        });
        foreach ($filter as $key => $value) {
            array_push($f,$value);
        }
        return (array)$f;
    }
}