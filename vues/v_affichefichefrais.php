<h3>Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> : </h3>
    <div class="encadre">
    <p>
        Etat : <?php echo $libEtat?> depuis le <?php echo $dateModif?> <br> Montant validé : <?php echo $totos?></p>
    
    <form method="POST" action="index.php?uc=ficheFraisComptable&action=validerFicheFrais">
        <table class="listeLegere">
  	   <caption>Eléments forfaitisés </caption>
        <tr>
            <?php
            foreach ($lesFraisForfait as $unFraisForfait) 
               {
                $libelle = $unFraisForfait['libelle'];?>	
		<th><?php echo $libelle?></th>
		<?php
            }?>
	</tr>
        <tr>
            <?php
            foreach ($lesFraisForfait as $unFraisForfait) 
            {
		$quantite = $unFraisForfait['quantite'];
                $id= $unFraisForfait['idfrais']?>
                
                <td  class="qteForfait"><input type='text' size='14' name="lesFrais['<?php echo $id?>']" value="<?php echo $quantite?>"</td>
            <?php
            }?>
	</tr>
        </table>
        <div>
        <input type="submit" name="modifFraisForfait" value="Modifier" >
        <input type="reset" name="annuler" value="Annuler">
        </div>
    </form>
    <form method="POST" action="index.php?uc=ficheFraisComptable&action=validerFicheFrais">  
  	<table class="listeLegere">
  	   <caption>Descriptif des éléments hors forfait - <?php echo $nbJustificatifs ?> justificatifs reçus -</caption>
        <tr>
            <th class="date">Date</th>
            <th class="libelle">Libellé</th>
            <th class='montant'>Montant</th>                
            <th class='action' colspan="2">Action</th>                
        </tr>
            <?php
            
        foreach ($lesFraisHorsForfait as $unFraisHorsForfait)  //alimente le tableau des fraishorsforfait
            {
                $date = $unFraisHorsForfait['date'];
                $libelle = $unFraisHorsForfait['libelle'];
                $montant = $unFraisHorsForfait['montant'];
                $idFrais = $unFraisHorsForfait['id'];
            ?>
    
            <tr <?php
            if(substr($libelle, 0, 9) == 'REFUSEE :'){ //si le libelle comprend la chaine de caractère 'refuser'
                echo  'style = "background-color:#FF4E64"'; //alors met la ligne du tableau en rouge
            }?>> 
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td> 
                
               <?php if(substr($libelle, 0, 9) == 'REFUSEE :') { //si le libelle comprend la chaine de caractère 'refuser'?>
                <td colspan="2" style = "text-align:center"><a href="index.php?uc=ficheFraisComptable&action=validerFicheFrais&annuler=<?php echo $idFrais?>" >Annuler</a></td>
                <?php // alors propose un bouton annuler 
               }
               else { ?>
                <td><a href="index.php?uc=ficheFraisComptable&action=validerFicheFrais&suppFicheFrais=<?php echo $idFrais?>" 
                       onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer</a></td> 
                <td><a href="index.php?uc=ficheFraisComptable&action=validerFicheFrais&reporter=<?php echo $idFrais?>">Reporter</a></td>
               <?php }
                }?>
                
             </tr>
        </table>
        
        <input type="submit" name="validfiche" value="Valider la fiche">
    </form>
    
  </div>
</div>