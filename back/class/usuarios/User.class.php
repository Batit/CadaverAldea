<?php

/*
 *
 * this class will be the model for the docuemnts control from SGC systems
 *
 */
require_once("class/settings/Sentences.class.php");
require_once("class/settings/MySqlModel.class.php");
require_once("class/settings/Transactions.interface.php");

class User implements Transactions {

    private $cnn;
    private $table = "users";
    private $privilegies;
    private $user;
    protected $usersProc = "";
    protected $usersProcess = "";

//---------------------------------------------------------------------------------------------------------------------------------------------------
    function __construct($root, $user) {
        $this->cnn = new MySqlModel();
        $this->cnn->connect();
        $this->user = $user;
        $this->usersProc = "SELECT * FROM procedures 
                            INNER JOIN refdepproc ON procedures.code = refdepproc.idProcRef
                            INNER JOIN deparments ON refdepproc.idDepRef = deparments.idDepartments
                            INNER JOIN users ON deparments.idDepartments = users.idDepartment";

        $this->usersProcess = "SELECT * FROM procedures 
                               INNER JOIN processes ON procedures .idProcess
                               INNER JOIN users ON processes.idUser = users.idUser";
    }

    /*     * ****************************************************
     *                                                    *
     *                                                    *
      methods for to do transactions with table users
     *                                                    *
     *                                                    *
     * ***************************************************** */

//-------------------------------------------------------------------------------------------------------------------------------------------
    function getPrivilegies($filter) {
        $sentence = "SELECT
     menus.`description` AS menus_description,
     users.`userName` AS users_userName,
     users.`lastName` AS users_lastName,
     users.`secondLastName` AS users_secondLastName,
     users.`email` AS users_email,
     users.`idDepartment` AS users_idDepartment,
     accessmenu.idUser AS accessmenu_idUser,
     accessmenu.idMenu AS accessmenu_idMenu,
     deparments.`description` AS deparments_description
FROM
     `menus` menus INNER JOIN `accessmenu` accessmenu ON menus.`idMenu` = accessmenu.`idMenu`
     INNER JOIN `users` users ON accessmenu.`idUser` = users.`idUser`
     INNER JOIN `deparments` deparments ON users.`idDepartment` = deparments.`idDepartments`
     WHERE accessmenu.idUser = '" . $filter . "' OR users.email = '" . $filter . "'";
        $this->privilegies = $this->cnn->excecuteSelect($sentence);
        return $this->privilegies;
    }

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function save($sentence) {
        $message = "";
        $message = $this->cnn->_excecute($sentence);
        return $message;
    }

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function isUser($pass) {
        $sentence = "";
        $pass = FilterSqlSentences::getCharFilter($pass);
        $sentence = Sentences::_getSentenceSelect("users", " * ", array('email' => $this->user, 'password' => ($pass)));
        if ($this->cnn->getNumberRows($sentence) > 0) {
            $data = $this->cnn->excecuteSelect($sentence);
            return $data[0]['idUser'];
        } else {
            return 0;
        }
    }

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function isSignature($idUser, $signature) {
        $sentence = "";
        $pass = FilterSqlSentences::getCharFilter($signature);
        $sentence = Sentences::_getSentenceSelect("users", " * ", array('idUser' => $idUser, 'signature' => $signature));
        if ($this->cnn->getNumberRows($sentence) > 0) {

            $data = $this->cnn->excecuteSelect($sentence);
            return true;
        } else {
            return 0;
        }
    }

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function update($sentence) {
        $message = "";
        $message = $this->cnn->excecute($sentence);
        return $message;
    }

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function _update($sentence, $filter) {
        
    }

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function delete($sentence) {
        $message = "";
        $message = $this->cnn->excecute($sentence);
        return $message;
    }

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function _delete($sentence, $filter) {
        
    }

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function select($sentence) {
        $this->user = $this->cnn->excecuteSelect($sentence);
        return $this->user;
    }

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    function _select($fields, $filter) {
        $sentence = Sentences::_getSentenceSelectOr($this->table, $fields, $filter);
        $this->user = $this->cnn->excecuteSelect($sentence." ORDER BY lastName");
        return $this->user;
    }

}

?>
