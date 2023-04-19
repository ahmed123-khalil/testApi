<?php
class connection{
    private $servername = "localhost";
    private $database = "apitest";
    private $username = "root";
    private $password = "";
    private static $pdo = null;

    public function connect(){
        if(self::$pdo == null){
            try{
            self::$pdo = new PDO("mysql:host=$this->servername;dbname=$this->database",$this->username,$this->password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$pdo;
        }catch(PDOException $e){
            echo "Error de connection ------------" . $e->getMessage();
            return null;
        }
        }else{
            echo "you're already connected seccessfully";
            return self::$pdo;
        }
        
    }
}
?>