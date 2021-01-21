<?php
    namespace App;
class Connection{
        public function getDb(){
            try{
                
                $conn = new \PDO("mysql:host=localhost;dbname=epiz_27737767_recodeprojeto;charset=utf8","epiz_27737767","OpR1jVqU5kM");
                return $conn;
            }
            catch(\PDOException $erro){

            }
    }
}
?>