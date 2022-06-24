<?php 
header("content-Type: application/json; charset=UTF-8");
require_once("database.php");
$tab=[];
function number(int $id,PDO $conn)
{
    $collab=$conn->prepare("SELECT count(*) FROM taches inner join effectuer on (taches.id=effectuer.idtaches)  WHERE taches.id=?");
          $collab->execute([(int)$id]);
          $final=$collab->fetchAll();
    $task=$conn->prepare("SELECT count(*) FROM taches   WHERE idprojet=?");
            $task->execute([(int)$id]);
            $final2=$task->fetchAll();
  $tab['collab']=(int)$final[0][0];
  $tab['task']=(int)$final2[0][0];
  return $tab;
}

if(isset($conn)&&$conn!=null){
  $collab=$conn->query("SELECT * FROM projets ")->fetchAll(PDO::FETCH_ASSOC);
  $i=0;
  foreach($collab as $col){
    $data=number($col['id'],$conn);
    $collab[$i]['nbr_collab']=$data['collab'];
    $collab[$i]['nbr_task']=$data['task'];
    $i++;
  }
  $tab['data']=$collab;
  $tab['error']=false;
  $conn=null;
}
else{
    $tab["message"]="la connexion à la base de donnee a échouée";
   $tab['error']=true; 
}
echo json_encode($tab);
