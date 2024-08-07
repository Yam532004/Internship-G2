<?php
// used to get mysql database connection
class DatabaseService{

    private $db_host = "localhost";
    private $db_name = "internship_g2";
    private $db_user = "root";
    private $db_password = "";
    private $connection;

    public function getConnection(){

        $this->connection = null;

        try{
            // $this->connection = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_user, $this->db_password);
            $this->connection = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name . ";charset=utf8mb4", $this->db_user, $this->db_password);
        }catch(PDOException $exception){
            echo "Connection failed: " . $exception->getMessage();
        }

        return $this->connection;
    }
}
?>