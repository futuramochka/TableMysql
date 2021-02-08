<?php
class CTable{
        private $host; //IP
        private $user; //Login
        private $password; //Pass
        private $option; //Config
        private $database; //DB
        public $PDO; //PDO
        private $charset = 'UTF8'; //utf-8

        public function __construct($host__copy, $user__copy, $password__copy, $database__copy){
            $this->host = $host__copy;
            $this->user = $user__copy;
            $this->password = $password__copy;
            $this->database = $database__copy;
            $this->option = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
        }

        public function connectDB(){
            $this->PDO = new PDO("mysql:host=$this->host;dbname=$this->database;
            charset=$this->charset",$this->user,$this->password,$this->option);

        }

        public function createTable(){
            $sql = "CREATE TABLE IF NOT EXISTS pagTab (
                    id          INT AUTO_INCREMENT PRIMARY KEY,
                localname    VARCHAR (255)        DEFAULT NULL,
                quantity INT                 DEFAULT NULL,
                locallength INT                 DEFAULT NULL,
                date_create      DATE                DEFAULT NULL
                )";
            return $this->PDO->exec($sql);
        }

        public function getCountProducts(){//Function return array Products
            global $connect;
            $query = $connect->PDO->prepare("SELECT count(id) FROM `pagTab`");
            $query->execute();
            $row = $query->fetchAll();
            return $row;
        }

        public function getProducts($valueLimit,$valueOffset){//Function return array Products limit 4
            global $connect;
            $query = $connect->PDO->prepare("SELECT * FROM `pagTab` LIMIT ? OFFSET ?");
            $query->execute(array($valueLimit,$valueOffset));
            $row = $query->fetchAll();
            return $row;
        }

        public function getFilterProducts($nameColumn,$operator,$elementSearch){
            global $connect;
                
            if(is_numeric($elementSearch)){
                $query = $connect->PDO->prepare("SELECT * FROM `pagTab` WHERE $nameColumn $operator ?");
                $query->execute(array($elementSearch));
            }else if(!is_numeric($elementSearch)){
                $query = $connect->PDO->prepare("SELECT * FROM `pagTab` WHERE $nameColumn $operator ?");
                $query->execute(array($elementSearch));
            }
            
            if(is_numeric($elementSearch) and $operator == 'LIKE'){
                $query = $connect->PDO->prepare("SELECT * FROM `pagTab` WHERE $nameColumn $operator ?");
                $query->execute(array('%'.$elementSearch.'%'));
            }else if(!is_numeric($elementSearch) and $operator == 'LIKE'){
                $query = $connect->PDO->prepare("SELECT * FROM `pagTab` WHERE $nameColumn $operator ?");
                $query->execute(array('%'.$elementSearch.'%'));
            }
            
            $row = $query->fetchAll();
            return $row;
        }

        public function getInfoPDO(){//Info PDO
            return $this->PDO;
        }

        public function CloseConnectDB(){//Close connect for database mysql
            $this->PDO = null;
        } 
    }