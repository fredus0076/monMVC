<?php

/*
 * Ecriture de la requête de selection des utilisateurs avec une jointure sur
 * le profil
*/
/*$reqGetUsers = 'SELECT * FROM users JOIN profils ON users.profil = profils.id_profil';

//affichage pour test de la requete dans PHPMyAdmin
//echo $reqGetUsers;

// Connexion à la BDD
$bdd_connexion = new mysqli(BDD_SERVEUR, BDD_USER, BDD_PWD, BDD);

//Exécution de la requete et récupération des résultats
$resGetUsers = $bdd_connexion->query($reqGetUsers) or die($mysqli->error);*/

if(!isset($objUser)) {
    $objUser = new User($db);
}

$resGetUsers = $objUser->getAllUsers();

?>
<!-- Création d'un tableau HTML pour afficher les résultats -->
<table>
    <thead>
    <th>Nom</th>
    <th>Prénom</th>
    <th>E-mail</th>
    <th>Profil</th>
    <th>Actions</th>
    </thead>
    <tbody>
<?php
//Plus nécessaire car getAllUsers retourne déjà un tableau associatif
//while($LigneUser = $resGetUsers->fetch_assoc()) {
//Parcours des résultats
foreach ($resGetUsers as $LigneUser) {
    //ouverture de la ligne du tableau en HTML
    $ligne = '<tr>';
    
    //création des cellules du tableau
    $ligne .= '<td>'.$LigneUser['nom'].'</td>';
    $ligne .= '<td>'.$LigneUser['prenom'].'</td>';
    $ligne .= '<td>'.$LigneUser['email'].'</td>';
    $ligne .= '<td>'.$LigneUser['libelle'].'</td>';
    //Création de liens pour appeler des actions sur l'utilisateur en fonction de son id
    $ligne .= '<td><a href="index.php?action=useraction&opt=detail&id='.$LigneUser['id_user'].'">Détail</a> ';
    $ligne .= '<a href="index.php?action=useraction&opt=modifier&id='.$LigneUser['id_user'].'">Modifier</a> ';
    $ligne .= '<a href="index.php?action=useraction&opt=supprimer&id='.$LigneUser['id_user'].'">Supprimer</a></td>';
    
    //affichage de la ligne du tableau 
    echo $ligne.'</tr>';
}
?>
    </tbody>
</table>    
