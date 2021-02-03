<?php

    class User {
        private $conn;
        private $table= "user_";
        public $username;
        public $nameAndSurname;
        public $address;
        public $email;
        public $password_;
        public $phone;


        public function __construct ($db) {
            $this->conn = $db;
        }

        public function insertUser() {

            //create the query
            $query = "INSERT INTO " . $this->table . "
                   SET
                        username = :username,
                        nameAndSurname = :nameAndSurname,
                        address = :address,
                        email = :email,
                        password_ = :password_,
                        phone = :phone";

            //execute the query
            $stmt = $this->conn->prepare($query);

            // sanitize
                $this->username=htmlspecialchars(strip_tags($this->username));
                $this->nameAndSurname=htmlspecialchars(strip_tags($this->nameAndSurname));
                $this->address=htmlspecialchars(strip_tags($this->address));
                $this->email=htmlspecialchars(strip_tags($this->email));
                $this->password_=htmlspecialchars(strip_tags($this->password_));
                $this->phone=htmlspecialchars(strip_tags($this->phone));

                // bind the values
                $stmt->bindParam(':username', $this->username);
                $stmt->bindParam(':nameAndSurname', $this->nameAndSurname);
                $stmt->bindParam(':address', $this->address);
                $stmt->bindParam(':email', $this->email);
                $stmt->bindParam(':phone', $this->phone);
                $stmt->bindParam(':password_', $this->password_);

                //hash the password
                //$password_hash = password_hash($this->password_, PASSWORD_BCRYPT);
                //$stmt->bindParam(':password_', $password_hash);



                //execute the query
                if($stmt->execute()){
                        return true;
                }
                return false;



        }

        // check if given user exist in the database
        public function userExists(){

            // query to check if user exists
            $query = "SELECT nameAndSurname, address, email, phone
                    FROM " . $this->table . "
                    WHERE username = :username AND password_ = :password_ ";

            // prepare the query
            $stmt = $this->conn->prepare( $query );

            // sanitize
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->username=htmlspecialchars(strip_tags($this->username));

            // bind given email value
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password_', $this->password_);

            // execute the query
            $stmt->execute();

            // get number of rows
            $num = $stmt->rowCount();

            // if user exists, assign values to object properties for easy access and use for php sessions
            if($num>0){

               //return true if the user exists in the database
               return true;
            }

            // return false if user does not exist in the database
            return false;
        }

        public function deleteUser(){
                    $query = 'DELETE FROM '.$this->table.'
                        WHERE
                            username = :username ';
                    $stmt = $this->conn->prepare($query);
                    $this->username= htmlspecialchars(strip_tags($this->username));
                    $stmt->bindParam(':username', $this->username);

                    if ($stmt->execute()) {
                        return true;
                    }
                    // Print error if something goes wrong
                    printf("Error: %s.\n", $stmt->error);
                    return false;
                }


    }


?>