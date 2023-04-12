<?php
    namespace App\Models;

    class Animal{       
        private $conn;

        private $db_table = "animal";

        private $id;
        private $name;
        private $number;
        private $number_1;
        private $number_2;
        private $number_3;
        private $number_4;

        public function __construct($db){
            $this->conn = $db;
        }

        public function getProperty($index){
            return $this->{$index};
        }

        public function setID($id){      
            $this->id = $id;
        }

        public function setNumber($number){      
            $this->number = $number;
        }

        public function getAnimals(){
            $sqlQuery = "SELECT id, name, number_1, number_2, number_3, number_4 FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute(); 
            return $stmt;
        } 

        public function getSingleAnimal(){ 
            $sqlQuery = "SELECT
                        id, 
                        name, 
                        number_1, 
                        number_2, 
                        number_3,
                        number_4
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
            $this->number_1 = $dataRow['number_1'];
            $this->number_2 = $dataRow['number_2'];
            $this->number_3 = $dataRow['number_3'];
            $this->number_3 = $dataRow['number_4'];
        }        

        public function getAnimalIDByNumber(){ 
            $sqlQuery = "SELECT
                        id
                    FROM
                        ". $this->db_table ."
                    WHERE (
                        number_1 = ? OR 
                        number_2 = ? OR
                        number_3 = ? OR 
                        number_4 = ?
                    )
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->number);
            $stmt->bindParam(2, $this->number);
            $stmt->bindParam(3, $this->number);
            $stmt->bindParam(4, $this->number);

            $stmt->execute();

            $dataRow = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            $this->id = $dataRow['id'];
            return $this->id;
        }        
    }
?>

