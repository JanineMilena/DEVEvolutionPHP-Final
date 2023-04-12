<?php
    namespace App\Models;

    class Result{       
        private $conn;

        private $db_table = "result";

        private $id;
        private $contest_id;
        private $animal_id;
        private $result_date;

        public function __construct($db){
            $this->conn = $db;
        }

        public function setValues($ar){
            $this->contest_id = $ar['contest_id'];
            $this->animal_id = $ar['animal_id'];
            $this->result_date = $ar['result_date'];
        }

        public function getProperty($index){
            return $this->{$index};
        }

        public function setID($id){      
            $this->id = $id;
        }

        public function getResults(){
            $sqlQuery = "SELECT id, contest_id, animal_id, result_date FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute(); 
            return $stmt;
        } 

        public function createResult(){ 
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        contest_id = :contest_id, 
                        animal_id = :animal_id, 
                        result_date = :result_date";
        
            $stmt = $this->conn->prepare($sqlQuery); 

            $stmt->bindParam(":contest_id", $this->contest_id);
            $stmt->bindParam(":animal_id", $this->animal_id);
            $stmt->bindParam(":result_date", $this->result_date);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function getSingleResult(){ 
            $sqlQuery = "SELECT
                        id, 
                        contest_id, 
                        animal_id, 
                        result_date
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(\PDO::FETCH_ASSOC);
             
            $this->contest_id = $dataRow['contest_id'];
            $this->animal_id = $dataRow['animal_id'];
            $this->result_date = $dataRow['result_date'];
        }        

        public function updateResult(){ 
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        contest_id = :contest_id, 
                        animal_id = :animal_id, 
                        result_date = :result_date
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery); 

            $stmt->bindParam(":contest_id", $this->contest_id); 
            $stmt->bindParam(":animal_id", $this->animal_id);
            $stmt->bindParam(":result_date", $this->result_date);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){  
               return true;
            }
            return false;
        }

        function deleteResult(){
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

