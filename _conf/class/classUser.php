<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classUser
 *
 * @author fabrice
 */
class User {
    private $id;
    private $email;
    private $password;
    private $nom;
    private $prenom;
    private $profil;
    private $photo;
    private $db; //instance  
    
    public function __construct($db) {
        $this->setDb($db);
    }
    
    public function setDb($db) {
        $this->db = $db;
    }

    function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getProfil() {
        return $this->profil;
    }

    function setId($id) {
        $this->id = (int)$id;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setProfil($profil) {
        $this->profil = $profil;
    }
    
    //Selection utilisateur 
    //CRUD
    //CREATE
    
    function createUser(array $tabUser) {
        
        
        // Ecriture de la requête
        $reqInsertUser = 'INSERT INTO users (`nom`,`prenom`, `profil`,`mdp`,`email`) VALUES ';
        $reqInsertUser .= '(:nom,:prenom,:profil,:mdp, :email)';
        
        $user = $this->db->prepare($reqInsertUser);
        $user->execute($tabUser);
        
        return $this->db->lastInsertId();
        
    }
    
    function updateUser(array $tabUser) {
     
        $attributs = get_class_vars(__CLASS__);
        
        $user = array_intersect_key($tabUser, $attributs);
        $user['id'] = $this->id;

        //Affectation des valeurs du formulaire à ma requête
        $reqActionUser = 'UPDATE users SET nom=:nom, prenom=:prenom, ';
        $reqActionUser .= 'profil=:profil, email=:email WHERE id_user = :id';

        //Préparation de la requête
        $userUpdate = $this->db->prepare($reqActionUser);

        $userUpdate->execute($user);

        return $userUpdate->rowCount();
            
        
    }
      
    //READ
    function getUser() {
        //Sélectionne l'utilisateur grâce à son email
        //$reqGetUser = 'SELECT * FROM users WHERE email="'.$this->email.'" LIMIT 1';
        
        //Utilisation de parametres pour générer la requête préparée
        $reqGetUser = 'SELECT * FROM users JOIN profils ON ';
        $reqGetUser .= 'users.profil = profils.id_profil WHERE id_user = :id LIMIT 1';
        
        //plus nécessaire car on utilise l'objet $db
        //$bdd_connexion = new mysqli(BDD_SERVEUR, BDD_USER, BDD_PWD, BDD);
        
        //Préparation de la requête
        $data = $this->db->prepare($reqGetUser);
        
        //Définition du paramètre
        /*$data->bindValue(':email', $this->email, PDO::PARAM_STR);
        $data->execute();
        */
        
        /*$data->bindValue(':id', $this->id, PDO::PARAM_INT);
        $data->execute();
        */
        
        $data->execute(array('id' => $this->id));
        
        $user = $data->fetch(PDO::FETCH_ASSOC);
        
        return $user;
    }

    
    /*
     * Récupère tous les utilisateurs
     *
     */
    public function getAllUsers() {
        $reqGetUsers = 'SELECT * FROM users JOIN profils ON users.profil = profils.id_profil';
        $data = $this->db->prepare($reqGetUsers);
        $data->execute();
        $allUsers = $data->fetchAll(PDO::FETCH_ASSOC);
        return $allUsers;
        
    }
    
    //hydratation user => remplissage de l'objet utilisateur
    /*function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method));
        }
    }*/
    
    //Vérifie concordance utilisateur mot de passe
    public function checkUser() {
        
        $reqGetUser = 'SELECT mdp,id_user FROM users WHERE email = :email LIMIT 1';
        
        //Préparation de la requête
        $data = $this->db->prepare($reqGetUser);
        $data->execute(array('email'=> $this->email));
        $user = $data->fetch(PDO::FETCH_ASSOC);
        
        $this->setId($user['id_user']);
        
        return password_verify($this->password, $user['mdp']);
        
    }
    
    public function deleteUser() {
        try {
            $reqDeleteUser = 'DELETE FROM users WHERE id_user = :id';
            $userDelete = $this->db->prepare($reqDeleteUser);

            $userDelete->bindValue(':id', $this->id, PDO::PARAM_INT);
            $userDelete->execute();

            return $userDelete->rowCount();
        } catch (Exception $ex) {
            Log::createlog($ex->getMessage().' '.__CLASS__.' '.__FUNCTION__.' '.__LINE__);
            
        }
        
        
    }
    
    public function logoutUser(){
        session_destroy();
    }
    
    
    
}
