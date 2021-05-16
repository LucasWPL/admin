<?php
    session_start(); error_reporting(0);
    class Crud extends \PDO{
        private $db = 'sistema';
        private $username = 'root';
        private $password = '';
        private $conn = '';
        private $stmt = '';
        
        public function rollbackId($tabela)
        {
            $auto = $this-> getSelect("SELECT `AUTO_INCREMENT` as auto FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '{$this->db}' AND  TABLE_NAME = '{$tabela}'");
            $index = $auto->auto - 1;
            $retorno = $this-> sql("ALTER TABLE {$tabela} AUTO_INCREMENT = {$index}");
        }

        public function __construct()
        {
            $this->conn = parent :: __construct("mysql:host=localhost;dbname={$this->db}", $this->username, $this->password);
        }
        
        
        private function setParams($statement, $parameters = '')
        {
            if($parameters != ''){
                foreach ($parameters as $key => $value) {
                
                    $this->bindParam($statement, $key, $value);
    
                }
            }
        }

        private function bindParam($statement, $key, $value)
        {

            $statement->bindParam($key, $value);

        }

        public function getSelect($sql, $params = '', $multi = FALSE){
            $stmt = parent::prepare($sql);
            $this->setParams($stmt, $params);
            $stmt->execute();

            if($multi == FALSE) $json = json_encode($stmt->fetch(PDO::FETCH_ASSOC));
            if($multi == TRUE)  $json = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

            return json_decode($json);
        }

        public function sql($sql, $params = ''){
            $stmt = parent::prepare($sql);
            $this->setParams($stmt, $params);
            $retorno = $stmt->execute();
            return $retorno;
        }

        public function update($dados, $tabela, $id){
            $keys = ''; $values = '';
            $sql = "UPDATE {$tabela} SET ";
            
            foreach ($dados as $key => $value) {
                $sql .= "{$key} = '{$value}', ";
            }
            
            $sql = substr($sql, 0, -2);

            foreach ($id as $key => $value) {
                $sql .= " WHERE {$key} = '{$value}'";
            }

            $stmt = parent::prepare($sql);
            $retorno = $stmt->execute();
            return $retorno;
        }

        public function delete($tabela, $id){
            $sql = "DELETE FROM {$tabela} ";
            $sql .= " WHERE 1=1 ";
            foreach ($id as $key => $value) {
                $sql .= " AND {$key} = '{$value}'";
            }

            $stmt = parent::prepare($sql);
            $retorno = $stmt->execute();
            return $retorno;
        }

        public function insert($array, $tabela){
            $sql = "INSERT INTO {$tabela} SET ";
            foreach($array AS $key => $value){
                $sql .= $key . " = '" . $value . "', ";
            }
            $retorno = $this->sql(substr($sql, 0, -2));
            return $retorno;
        }
    }
?>