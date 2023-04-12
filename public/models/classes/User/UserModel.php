<?php
    namespace App\Models;
    
    class User{       
        private $conn;

        private $db_table = "user";

        private $id;
        private $name;
        private $email;
        private $password;
        private $creation_date;
        private $permission_type;

        public function __construct($db){
            $this->conn = $db;
        }

        public function setValues($ar){
            $this->name = $ar['name'];
            $this->email = $ar['email'];
            $this->password = password_hash($ar['password'], PASSWORD_DEFAULT);
            $this->permission_type = $ar['permission_type'];
        }

        public function getProperty($index){
            return $this->{$index};
        }

        public function setID($id){      
            $this->id = $id;
        }

        public function getUsers(){
            $sqlQuery = "SELECT id, name, email, password, creation_date, permission_type FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute(); 
            return $stmt;
        } 

        public function createUser(){ 
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        email = :email, 
                        password = :password, 
                        permission_type = :permission_type";
        
            $stmt = $this->conn->prepare($sqlQuery); 

            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":permission_type", $this->permission_type);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function getSingleUser(){ 
            $sqlQuery = "SELECT
                        id, 
                        name, 
                        email, 
                        password, 
                        creation_date,
                        permission_type
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(\PDO::FETCH_ASSOC);
             
            $this->name = $dataRow['name'];
            $this->email = $dataRow['email'];
            $this->password = $dataRow['password'];
            $this->creation_date = $dataRow['creation_date'];
            $this->permission_type = $dataRow['permission_type'];
        }        

        public function updateUser(){ 
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        email = :email, 
                        password = :password, 
                        permission_type = :permission_type
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery); 

            $stmt->bindParam(":name", $this->name); 
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":permission_type", $this->permission_type);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){  
               return true;
            }
            return false;
        }

        function deleteUser(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>