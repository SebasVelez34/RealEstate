<?php

include_once 'models/Search.php';

class SearchController
{
    public function filter()
    {
        $query  = new Search();
        $city   = $_REQUEST["city"];
        $type   = $_REQUEST["type"];
        $price  = explode(";",$_REQUEST["price"]);

        $data = $query->filterProducts($city,$type,$price);
        if($data){
            return [
                "data" => [
                    "data"     => $data,
                    "template" => file_get_contents("./views/components/card_real_state.php")
                ],
                "type" => "JSON",
                "code" => 200
            ];
        }else{
            return [
                "data" => [],
                "type" => "JSON",
                "code" => 404
            ];
        }
    }
}

?>