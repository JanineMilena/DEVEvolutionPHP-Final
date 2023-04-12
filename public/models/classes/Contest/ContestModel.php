<?php
    namespace App\Models;
    
    class Contest{       
        private $conn;

        private $db_table = "contest";

        public $id;
        private $start_date;
        private $end_date;
        private $modifier;
        public $status;


        public function __construct($db){
            $this->conn = $db;
        }

        public function setValues($ar){
            $this->start_date = $ar['start_date'];
            $this->end_date = $ar['end_date'];
            $this->modifier = $ar['modifier'];
            $this->status = $ar['status'];
        }

        public function getProperty($index){
            return $this->{$index};
        }

        public function setID($id){      
            $this->id = $id;
        }

        public function setStatus($status){      
            $this->status = $status;
        }

        public function getContests(){
            $sqlQuery = "SELECT id, start_date, end_date, modifier, status FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute(); 
            return $stmt;
        } 

        public function getOpenContests(){
            $sqlQuery = "SELECT id, start_date, end_date, modifier, status FROM " . $this->db_table . " WHERE status = 'open'";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute(); 
            return $stmt;
        } 

        public function createContest(){ 
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        start_date = :start_date, 
                        end_date = :end_date, 
                        modifier = :modifier, 
                        status = :status";
        
            $stmt = $this->conn->prepare($sqlQuery); 

            $stmt->bindParam(":start_date", $this->start_date);
            $stmt->bindParam(":end_date", $this->end_date);
            $stmt->bindParam(":modifier", $this->modifier);
            $stmt->bindParam(":status", $this->status);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function getSingleContest(){ 
            $sqlQuery = "SELECT
                        id, 
                        start_date, 
                        end_date, 
                        modifier, 
                        status
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(\PDO::FETCH_ASSOC);
             
            $this->start_date = $dataRow['start_date'];
            $this->end_date = $dataRow['end_date'];
            $this->modifier = $dataRow['modifier'];
            $this->status = $dataRow['status'];
        }        

        public function updateContest(){ 
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        start_date = :start_date, 
                        end_date = :end_date, 
                        modifier = :modifier, 
                        status = :status
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery); 

            $stmt->bindParam(":start_date", $this->start_date); 
            $stmt->bindParam(":end_date", $this->end_date);
            $stmt->bindParam(":modifier", $this->modifier);
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){  
               return true;
            }
            return false;
        }

        public function updateContestStatus(){ 
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        status = :status
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){  
               return true;
            }
            return false;
        }

        function deleteContest(){
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