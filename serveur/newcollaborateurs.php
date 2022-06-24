<?php 
header("content-Type: application/json ; charset=UTF-8");
extract($_POST);
$date=new DateTime($date);
require_once("database.php");
$tab=[];
if(isset($conn,$nom,$prenom,$taches)&&$conn!=null){
  $collab=$conn->prepare("SELECT * FROM collaborateurs WHERE nom=? AND prenom=?");
  $final=$collab->execute([$nom,$prenom]);
  if(count($collab->fetchAll())==0){
    $new=$conn->prepare("INSERT INTO collaborateurs(nom,prenom,numero, adresse,taches, date) values(?,?,?,?,?,?)")
                ->execute([$nom,$prenom,$numero,$adresse,$taches,$date->format("Y-m-d")]);
                $tab['data']=$new;
                $tab['error']=false;
                $tab['id']=$conn->lastInsertId();
  }
  else{
    $tab['message']="le collaborateur a déjà été ajouté";
    $tab['error']=true;
  }
 
  $conn=null;
}
else{
    $tab["message"]="la connexion à la base de donnee a échouée";
   $tab['error']=true; 
}
echo json_encode($tab);