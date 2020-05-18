 <?php
include 'vues/v_sommaireComptable.php';
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];

if(isset($_POST['validpaiement'])){
    $_SESSION['idVisiteur']=$_POST['validpaiement'];
}
switch($action){
        case 'suivrepaiement':{
            $lesfichesvalider = $pdo->getFicheValider();//alimente la liste déroulante    
            require_once 'vues/v_suivrepaiement.php'; //vue choisir les visiteurs qui ont une fiche validéee
        break;
        }
        case 'validerpaiement':{
            $lesfichesvalider = $pdo->getFicheValider();    
            require_once 'vues/v_suivrepaiement.php';
            
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfaitValider($idVisiteur,$moisFiche);
            $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$moisFiche);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$moisFiche);
            $numAnnee =substr($moisFiche,0,4); //extrait l'annee yyyy de la fiche selectionné
            $numMois =substr($moisFiche,4,2); //extrait le mois mm
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $pdo->montanttotal($idVisiteur, $moisFiche); //retourne le montant total
            $totos=$montantValide['totos'];
            //print_r($montantValide);
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif =  $lesInfosFicheFrais['dateModif'];
            $dateModif =  dateAnglaisVersFrancais($dateModif);
            
            require_once 'vues/v_fichefrais.php';
            
            if(isset($_REQUEST['rembourser'])){
                $idVisiteur = $_SESSION['idVisiteur']; //recupère l'id selectionné dans la liste déroulante.
                $etat = 'RB'; //RB est l'état 'remboursé'
                $pdo->majEtatFicheFrais($idVisiteur,$moisFiche,$etat); //met à jour l'état de la fiche
            }
            break;
        }
}
?>
