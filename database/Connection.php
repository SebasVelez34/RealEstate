<?php
Class Connection
{
    private $user ;
    private $host;
    private $pass ;
    private $db;

    public function __construct()
    {
        $this->user = "root";
        $this->host = "127.0.0.1";
        $this->pass = "";
        $this->db = "prueba";
    }
    public function connect()
    {
        $link = mysqli_connect($this->host,"root", $this->pass, $this->db);
        if (mysqli_connect_errno()) {
            printf("Falló la conexión: %s\n", mysqli_connect_error());
            exit();
        }
        return $link;
    }
}
?>