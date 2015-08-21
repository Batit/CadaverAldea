<?php

require_once("class/settings/Sentences.class.php");
require_once("class/settings/MySqlModel.class.php");
require_once("class/settings/Transactions.interface.php");

class porfiles implements Transactions{
    
    private $cnn;
    private $table = "porfiles";
    
    function __construct() {
        $this->cnn = new MySqlModel();
        $this->cnn->connect();
    }

    public function _delete($sentence, $filter) {
        
    }
	public function  selectPorfile($sentece){
     $rs = $this->cnn->excecuteSelect($sentece);
     return $rs;
}
    public function _select($fields, $filter) {
        $sentece = Sentences::_getSentenceSelect($this->table, $fields, $filter);
        $rs = $this->cnn->excecuteSelect($sentece);
        return $rs;
    }

    public function _update($sentence, $filter) {
        
    }

    public function delete($sentence) {
        
    }

    public function save($sentence) {
        $rs = $this->cnn->excecute($sentence);
        return $rs;
    }

    public function select($fileds) {
        $rs = $this->cnn->excecuteSelect($fileds);
        return $rs;
    }

    public function update($sentence) {
        $rs = $this->cnn->excecute($sentence);
        return $rs;
    }
}

?>
