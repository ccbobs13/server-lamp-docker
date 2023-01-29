<?php
//Appel du fichier de connexion à la base de données
require_once('database/conn_db.php');

//Récupération de l'id et du type par la méthode GET
$id=$_GET['id'];
$type=$_GET['type'];

//Définition de la requête de suppression
$sql_supprim="delete from $type where id=:id";

//Préparation de la requête
$rp=$pdo->prepare($sql_supprim);

$rp->bindParam(':id',$id,PDO::PARAM_INT);

//Exécution de la requête
if($rp->execute()){
    //Redirection
    header("location:{$type}view.php");
}
?>