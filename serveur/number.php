<?php 
header("content-Type: application/json; charset=UTF-8");
require_once("database.php");
$tab['collab']=0;
$tab['task']=0;
if(isset($conn,$_GET['id'])&&$conn!=null){
  $collab=$conn->prepare("SELECT count(*) FROM taches inner join effectuer on (taches.id=effectuer.idtaches)  WHERE taches.id=?");
          $collab->execute([(int)$_GET['id']]);
          $final=$collab->fetchAll();
    $task=$conn->prepare("SELECT count(*) FROM taches   WHERE idprojet=?");
            $task->execute([(int)$_GET['id']]);
            $final2=$task->fetchAll();
  $tab['collab']=(int)$final[0][0];
  $tab['task']=(int)$final2[0][0];
  $tab['error']=false;
  $conn=null;
}
else{
    $tab["message"]="la connexion à la base de donnee a échouée";
   $tab['error']=true; 
}
echo json_encode($tab);