<div class ="erreur">
<ul>
<?php 
ajouterErreur('La fiche de frais pour ce mois-ci n\'existe pas');
foreach($_REQUEST['erreurs'] as $erreur)
	{
      echo "<li>$erreur</li>";
	}
?>
</ul></div>
