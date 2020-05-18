<!-- Division pour le sommaire -->
    <div id="menuGauche">
     <div id="infosUtil">
    
        <h2>
    
</h2>
         </div>  
        <ul id="menuList">
                <li> 
                   Comptable: 
                   <strong><?php echo $_SESSION['prenom']."  ".$_SESSION['nom']  ?></strong>
		</li> 
                <li class="smenu">
              <a href="index.php?uc=ficheFraisComptable&action=ficheFrais" title="Valider fiche de frais ">Valider les fiches de frais</a>
            </li>
            <li class="smenu">
              <a href="index.php?uc=paiementComptable&action=suivrepaiement" title="Suivi des fiches de frais">Suivi des fiches de frais</a>
            </li>
            <li class="smenu">
              <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
            </li>
         </ul>
        
    </div>
