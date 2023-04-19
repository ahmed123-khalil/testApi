
        <?php
        require_once("modal/User.php");
        $test = new User();
       // endPoint pour chercher un personne 
        if(isset($_POST['column']) && $_POST['column'] == 'nom'){
            $column = $_POST['column'];
            $value = $_POST['nom'];
            if(isset($_POST['nom'])){
                $data = json_encode($test->search($column,$value));
                echo $data;
            }
        }
        else if(isset($_POST['column']) && $_POST['column'] == 'prenom'){
            $column = $_POST['column'];
            $value = $_POST['prenom'];
            if(isset($_POST['prenom'])){
                $data = json_encode($test->search($column,$value));
                echo $data;
            }
        }
        else if(isset($_POST['column']) && $_POST['column'] == 'age'){
            $column = $_POST['column'];
            $value = $_POST['age'];
            if(isset($_POST['age'])){
                $data = json_encode($test->search($column,$value));
                echo $data;
            }
        }
        else{
            if($_SERVER['REQUEST_METHOD'] === "GET"){
            echo $test->getAll();
        }else if($_SERVER['REQUEST_METHOD'] === "PATCH"){
            $id = $_GET['id'];
            $data = $test->search("id",1);

            $user = json_decode(file_get_contents('php://input'),true);
            $nom = $user['nom'] ?? $data['nom'];
            $prenom = $user['prenom'] ?? $data['prenom'];
            $age = $user['age'] ?? $data['age'];
            $test->update($id,$nom,$prenom,$age);
            $data = array_merge($data, $user);
            header('Content-type: application/json');
            echo json_encode($data);


        }else if($_SERVER['REQUEST_METHOD'] === "POST"){
            $data = json_decode(file_get_contents('php://input'),true);
            $nom = $data['nom'];
            $prenom = $data['prenom'];
            $age = $data['age'];
            echo json_encode($test->insert($nom,$prenom,$age));
        }else if($_SERVER['REQUEST_METHOD'] === "DELETE"){
            $id = $_GET['id'];
            echo json_encode($test->delete($id));
        }
        }
        // Endpoint pour exposer les données d'un personne en json
        
        ?>