<?php
    error_reporting(0); session_start();
    class Crud {
        private $username = 'root';
        private $password = '';
        private $conn = '';
        private $stmt = '';
    
        function __construct() {
                try {
                    $this->conn = new PDO('mysql:host=localhost;dbname=sistema', $this->username, $this->password);
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch(PDOException $e) {
                    $this->conn =  'ERROR: ' . $e->getMessage();
                }
        }
        
        private function setParams($statement, $parameters = array())
        {

            foreach ($parameters as $key => $value) {
                
                $this->bindParam($statement, $key, $value);

            }

        }

        private function bindParam($statement, $key, $value)
        {

            $statement->bindParam($key, $value);

        }

        public function getSelect($sql, $params = '', $multi = FALSE){
            $stmt = $this->conn->prepare($sql);
            $this->setParams($stmt, $params);
            $stmt->execute();

            if($multi == FALSE) $json = json_encode($stmt->fetch(PDO::FETCH_ASSOC));
            if($multi == TRUE)  $json = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

            return json_decode($json);
        }
    }
?>