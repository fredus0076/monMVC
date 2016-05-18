<?php
$optionProfils = '';

//verifier si $user existe alors on est inclus dans action.php
if(isset($user)) {
    $nom = $user['nom'];
    $prenom = $user['prenom'];
    
    $email = $user['email'];
    
    //Récupération de l'id utilisateur pour le mettre dans le formulaire
    $action = '<input type="hidden" name="opt" value="modifieruser">';
    $id_user = '<input type="hidden" name="id" value="'.$user['id_user'].'">';
    
    //Action a affectuer sur le formulaire
    $actionForm = 'useraction&opt=modifieruser&id='.$user['id_user'];
    $method='POST';
    $titre = 'Modifier';
    
} else {
    $titre = 'Créer';
    //Vérifie si une saisie temporaire existe (différence mot de passe)
    if(isset($_SESSION['usertmp'])) {
        $nom = $_SESSION['usertmp']['nom'];
        $prenom = $_SESSION['usertmp']['prenom'];
   
        $email = $_SESSION['usertmp']['email'];
        unset($_SESSION['usertmp']);
        
    } else {
        //initialise les variables à vide
        $nom = '';
        $prenom = '';
  
        $email = '';
    }

    //initialise les variables à vide
    $id_user = '';
    $action = '';
    $method = 'POST';

    //Action a effectuer sur le formulaire par défaut
    $actionForm = 'traitementform';
}


// Connexion à la BDD
//$bdd_connexion = new mysqli(BDD_SERVEUR, BDD_USER, BDD_PWD, BDD);

//$reqGetProfils = 'SELECT * FROM profils';

//$resGetProfils = $bdd_connexion->query($reqGetProfils) or die($bdd_connexion->error);

//var_dump($resGetProfils);



/*while($ligne=$resGetProfils->fetch_assoc()){
    //var_dump($ligne);
    
    //Initialisation à vide de l'option profil sélection
    $selected = '';
    
    // test si le profil de l'utilisateur est celui en cours
    if($ligne['id_profil'] == $profil) {
        //si le profil le profil est identique alors on le sélectionne dans la liste
        $selected = 'SELECTED';
    } 
    
    $optionProfils .= '<option value="'.$ligne['id_profil'].'" '.$selected.'>'.utf8_encode($ligne['libelle']).'</option>';
    
}*/
?>
<div class="small-6 columns">
    <h2><?=$titre;?> un compte</h2>
    <form method="<?=$method;?>" action="index.php?action=<?=$actionForm;?>">

        <?=$action;?>
        <?=$id_user;?>

        <p><input type="text" name="nom" placeholder="Saisissez votre nom" value="<?=$nom;?>"></p>
        <p><input type="text" name="prenom" placeholder="Saisissez votre prénom" value="<?=$prenom;?>"></p>
        <p><input type="email" name="email" placeholder="Saisissez votre e-mail" value="<?=$email;?>"></p>
        <?php if($action == '') { ?>
        <p><input type="password" name="pwd" placeholder="Saisissez votre password"></p>
        <p><input type="password" name="verifpwd" placeholder="Saisissez à nouveau votre password"></p>
        <?php }?>
        <p>
            <select name="profil">
                <option value="1">Admin</option>
                <?=$optionProfils;?>
            </select>
        </p>
        <p><button type="submit" class="success button">Envoyer mon formulaire</button></p>


    </form>
</div>