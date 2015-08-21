<?php

/*
 *
 */
require_once("class/settings/MySqlModel.class.php");
require_once("class/settings/Sentences.class.php");

class Menu {

    protected $menus = "";
    private $subMenus = "";
    private $cnn;
    private $haveSubmenu = false;
    private $addOperations = array('AGREGAR', 'CONSULTAR',);

//---------------------------------------------------------------------------------------------------------------------------
    protected function __construct() {
        $this->cnn = new MySqlModel();
        $this->cnn->connect();
    }

//------------------------------------------------------------------------------------------------------------------
    function getMenusPriv($idUser, $idModule) {
        $sentence = "";
        $sentence = "SELECT
     menus.`idModule` AS menus_idModule,
     menus.`description` AS menus_description,
     menus.`ref` AS menus_ref,
     menus.`operation` AS menus_operation,
     accessmenu.`idUser` AS accessmenu_idUser,
     menus.`idMenu` AS menus_idMenu
FROM
     `menus` menus LEFT JOIN `accessmenu` accessmenu ON menus.`idMenu` = accessmenu.`idMenu`
     LEFT JOIN `users` users ON accessmenu.`idUser` = users.`idUser`
     WHERE accessmenu.idUser = '" . $idUser . "' AND menus.idModule = '" . $idModule . "' OR menus.state = '2' AND menus.idModule = '" . $idModule . "' group by menus.`idMenu`
    ";
        $this->menus = $this->cnn->excecuteSelect($sentence . "ORDER BY menus.idMenu");
        array_pop($this->menus);
        return $this->menus;
    }

//-------------------------------------------------------------------------------------------------------------------
    function getSubMenuPriv($idUser, $idMenu) {
        $sentence = "";
        /* $sentence="SELECT
          submenus.`description` AS description,
          submenus.`addOperations` AS addOperations,
          submenus.`operation` AS operation,
          submenus.`state` AS state
          FROM
          `submenus` submenus INNER JOIN `accesssubmenu` accesssubmenu ON submenus.`idSubMenus` = accesssubmenu.`isSubmenu`
          INNER JOIN `users` users ON accesssubmenu.`idUser` = users.`idUser`
          WHERE
          submenus.idMenu = '".$idMenu."' "; */
        $sentence = "SELECT submenus.`description` AS description, submenus.`addOperations` AS addOperations, submenus.`operation` AS operation, submenus.`state` AS state FROM `submenus` WHERE submenus.idMenu = '" . $idMenu . "' ";
        $this->subMenus = $this->cnn->excecuteSelect($sentence. "ORDER BY idSubMenus");
        return $this->subMenus;
    }

//------------------------------------------------------------------------------------------------------------------
    function getMenus() {
        $sentence = "";
        $sentence = Sentences::_getSentenceSelect("menus", " * ", array('state' => '1',));
        $this->menus = $this->cnn->excecuteSelect($sentence . "ORDER BY idMenu");
        return $this->menus;
    }

//------------------------------------------------------------------------------------------------------------------
    protected function _getMenus($id) {
        $sentence = "";
        $sentence = Sentences::_getSentenceSelect("menus", " * ", array('state' => '1', 'idModule' => $id));
        $this->menus = $this->cnn->excecuteSelect($sentence . "ORDER BY idMenu");
        array_pop($this->menus);
        return $this->menus;
    }

//-------------------------------------------------------------------------------------------------------------------
    protected function getSubmenu($idMenu) {
        $sentence = "";
        $sentence = Sentences::_getSentenceSelect("submenus", "idSubMenus,description,addOperations,operation", array('state' => '1', 'idMenu' => $idMenu,));
        $this->subMenus = $this->cnn->excecuteSelect($sentence. "ORDER BY idSubMenus");
        return $this->subMenus;
    }

//-------------------------------------------------------------------------------------------------------------------
    public function isAllowedAccess($access) {
        $x = 0;
        $allowed = false;
        while ($x < count($this->menus)) {
            foreach ($this->menus[$x] as $nameField => $valueField) {
                if ($this->menus[$x]['menus_description'] == strtoupper($access)) {
                    $allowed = true;
                }
            }
            $x++;
        }
        return $allowed;
    }

//--------------------------------------------------------------------------------------------------------------------
    protected function getValFunctions($idUser) {
        $sentence = "SELECT * FROM functionsval
        INNER JOIN accessValidate ON functionsval.idFunction = accessValidate.idFuncVal
        INNER JOIN users ON accessValidate.idUser = users.idTypeUser
        WHERE accessValidate.idUser = '" . $idUser . "' group by idFunction ";
        $tfunctions = $this->cnn->excecuteSelect($sentence);
        return $tfunctions;
    }

//-------------------------------------------------------------------------------------------------------------------
    protected function getAditionalSubMenu() {
        return $this->addOperations;
    }

//-------------------------------------------------------------------------------------------------------------------------
    protected function getSubMenuCount() {
        ;
    }

//--------------------------------------------------------------------------------------------------------------------
    protected function getMenuItem($numberItem) {
        ;
    }

//--------------------------------------------------------------------------------------------------------------------
    protected function _getMenuItem($getNameItem) {
        ;
    }

//--------------------------------------------------------------------------------------------------------------------
    protected function getSubMenuItem($numberItem) {
        ;
    }

//--------------------------------------------------------------------------------------------------------------------
    protected function _getSubMenuItem($getNameItem) {
        ;
    }

//--------------------------------------------------------------------------------------------------------------------
}

?>
