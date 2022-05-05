<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//page qui me permet d'envoyer une requete a l'api en appuyant sur un bouton

if($_POST['id_api'] == 1){
    $url = "http://localhost/API_CRUD/front/createProduit/";
    $raw = file_get_contents($url);
}
if($_POST['id_api'] == 2){
    $url = "http://localhost/API_CRUD/front/updateProduit/".$_POST['idProduit']."/'".$_POST['titre']."'/".$_POST['prix']."";
    $raw = file_get_contents($url);
}
if($_POST['id_api'] == 3){
    $url = "http://localhost/API_CRUD/front/deleteProduit/".$_POST['idProduit'];
    $raw = file_get_contents($url);
}
?>