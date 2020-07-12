<?php

include_once 'models/Search.php';
include_once 'database/Connection.php';

class MainController extends Connection
{
    protected $conn;

    public function __construct()
    {
        parent::__construct();
        $this->conn =  parent::connect();
    }

    public function all()
    {
        $query  = new Search();
        $data   = $query->searchProducts();
        if($data){
            return [
                "data" => [
                    "data"     => $data["_map"],
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

    public function distinctCities()
    {
        $query  = new Search();
        $data   = $query->searchProducts();
        $cities =  array_unique(array_column($data["_map"], "Ciudad"));
        if($data){
            return [
                "data" => $cities,
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

    public function distinctTypes()
    {
        $query  = new Search();
        $data   = $query->searchProducts();
        $types =  array_unique(array_column($data["_map"], "Tipo"));
        if($data){
            return [
                "data" => $types,
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

    public function userRealState()
    {
        $data = [];
        if ($result = $this->conn->query("SELECT * FROM user_real_states;")) {
            while($obj = $result->fetch_object()){
                $response["Direccion"] = $obj->address;
                $response["Ciudad"] = $obj->city;
                $response["Telefono"] = $obj->phone;
                $response["Codigo_Postal"] = $obj->postal_code;
                $response["Tipo"] = $obj->type;
                $response["Precio"] = $obj->price;
                array_push($data,$response);
            }
        }
        $result->close();
        return [
            "data" => [
                "data"     => $data,
                "template" => file_get_contents("./views/components/save_card_real_state.php")
            ],
        ];
    }

    public function saveUserRealState()
    {
        $request = file_get_contents('php://input');
        $data    = json_decode($request,true);
        $query   = "INSERT INTO user_real_states
                    (`address`, city, phone, postal_code, `type`, `price`, `user_id`)
                    VALUES(\"{$data['address']}\", \"{$data['city']}\", \"{$data['phone']}\", \"{$data['postal_code']}\", \"{$data['type']}\",\"{$data['price']}\", 1);";

        if ($this->conn->query($query) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $query . "<br>" . $this->conn->error;
        }
    }

}

?>