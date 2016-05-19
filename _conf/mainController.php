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

$destination_default = 'acceuil';
// securité sur les variables POST et GET
$destination = filter_input(INPUT_GET, 'destination', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//init de destination



$destination = empty($destination)? $destination_default:$destination;

//si il y a un model
if(!empty($action)) {
    require MODEL.DS.$action.'.php';
}

// Page n'existe pas
if(!file_exists(TEMPLATE.DS.$destination.'.php')) {

    $destination = '404';

}
require VIEWS.DS.'dispatch.php';
	

