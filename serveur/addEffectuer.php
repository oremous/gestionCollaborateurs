<?php 
header("content-Type: application/json; charset=UTF-8");
require_once("database.php");
$tab['error']=true; 
function add(int $idcollab,int $idTask,PDO $conn){
  return  $conn->prepare("INSERT INTO effectuer (idcollaborateur,idtaches) VALUES (?,?)")->execute([$idcollab,$idTask]);
}
if(isset($_POST['collaborateurs'],$_POST['taches'],$conn)){
    if(isset($conn)&&$conn!=null){
        foreach($_POST['collaborateurs'] as $idcollaborateurs){
            foreach($_POST['taches'] as $idtaches){
                add((int)$idcollaborateurs,(int)$idtaches,$conn);
            }
        }
        $tab['error']=false;
        $conn=null;
    }
    else{
        $tab['message']="erreur de connexion a la base de donnee";
    }
}
else{
    $tab['message']="Certains donnees sont manquants";
}

echo json_encode($tab);