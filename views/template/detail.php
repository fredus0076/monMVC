<!-- Affiche le détail de l'utilisateur depuis la page action -->
<p><img src="images/<?=$user['photo']?>" alt="photo de l'utilisateur"></p>
<p>Nom : <?=$user['nom'];?></p>
<p>Prénom : <?=$user['prenom'];?></p>
<p>E-mail : <?=$user['email'];?></p>
<p>Profil : <?=$user['libelle'];?></p>
<a href="index.php?destination=listeusers">Retour à la liste des utilisateurs</a>
