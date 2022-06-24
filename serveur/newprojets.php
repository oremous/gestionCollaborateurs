<?php 
header("content-Type: application/json ; charset=UTF-8");
$tache=$_POST['tache'];
$nom=$_POST['nom'];
$description=$_POST['description'];
$descriptiontache=$_POST['descriptiontache'];
$date=$_POST['date'];
require_once("database.php");
$tab=[];
if(isset($conn,$nom)&&$conn!=null){
  $collab=$conn->prepare("SELECT * FROM projets WHERE nom=? ");
  $final=$collab->execute([$nom]);
  if(count($collab->fetchAll())==0){
    $new=$conn->prepare("INSERT INTO projets(nom,description) values(?,?)")
                ->execute([$nom,$description]);
                $tab['data']=$new;
                $tab['error']=false;
                $tab['id']=$conn->lastInsertId();
    if($new){
        $i;
        for($i=0;$i<count($tache);$i++){
            $d=new DateTime($date[$i]);
            $tach=$conn->prepare("INSERT INTO taches(libelle,description,idprojet,datefin,situation) VALUES(?,?,?,?,?)")
                        ->execute([$tache[$i],$descriptiontache[$i],$tab['id'],$d->format("Y-m-d"),0]);
        }
    }
  }
  else{
    $tab['message']="le projet a déjà été ajouté";
    $tab['error']=true;
  }
 
  $conn=null;
}
else{
    $tab["message"]="la connexion à la base de donnee a échouée";
   $tab['error']=true; 
}
echo json_encode($tab);
