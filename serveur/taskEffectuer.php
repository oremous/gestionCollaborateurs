<?php 
header("content-Type: application/json; charset=UTF-8");
require_once("database.php");
$tab=[];
function getCollab(int $id,PDO $conn){
    $tache=$conn->prepare("SELECT * FROM collaborateurs c INNER JOIN effectuer e ON(e.idcollaborateur=c.id) WHERE e.idtaches=?");
    $tache->execute([$id]);
    return $tache->fetchAll(PDO::FETCH_ASSOC);
}
if(isset($conn)&&$conn!=null){
  $taches=$conn->query("SELECT DISTINCT t.*,p.nom FROM taches t INNER JOIN effectuer e INNER JOIN projets p ON(t.id=e.idtaches AND t.idprojet=p.id)")->fetchAll(PDO::FETCH_ASSOC);
  $i=0;
  foreach($taches as $tache){
    $taches[$i]["collaborateurs"]=getCollab((int)$tache['id'],$conn);
    $i++;
  }
  $tab['data']=$taches;
  $tab['error']=false;
  $conn=null;
}
else{
    $tab["message"]="la connexion à la base de donnee a échouée";
   $tab['error']=true; 
}
echo json_encode($tab);
