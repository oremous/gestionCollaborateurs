<?php 
header("content-Type: application/json; charset=UTF-8");
require_once("database.php");
$tab=[];
if(isset($conn)&&$conn!=null){
  $collab=$conn->query("SELECT c.*,COUNT(e.id) AS nbr FROM collaborateurs c LEFT OUTER JOIN effectuer e ON(e.idcollaborateur=c.id) GROUP BY c.id")->fetchAll(PDO::FETCH_ASSOC);
  $tab['data']=$collab;
  $tab['error']=false;
  $conn=null;
}
else{
    $tab["message"]="la connexion à la base de donnee a échouée";
   $tab['error']=true; 
}
echo json_encode($tab);
