    <?php
include 'vues/v_sommaireComptable.php';
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];
$mois = getMois(date("d/m/Y"));
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois,4,2);

if(isset($_REQUEST['datesixmois'])){
    $_SESSION['datesixmois']=$_REQUEST['datesixmois'];
}

if(isset($_POST['lesVisiteurs'])){
    $_SESSION['id']=$_POST['lesVisiteurs'];
}

switch($action){
    
         case 'ficheFrais':{
            $lesVisiteurs = $pdo->selectVisiteur(); //alimente la liste déroulante de nom et prenom
            $lesMois= getSixDerniersMois(); //alimente la liste deroulante des 6 dermiers mois
            require_once 'vues/v_validerficheFrais.php';//inclure la vue
            break;
        }
        case 'validerFicheFrais':{ 
            
            if(isset($_REQUEST['reporter'])){ //dans le cas où on clique sur le bouton reporter
            $idVisiteur = $_SESSION['id'];
            $idFrais = $_REQUEST['reporter'];
            $MoisPlus = getMoisNext($numAnnee, substr($_SESSION['datesixmois'], 4, 2));// appel de la fonction qui ajoute 1 au mois
           // print($MoisPlus);
            $pdo->reporter($MoisPlus, $idVisiteur, $idFrais);// appel de la fonction qui modifie dans la bdd le nouveau mois
            $pdo->creeNouvellesLignesFrais($idVisiteur, $MoisPlus);// appel de la fonction qui créer une nouvelle fiche
            $lesFraisForfait= $pdo->getLesFraisForfait( $_SESSION['id'],$MoisPlus); //affiche la nouvelle fiche
            }
         
        if(isset($_REQUEST['suppFicheFrais'])){ //dans le cas où on clique sur le bouton SUPPRIMER
            $idFrais = $_REQUEST['suppFicheFrais'];
            $pdo->refuserfiche($idFrais); // appel de la fonction qui refuse
          }
        
        if(isset($_REQUEST['annuler'])){//dans le cas où on clique sur le bouton annuler
            $idFrais = $_REQUEST['annuler'];
            $pdo->annulerRefus($idFrais); // appel de la fonction qui annule l'action 'refuser'
        }
            
            $idVisiteur = $_SESSION['id'] ;
            $lesVisiteurs = $pdo->selectVisiteur();
            $leMois = $_SESSION['datesixmois'];
            $moisASelectionner = $leMois;
            $lesMois= getSixDerniersMois();
            require_once 'vues/v_validerficheFrais.php';
            
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois); //affiche les fraishorsforfait
            $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois); //affiche les fraisforfait
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);//affiche les infos de la fiche
            $numAnnee =substr($leMois,0,4);
            $numMois =substr($leMois,4,2);
            if(isset($lesInfosFicheFrais['libEtat'])){ 
                $libEtat = $lesInfosFicheFrais['libEtat'];//retourne l'état de la fiche
            }
            else { $libEtat=""; }
            $montantValide = $pdo->montanttotal($idVisiteur, $leMois); //le montant total
            $totos=$montantValide['totos'];
            //print_r($montantValide);
            if(isset($lesInfosFicheFrais['nbJustificatifs'])) {
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            }
            else { $nbJustificatifs="";}
            if(isset($lesInfosFicheFrais['dateModif'])){
            $dateModif =  $lesInfosFicheFrais['dateModif'];//date de la dernière modification
            }
            else { $dateModif="";}
            $dateModif =  dateAnglaisVersFrancais($dateModif);
            
              if ($lesFraisHorsForfait && $lesFraisForfait && $lesInfosFicheFrais){ // s'il y a des fraishorsforfait existant
                  require_once 'vues/v_affichefichefrais.php'; //les afficher
              }
              else {
                  include 'vues/v_erreurs.php'; //sinon afficher une vue erreur
              }
        
        if(isset($_REQUEST['modifFraisForfait'])){ //dans le cas où on modifie les valeurs
            $idVisiteur =  $_SESSION['id'];
            $leMois = $_SESSION['datesixmois'];
            $lesFrais = $_REQUEST['lesFrais'];
            $pdo->majFraisForfait($idVisiteur, $leMois, $lesFrais);
            require_once 'vues/v_maj.php';   
            require_once 'vues/v_affichefichefrais.php';
        }         
        
        if(isset($_REQUEST['validfiche'])){ //lorsqu'on valide la fiche
            $etat = 'VA';
            $lesFraisForfait = $pdo->majEtatFicheFrais($idVisiteur,$leMois,$etat); //maj de l'état en valider dans la bdd
            $pdo->montantvalider($totos, $idVisiteur, $leMois);//maj du montant valider final dans la bdd
        }
       
           break;
        }
       
        
         
         
}
?>
