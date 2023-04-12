<?php 
    namespace App\Config;

    class Database {
        private $host = "172.18.0.2"; // Validar o funcionamento com alias do container | docker inspect mariadb | grep IPAddress
        private $database_name = "database";  
        private $username = "user"; 
        private $password = "password";

        public $conn;

 
        public function getConnection(){    
            $this->conn = null;
            try{
                $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(\PDOException $exception){
                echo "sem conexão: " . $exception->getMessage();
            }
    
            return $this->conn;
        }
    }      
?>