<?php
//Récupération des valeurs du formulaire de login
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


//Appel de la classe user
$objUser = new User($db);
$objUser->setEmail($email);
$objUser->setPassword($password);
$check = $objUser->checkUser();

$_SESSION['connected'] = $check;

//Vérification de la cohérence des mots de passe
if($check === true){
    $user = $objUser->getUser();
    
    $_SESSION['msg']= '<div class="success callout">Bienvenue '.$user['prenom'].'</div>';
    $_SESSION['token'] = time();
    
    $destination = 'listeusers';
    //header('location:listeusers.php');
    //exit();
} else {
    $objUser = null;
    $_SESSION['msg'] = '<div class="alert callout">Mot de passe incorrect !</div>';
    //$destination = 'welcome'; //Pas obligatoire
    //header('location:index.php');
}

