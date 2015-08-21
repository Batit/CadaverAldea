<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("class/settings/Sentences.class.php");
require_once("class/settings/MySqlModel.class.php");
require_once("class/settings/Transactions.interface.php");

class HelpSystem implements Transactions {

    private $cnn;
    private $table = "helpsystem";
    private $privilegies;

//---------------------------------------------------------------------------------------------------------------------------------------------------
    function __construct() {
        $this->cnn = new MySqlModel();
        $this->cnn->connect();
        $this->user = $user;
    }
//---------------------------------------------------------------------------------------------------------------------------------------------------
     public function _delete($sentence, $filter) {
        
    }
//---------------------------------------------------------------------------------------------------------------------------------------------------
    public function _select($fields, $filter) {
        $helps = "";
            $sentence = Sentences::_getSentenceSelect($this->table," * ",$filter);
            $helps = $this->cnn->excecuteSelect($sentence);
        return $helps[0]['description'];
    }
//---------------------------------------------------------------------------------------------------------------------------------------------------
    public function _update($sentence, $filter) {
        
    }
//---------------------------------------------------------------------------------------------------------------------------------------------------
    public function delete($sentence) {
        
    }
//---------------------------------------------------------------------------------------------------------------------------------------------------
    public function save($sentence) {
        
    }
//---------------------------------------------------------------------------------------------------------------------------------------------------
    public function select($fileds) {
        
    }
//---------------------------------------------------------------------------------------------------------------------------------------------------
    public function update($sentence) {
        
    }

}
?>
