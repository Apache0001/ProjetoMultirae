<?php
    namespace MF\Model;
    use App\Connection;
    class Conteiner{

        public static function getModel($model){
            $class = "\\App\\Models\\".ucfirst($model);
            $conn = new Connection;
            $conn = $conn->getDb();

            return new $class($conn);
        }
    }

?>