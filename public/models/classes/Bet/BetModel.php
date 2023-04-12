<?php
    namespace App\Models;

    class Bet{       
        private $conn;

        private $db_table = "bet";

        private $id;
        private $user_id;
        private $animal_id;
        private $contest_id;
        private $value;
        private $bet_date;

        public function __construct($db){
            $this->conn = $db;
        }

        public function setValues($ar){
            $this->user_id = $ar['user_id'];
            $this->animal_id = $ar['animal_id'];
            $this->contest_id = $ar['contest_id'];
            $this->value = $ar['value'];
            $this->bet_date = $ar['bet_date'];
        }

        public function getProperty($index){
            return $this->{$index};
        }

        public function setID($id){      
            $this->id = $id;
        }

        public function getBets(){
            $sqlQuery = "SELECT id, user_id, animal_id, contest_id, value, bet_date FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute(); 
            return $stmt;
        } 

        public function getUserBets(){
            $sqlQuery = "SELECT id, user_id, animal_id, contest_id, value, bet_date FROM " . $this->db_table . " WHERE user_id = " . $this->id;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute(); 
            return $stmt;
        } 

        public function createBet(){ 
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        user_id = :user_id, 
                        animal_id = :animal_id, 
                        contest_id = :contest_id, 
                        value = :value, 
                        bet_date = :bet_date";
        
            $stmt = $this->conn->prepare($sqlQuery); 

            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":animal_id", $this->animal_id);
            $stmt->bindParam(":contest_id", $this->contest_id);
            $stmt->bindParam(":value", $this->value);
            $stmt->bindParam(":bet_date", $this->bet_date);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function getSingleBet(){ 
            $sqlQuery = "SELECT
                        id, 
                        user_id, 
                        animal_id, 
                        contest_id, 
                        value,
                        bet_date
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(\PDO::FETCH_ASSOC);
             
            $this->user_id = $dataRow['user_id'];
            $this->animal_id = $dataRow['animal_id'];
            $this->contest_id = $dataRow['contest_id'];
            $this->value = $dataRow['value'];
            $this->bet_date = $dataRow['bet_date'];
        }        

        public function updateBet(){ 
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        user_id = :user_id, 
                        animal_id = :animal_id, 
                        contest_id = :contest_id, 
                        value = :value, 
                        bet_date = :bet_date
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery); 

            $stmt->bindParam(":user_id", $this->user_id); 
            $stmt->bindParam(":animal_id", $this->animal_id);
            $stmt->bindParam(":contest_id", $this->contest_id);
            $stmt->bindParam(":value", $this->value);
            $stmt->bindParam(":bet_date", $this->bet_date);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){  
               return true;
            }
            return false;
        }

        function deleteBet(){
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

