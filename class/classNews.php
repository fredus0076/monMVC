<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classNews
 *
 * @author fabrice
 */
class News {
    private $id;
    private $date;
    private $message;
    private $userid;
    
    function getId() {
        return $this->id;
    }

    function getDate() {
        return $this->date;
    }

    function getMessage() {
        return $this->message;
    }

    function getUserid() {
        return $this->userid;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function setUserid($userid) {
        $this->userid = $userid;
    }


}
