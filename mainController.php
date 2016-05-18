<?php
session_start();
//Définition de la racine du modèle
define('ROOT', __DIR__);
//define('ABSPATH', __DIR__);
define('DS', DIRECTORY_SEPARATOR);

//inclusion du fichier de configuration de la base de donnée
require_once ROOT.DS.'_conf'.DS.'_connect.php';

//Connexion BDD
$db = new PDO(BDD_DRIVER.':host='.BDD_SERVEUR.';dbname='.BDD,BDD_USER,BDD_PWD);
//Génération d'alerte en cas d'échec d'une requête
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
function chargerClasses ($classname) {
    require CLASSDIR.DS.'class'.$classname.'.php';
}
function chargerControllers ($destination) {
    require CONTROLLER.DS.$destination.'.php';
}
function chargerModels ($destination) {
    require MODELS.DS.$destination.'.php';
}
//Chargement automatique des classes lors de l'appel
spl_autoload_register('chargerClasses');

//creation de l'objet de securité (contient toute la securité)
$secure = New Security();

// securité sur les variables POST et GET
if($_POST){
    $secure->post($_POST);
}

if($_GET){
    $secure->get($_GET);
}
//init de destination
$destination_default = 'acceuil';


$destination = empty($destination)? $destination_default:$destination;

spl_autoload_register('chargerControllers');
spl_autoload_register('chargerModels');


	require VIEWS.DS.$destination.'.php';

