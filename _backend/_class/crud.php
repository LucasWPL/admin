<?php
    session_start(); error_reporting(0);
    date_default_timezone_set('America/Sao_Paulo');
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
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
            $this-> sql("ALTER TABLE {$tabela} AUTO_INCREMENT = {$index}");
        }

        public function __construct()
        {
            $this->conn = parent :: __construct("mysql:host=localhost;dbname={$this->db}", $this->username, $this->password);
        }
        
        
        private function setParams($statement, $parameters = array())
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

        private function preparaBackup($string, $auto = false){
            $retorno = str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $string);
            
            if(!$auto){
                $aux = explode('AUTO_INCREMENT=', $retorno);
                if($aux[1]){
                    $newEnd = '';
                    $aux2 = explode(' ', $aux[1]);
                    foreach ($aux2 as $key => $value) {
                        if($key != 0){
                            $newEnd .= ' ' . $value;
                        }
                    }
                    $retorno = $aux[0] . $newEnd;
                }
            }

            return $retorno;
        }
        
        public function backup(){
            $getDados = [
                'bancos',
                'cfop'
            ];

            mkdir('../../estrutura_banco/'.date('m-Y'));
            $arquivo = fopen('../../estrutura_banco/'.date('m-Y').'/'.date('d-m-Y H').'.sql','wt'); 
            $tables = parent::query('SHOW TABLES');

            foreach ($tables as $table) {
                
                $sql = '-- TABLE: '.$table[0].PHP_EOL; 
                $create = parent::query('SHOW CREATE TABLE `'.$table[0].'`')->fetch(); 
                $sql.= $this->preparaBackup($create['Create Table']).';'.PHP_EOL;
                fwrite($arquivo, $sql);
                
                //DADOS FIXOS
                if(in_array($table[0], $getDados)){
                    $linhas = parent::query('SELECT * FROM `'.$table[0].'`'); 
                    $linhas->setFetchMode(PDO::FETCH_ASSOC); 

                    foreach ($linhas as $linha) {
                        $sql = 'INSERT INTO `'.$table[0].'` (`'.implode('`, `',array_keys($linha))."`) VALUES ('".implode("', '",$linha)."');". PHP_EOL;
                        fwrite($arquivo, $sql); 
                    }
                }

                $sql = PHP_EOL; 
                $resultado = fwrite($arquivo, $sql); 
                flush();          
            }            
            fclose($arquivo); 
        }
    }
?>