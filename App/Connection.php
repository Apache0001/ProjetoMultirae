<?php
    namespace App;
class Connection{
        public function getDb(){
            try{
                
                $conn = new \PDO("mysql:host=localhost;dbname=id15784893_recodeprojeto;charset=utf8","root",">geQxTtJwMP-f|=9");
                return $conn;
            }
            catch(\PDOException $erro){

            }
        }
    }

?>