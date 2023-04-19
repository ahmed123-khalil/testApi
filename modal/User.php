<?php
require_once("connection.php");
class User{
    private $name;
    private $prenom;
    private $age;
    

    

    public function search($column,$value){
        $conn = new connection();
        $result = $conn->connect()->query("SELECT nom,prenom,age FROM personne where $column = '".$value."'");
        if($result == true){
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        
        }else{
            $data = array('no data selected');
        }
        $conn = null;
        return $data;
    }

    public function getAll(){
        $conn = new connection();
        $result = $conn->connect()->query("select * from personne");
        if($result == true){
            $json = json_encode($result->fetchAll(PDO::FETCH_ASSOC));
        }else{
            $json = json_encode(array("there is no data the table"));
        }
        $conn = null;
        return $json;
    }

    public function insert($nom,$prenom,$age){
        $conn = new connection();
        $result = $conn->connect()->query("INSERT INTO personne VALUES (null,'".$nom."','".$prenom."','".$age."')");
        if($result == true){
            $json = array("insert data successfuly");
        }else{
            $json = array("insert data unseccessfuly");
        }
        $conn = null;
        return $json;
    }

    public function update($id,$nom,$prenom,$age){
        $conn = new connection();

        $result = $conn->connect()->prepare("UPDATE personne SET nom = :nom, prenom = :prenom, age = :age WHERE id = :id");
        $result->bindParam(':nom',$nom,PDO::PARAM_STR);
        $result->bindParam(':prenom',$prenom,PDO::PARAM_STR);
        $result->bindParam(':age',$age,PDO::PARAM_INT);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->execute();
    }

    public function delete($id){
        $conn = new connection();
        $result = $conn->connect()->prepare("delete from personne where id = :id");
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->execute();
        if($result == true){
            $json = array("delete data successfuly");
        }else{
            $json = array("delete data unseccefuly");
        }
        return $json;
    }
}
?>