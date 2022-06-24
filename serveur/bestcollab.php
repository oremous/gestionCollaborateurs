<?php 
header("content-Type: application/json; charset=UTF-8");
require_once("database.php");
$tab=[];
if(isset($conn)&&$conn!=null){
  $collab=$conn->query("SELECT c.*, COUNT(*) AS nbr FROM effectuer e INNER JOIN collaborateurs c INNER JOIN taches t  ON (e.idcollaborateur=c.id AND e.idtaches=t.id) WHERE situation=1 GROUP BY c.id DESC LIMIT 5;")->fetchAll(PDO::FETCH_ASSOC);
  $tab['data']=$collab;
  $tab['error']=false;
  $conn=null;
}
else{
    $tab["message"]="la connexion à la base de donnee a échouée";
   $tab['error']=true; 
}
echo json_encode($tab);
