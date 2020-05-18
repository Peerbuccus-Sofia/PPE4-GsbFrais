<?php
$idVisiteur = $_SESSION['idVisiteur'];
 $statut=$pdo->statut($idVisiteur);
    if ($statut['statut']=="v"){
        include("vues/v_sommaire.php");
    }
    else {
        include ("vues/v_sommaireComptable.php");
    }
 ?>      