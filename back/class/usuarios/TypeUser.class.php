<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("class/settings/Sentences.class.php");
require_once("class/settings/MySqlModel.class.php");
require_once("class/settings/Transactions.interface.php");

class TypeUser implements Transactions
{
public  $typeUser;
private $privilegies;
private $table="typeusers";
private $mysqConn="";
//----------------------------------------------------------------------------------------------------------------------------------------------
    function  __construct()
        {
            $this->mysqConn = new MySqlModel();
            $this->mysqConn->connect();
        }
//-------------------------------------------------------------------------------------------------------------------------------------------
    public function _delete($sentence, $filter)
        {

        }
//-------------------------------------------------------------------------------------------------------------------------------------------

    public function _select($fields, $filter)
       {
       $sentence="";
            $sentence = Sentences::_getSentenceSelect($this->table,$fields, $filter);
       $this->typeUser = $this->mysqConn->excecuteSelect($sentence." ORDER BY description asc ");
       return $this->typeUser;
       }
//-------------------------------------------------------------------------------------------------------------------------------------------
    public function _selectCargos($fields, $filter)
       {
       $sentence="";
            $sentence = Sentences::_getSentenceSelect('cargos',$fields, $filter);
       $this->typeUser = $this->mysqConn->excecuteSelect($sentence." ORDER BY description asc ");
       return $this->typeUser;
       }
//-------------------------------------------------------------------------------------------------------------------------------------------
    public function _update($sentence, $filter)
        {
    
        }
//-------------------------------------------------------------------------------------------------------------------------------------------
    public function delete($sentence)
        {


        }
//-------------------------------------------------------------------------------------------------------------------------------------------
    public function save($sentence)
        {
    $message = "";
    $message = $this->mysqConn->excecute($sentence);
        return $message;
        }
//-------------------------------------------------------------------------------------------------------------------------------------------
    public function select($sentence)
        {
  $typeUser = "";
          $typeUser = $this->mysqConn->excecuteSelect($sentence);
  return $typeUser;
        }
//-------------------------------------------------------------------------------------------------------------------------------------------
    public function update($sentence)
        {
    $message = "";
      $message = $this->mysqConn->excecute($sentence);
        return $message;
        }

}
?>
