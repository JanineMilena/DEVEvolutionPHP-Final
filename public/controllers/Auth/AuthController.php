<?php
    namespace App\Controller;

    class Auth {
        private $conn;
        private $db;

        public function __construct() {
            require_once __DIR__ . '/../../models/config/DatabaseModel.php';
            $this->db = new \App\Config\Database();
            $this->conn = $this->db->getConnection();
        }

        public function login($email, $password) {
            $sqlQuery = "SELECT id, email, password, permission_type FROM user WHERE email = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $email);
            $stmt->execute();

            if($stmt->rowCount() == 1) {
                $dataRow = $stmt->fetch(\PDO::FETCH_ASSOC);
                $hashed_password = $dataRow['password'];
                $permission_type = $dataRow['permission_type'];

                if(password_verify($password, $hashed_password)) {
                    //session_start();
                    $_SESSION['id'] = $dataRow['id'];
                    $_SESSION['permission_type'] = $permission_type;
                    return true;
                }
            }
            return false;
        }

        public function checkPermission($required_permission) {
            //session_start();
            if(isset($_SESSION['id']) && isset($_SESSION['permission_type'])) {
                $user_permission = $_SESSION['permission_type'];
                if($user_permission != $required_permission) {
                    return true;
                }
            }
            return false;
        }

        public function logout() {
            session_start();
            session_destroy();
        }
    }
?>