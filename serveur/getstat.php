<?php 
header("content-Type: application/json; charset=UTF-8");
require_once("database.php");
$tab['collab']=0;
$tab['task']=0;
if(isset($conn)&&$conn!=null){
  $collab=$conn->prepare("SELECT count(*) FROM collaborateurs ");
          $collab->execute();
          $final=$collab->fetchAll();
    $task=$conn->prepare("SELECT count(*) FROM taches   ");
            $task->execute();
            $final2=$task->fetchAll();
    $projet=$conn->prepare("SELECT count(*) FROM projets   ");
            $projet->execute();
            $final3=$projet->fetchAll();
  $tab['collab']=(int)$final[0][0];
  $tab['task']=(int)$final2[0][0];
  $tab['projet']=(int)$final3[0][0];
  $tab['error']=false;
  $conn=null;
}
else{
    $tab["message"]="la connexion à la base de donnee a échouée";
   $tab['error']=true; 
}
echo json_encode($tab);
