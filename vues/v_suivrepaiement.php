 <div id="contenu">
<h2>Suivi des fiches de frais</h2>
<form method="POST" action="index.php?uc=paiementComptable&action=validerpaiement">
    <fieldset>
        <legend>Fiches des visiteurs et mois à selectionner</legend>
        Visiteur : 
        
     <select name="validpaiement">
         <?php
         foreach($lesfichesvalider as $unefichevalider){
             $idV = $unefichevalider['idVisiteur'];
             $nomV = $unefichevalider['nom'];
             $prenomV = $unefichevalider['prenom'];
             $moisFiche = $unefichevalider['mois'];
             
             $numMois = substr($moisFiche, 4,2);
             $numAnnee = substr($moisFiche, 0,4);
             
            if ($idV == $_SESSION['idVisiteur']){ 
             ?> <option selected value="<?php echo $idV?>"><?php echo $numMois.'/'.$numAnnee.' - '.$nomV.' '.$prenomV;?></option>
        <?php  }
            else { ?>
                <option value="<?php echo $idV?>"><?php  echo $numMois.'/'.$numAnnee.' - '.$nomV.' '.$prenomV;?></option>
        <?php }
        }?>
        </select>
        <br><br>
      
        <input type="submit" value="Valider">
    </fieldset>
    
</form>