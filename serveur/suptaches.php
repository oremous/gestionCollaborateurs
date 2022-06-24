<?php 
header("content-Type: application/json ; charset=UTF-8");
require_once("database.php");
$tab=[];
if(isset($conn,$_GET['id'])&&$conn!=null){
    $id=(int)$_GET['id'];
  $collab=$conn->prepare("DELETE FROM taches WHERE id=? ")->execute([$id]);
  $tab['data']=$collab;
  $tab['error']=false;
  $conn=null;
}
else{
    $tab["message"]="la connexion à la base de donnee a échouée";
   $tab['error']=true; 
}
echo json_encode($tab);
