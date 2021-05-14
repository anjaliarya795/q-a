<?php

session_start();
    class Work {
        private $hostname = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "q&a";
    
        private $connect;

        public function __construct(){
            $this->connect = new mysqli($this->hostname,$this->username,$this->password,$this->database);
            if(mysqli_connect_error()){
                trigger_error("database connection failed".mysqli_connect_error());
            }
            else{
                return $this->connect;
            }
        }

        public function insertData($table,$fields,$page="index"){
            $col = implode(",",array_keys($fields));
            $rows = implode("','",array_values($fields));

            $sql = $this->connect->query("insert into $table ($col) value ('$rows')");

            if($sql){
                //success
                $_SESSION['alert']="data inserted successfully";
                $this->redirect($page);
            }
            else{
                //fail
            }
        }

        public function alert($msg,$type="primary"){
            if(!empty($_SESSION['alert']) && $msg !=""){
                echo "<div class='alert alert-$type'>$msg </div>";
                unset($_SESSION['alert']);
            }
            
        }

        public function getData($query){

            $run = $this->connect->query($query);

            $array = [];
            if($run->num_rows > 0 ){
               
                while( $row =$run->fetch_assoc()){
                    $array[] = $row;
                }
                return $array;
            }

            else{
                echo"<small class='text-muted p-3'>No record found</small>";
                return $array;
            }

            
        }

        

        public function countData($query){

            $run = $this->connect->query($query);

            $run->num_rows;

        return $run->num_rows;

            
        }


        public function redirect($page="index"){
            echo "<script>window.open('$page.php','_self')</script>";
        }

        public function getUserId(){
            $log = $_SESSION['user'];
            $run = $this->connect->query("select * from accounts where email='$log'");
            $data = $run->fetch_array();

            return $data['id'];
        }

    }

    //object creation

    $datawork = new Work();

?>