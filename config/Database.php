<?php

    class Database{
        private $host='localhost';
        private $db_name='cardealer';
        private $username='root';
        private $port=3306;
        private $socket="";
        private $password='';
        private $conn;

        public function getConn()
        {
            return $this->conn;
        }

        public function connect(){
            $this->conn=null;
            try{
                $this->conn=new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->username,$this->password);
                //$this->conn=new PDO("mysql:host=localhost;dbname=CarDealer","root","1234");
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e){
                echo "Connection error: " . $e->getMessage();
            }

            return $this->conn;
        }
    }
//    $connection = new Database();
//    $connection->connect();
//    $stmt=$connection->getConn()->query("SELECT * FROM user_");
//    while ($row = $stmt->fetch()) {
//            echo $row['username']."<br />";
//        }

//    $conn=new PDO("mysql:host=localhost;dbname=CarDealer","root","1234");
//    $stmt = $conn->query("SELECT * FROM user_");
//    while ($row = $stmt->fetch()) {
//        echo $row['username']."<br />";
//    }
