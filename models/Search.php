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
        print_r($this->json);
    }
}