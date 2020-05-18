<h3>Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> : </h3>
    <div class="encadre">
    <p>
        <?php // $montantValide = ?>
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
                //$id= $unFraisForfait['idfrais']?>
                
                <td  class="qteForfait"><?php echo $quantite ?></td>
            <?php
            }?>
	</tr>
        </table>
        <div>
        </div>
    </form>
    <form method="POST" action="index.php?uc=paiementComptable&action=validerpaiement">  
  	<table class="listeLegere">
  	   <caption>Descriptif des éléments hors forfait - <?php echo $nbJustificatifs ?> justificatifs reçus -</caption>
        <tr>
            <th class="date">Date</th>
            <th class="libelle">Libellé</th>
            <th class='montant'>Montant</th>                        
        </tr>
            <?php
            
        foreach ($lesFraisHorsForfait as $unFraisHorsForfait) 
            {
                $date = $unFraisHorsForfait['date'];
                $libelle = $unFraisHorsForfait['libelle'];
                $montant = $unFraisHorsForfait['montant'];
                $idFrais = $unFraisHorsForfait['id'];
            ?>
    
            <tr> 
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td><?php
             
            }?>
                
             </tr>
        </table>
        
        <input type="submit" name="rembourser" value="Rembourser">
    </form>
    
  </div>
</div>