<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ("class/settings/MySqlModel.class.php");
require_once("class/settings/Transactions.interface.php");

class Catalogs implements Transactions
{
private $table="";
private $rows;
private $cnn;
//-----------------------------------------------------------------------------------------------------------------------------------------------
    function  __construct($table)
        {
            $this->table = $table;
            $this->cnn = new MySqlModel();
            $this->cnn->connect();
        }
//----------------------------------------------------------------------------------------------------------------------------------------------
     function getFields($values,$filter)
        {
            $sentence = "";
            $sentence = Sentences::_getSentenceSelect($this->table,$values, $filter);
            $this->rows = $this->cnn->excecuteSelect($sentence);
         return $this->rows;
        }
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function save($sentence)
    {
        $message="";
            $message = $this->cnn->excecute($sentence);
        return $message;
    }
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function update($sentence)
    {
        $message="";
	echo $sentence;
        $message = $this->cnn->excecute($sentence);
        return $message;
    }
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function _update($sentence,$filter)
    {

    }
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function delete($sentence)
    {

    }
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function _delete($sentence,$filter)
    {

    }
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function select($fileds)
    {
        $sentence="";
        $sentence=Sentences::getSentenceSelect($this->table, " * ");
        $this->register = $this->cnn->excecuteSelect($sentence);
        array_pop($this->register);
        return $this->register;
    }
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function _select($fields,$filter)
    {
        $sentence="";
        $sentence=Sentences::_getSentenceSelect($this->table, $fields,$filter);
        $this->register = $this->cnn->excecuteSelect($sentence);
        array_pop($this->register);
        return $this->register;
    }
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function _selectOr($fields,$filter)
    {
        $sentence="";
        $sentence=Sentences::_getSentenceSelectOr($this->table, $fields,$filter);
        $this->register = $this->cnn->excecuteSelect($sentence);
        return $this->register;
    }    
}
?>
