<?php 
header("content-Type: application/json; charset=UTF-8");
require_once("database.php");
$tab=[];
function getTask($id,PDO $conn){
    $tache=$conn->prepare("SELECT * FROM taches WHERE idprojet =? and situation=?");
    $tache->execute([$id,0]);
    return $tache->fetchAll(PDO::FETCH_ASSOC);
}
if(isset($conn)&&$conn!=null){
  $projet=$conn->query("SELECT DISTINCT p.* FROM projets p INNER JOIN taches t  ON (p.id=t.idprojet) WHERE t.situation=0 AND t.id NOT IN (SELECT idtaches FROM effectuer )")->fetchAll(PDO::FETCH_ASSOC);
  $i=0;
  foreach($projet as $pro){
    $projet[$i]["taches"]=getTask($pro['id'],$conn);
    $i++;
  }
  $tab['data']=$projet;
  $tab['error']=false;
  $conn=null;
}
else{
    $tab["message"]="la connexion à la base de donnee a échouée";
   $tab['error']=true; 
}
echo json_encode($tab);
