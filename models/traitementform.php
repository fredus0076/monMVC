<?php
//Affichage des données envoyées par le formulaire
//var_dump($_REQUEST);
//var_dump($_GET); //METHOD du formulaire
//var_dump($_POST);

//Récupération des variables du formulaire

// Filtre sur les caractère pour échapper les chaines
/*$nom = filter_input(INPUT_GET, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$prenom = filter_input(INPUT_GET, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$pwd = filter_input(INPUT_GET, 'pwd', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// Filtre sur les caractère pour échapper les caractères différents de INT
$profil = filter_input(INPUT_GET, 'profil', FILTER_SANITIZE_NUMBER_INT);
*/

$userForm = array('nom' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                    'prenom' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                    'email' => FILTER_SANITIZE_EMAIL,
                    'pwd' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                    'verifpwd' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                    'profil' => FILTER_SANITIZE_NUMBER_INT);

$user = filter_input_array(INPUT_POST, $userForm);

// Vérifie si les mots de passe sont différents
// ou si l'un ou l'autre des mots de passe est vide
if($user['pwd'] !== $user['verifpwd'] || (is_null($user['pwd']) || is_null($user['verifpwd']))) {
    $_SESSION['msg'] = '<div class="alert callout">Mot de passe différents ou vide</div>';
    //Création d'un tableau en session pour éviter que l'utilisateur saisisse à nouveau ses valeurs
    $_SESSION['usertmp']['nom'] = $user['nom'];
    $_SESSION['usertmp']['prenom'] = $user['prenom'];
    $_SESSION['usertmp']['email'] = $user['email'];
    $_SESSION['usertmp']['profil'] = $user['profil'];
    header('Location:index.php');
    exit();
}

//Sécurisation du mot de passe
$user['mdp'] = password_hash($user['pwd'], PASSWORD_BCRYPT);

unset($user['pwd']);
unset($user['verifpwd']);

$objUser = new User($db);
$idUser = $objUser->createUser($user);

$_SESSION['msg'] = '<div class="success callout">Utilisateur '.$idUser.' créé</div>';
