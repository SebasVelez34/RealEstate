<?php

include_once 'models/Search.php';

class SearchController
{

    public function all()
    {
        $query = new Search();
        print_r($query->searchProducts());
    }
}

?>