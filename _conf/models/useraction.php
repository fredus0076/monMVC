<?php

//création d'un tableau avec les actions que j'autorise
$actions_autorisees = array('detail','modifier', 'supprimer', 'modifieruser');

//récupère les informations depuis la barre d'adresse
$opt = filter_input(INPUT_GET, 'opt', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id_user = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);

//Récupération des informations du formulaire de modification de l'utilisateur
$userForm = array('nom' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                    'prenom' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                    'email' => FILTER_SANITIZE_EMAIL,
                    'profil' => FILTER_SANITIZE_NUMBER_INT);

$user = filter_input_array(INPUT_POST, $userForm);

//test si l'action est autorisée

if(in_array($opt, $actions_autorisees)) {
    //l'action est autorisée je continue
    
    $objUser = new User($db);
    
    switch($opt) {
        case 'detail';
        case 'modifier':
            
            $objUser->setId($id_user);
            $user = $objUser->getUser();
            
            //var_dump($user);
            
            //affichage de mon formulaire si c'est une modification
            if($opt == 'modifier') {
                $destination = 'formulaire';
            } else {
                $destination = 'detail';
            }
            
            break;
        case 'modifieruser':
            $objUser->setId($id_user);
            //$objUser->updateUser($user);
            if($objUser->updateUser($user) == 1) {
                $_SESSION['msg']='<div class="success callout">utilisateur modifié</div>';
            }

            $destination = 'listeusers';
            break;
        
        case 'supprimer':
            //Création de la requete de suppression
            //$reqActionUser = 'DELETE FROM users WHERE id_user='.$id_user;
            $objUser->setId($id_user);
            //var_dump($objUser->deleteUser());
            
            if(!$objUser->deleteUser()) {
                $_SESSION['msg']='<div class="warning callout">Problème lors de la suppression !</div>';
            } else {
                $_SESSION['msg']='<div class="success callout">Utilisateur supprimé</div>';
            }
            
            $destination = 'listeusers';
            break;
    }
    
    
} else {
    //Action non autorisée je m'arrete
    $_SESSION['msg']='<div class="alert callout">Action non autorisée !</div>';
}

