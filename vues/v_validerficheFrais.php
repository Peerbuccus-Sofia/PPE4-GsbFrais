 <div id="contenu">
<h2>Validation des fiches de frais</h2>
<form method="POST" action="index.php?uc=ficheFraisComptable&action=validerFicheFrais">
    <fieldset>
        <legend>Visiteur et mois à selectionner</legend>
        Visiteur : <select id='lesVisiteurs 'name="lesVisiteurs">
            <?php
                foreach ($lesVisiteurs as $unVisiteur) {
                    $id = $unVisiteur['id'];
                    $nom = $unVisiteur['nom'];
                    $prenom = $unVisiteur['prenom'];
                    
                    if ($id == $_SESSION['id']){
                ?> <option selected value="<?php echo $id?>"><?php echo $nom, $prenom;?></option>
                    <?php  }
                    else { ?>
                <option value="<?php echo $id?>"><?php echo $nom, $prenom;?></option>
                    <?php }
                }
            ?>
        </select>
        <br><br>
        Date : <select name="datesixmois">
            <?php
		foreach ($lesMois as $unMois)
		{
		    $mois = $unMois['mois'];
                    $numAnnee =  $unMois['numAnnee'];
                    $numMois =  $unMois['numMois'];
                        if($mois == $moisASelectionner){
                        ?>
                        <option selected value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
                        <?php 
                        }
                       else{ ?>
                        <option value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
                        <?php 
                        }
			
			}
           
		   ?>    
        </select>
        <br><br>
        <input type="submit" value="valider" name="validerdate6mois">
    </fieldset>
    
</form>