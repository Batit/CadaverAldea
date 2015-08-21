<?php
require_once("Menu.class.php");

class MenuHTML extends Menu
{
private $menu;
private $subMenu;
private $addMenus;
private $menuClass="";
private $subMenuClass="";
function  __construct()
    {
        parent::__construct();
    }
//--------------------------------------------------------------------------------------------------------------------
function getMenu($separator,$menuClass,$subMenuClass)
    {
       $this->menuClass = $menuClass;
       $this->subMenuClass = $subMenuClass;
       $menu="<ul class =".$this->menuClass.">";
       $x=0;
       $this->menu=$this->getMenus();
       while($x<count($this->menu))
            {
            if($x<(count($this->menu)-1))
                {
                    if($separator != "")
                        {
                        $menu.="<li><a href=".$this->menu[$x]['ref']." onclick=".$this->menu[$x]['operation']." >".ucfirst(strtolower($this->menu[$x]['description']))."</a>".
                                $this->_getSubMenu($this->menu[$x]['idMenu'])."
                                </li><li><a>".$separator."</a></li>";
                        }
                    else
                        {
                        $menu.="<li><a href=".$this->menu[$x]['ref']." onclick=".$this->menu[$x]['operation']." >".ucfirst(strtolower($this->menu[$x]['description']))."</a>".
                               $this->_getSubMenu($this->menu[$x]['idMenu']);
                        }
                }
            else
                {
                    $menu.="<li><a href=#  onclick=".$this->menu[$x]['operation']." >".ucfirst(strtolower($this->menu[$x]['description']))."</a>".
                            $this->_getSubMenu($this->menu[$x]['idMenu']);
                }
            $x++;
            }
       $menu.="</ul>";
        return $menu;
    }
//--------------------------------------------------------------------------------------------------------------------
function _getMenu($separator,$id,$menuClass,$subMenuClass)
    {
       $this->menuClass = $menuClass;
       $this->subMenuClass = $subMenuClass;
       $menu="<ul class=".$this->menuClass.">";
       $x=0;
       $this->menu=$this->_getMenus($id);
       while($x<count($this->menu))
            {
            if($x<(count($this->menu)-1))
                {
                    if($separator != "")
                        {
                        $menu .="<li><a href=".$this->menu[$x]['ref']." onclick=".$this->menu[$x]['operation']." >".ucfirst(strtolower($this->menu[$x]['description']))."</a>".
                                $this->_getSubMenu($this->menu[$x]['idMenu'])."
                                </li><li><a>".$separator."</a></li>";
                        }
                    else
                        {
                        $menu.="<li><a href=".$this->menu[$x]['ref']." onclick=".$this->menu[$x]['operation']." >".ucfirst(strtolower($this->menu[$x]['description']))."</a>".
                               $this->_getSubMenu($this->menu[$x]['idMenu']);
                        }
                }
            else
                {
                    $menu.="<li><a href=#  onclick=".$this->menu[$x]['operation']." >".ucfirst(strtolower($this->menu[$x]['description']))."</a>".
                            $this->_getSubMenu($this->menu[$x]['idMenu']);
                }
            $x++;
            }
       $menu.="</ul>";
       return $menu;
    }
//--------------------------------------------------------------------------------------------------------------------
function getMenuPriv($separator,$idModule,$menuClass,$subMenuClass,$idUser)
    {
       $this->menuClass = $menuClass;
       $this->subMenuClass = $subMenuClass;
       $menu="<ul class=".$this->menuClass.">";
       $x=0;
       $this->menu = $this->getMenusPriv($idUser,$idModule);
       while($x<count($this->menu))
            {
            if($x<(count($this->menu)-1))
                {
                    if($separator != "")
                        {
                        $menu.="<li><a href=".$this->menu[$x]['menus_ref']." onclick=".$this->menu[$x]['menus_operation']." >".ucfirst(strtolower($this->menu[$x]['menus_description']))."</a>".
                                $this->_getSubMenuPriv($this->menu[$x]['accessmenu_idUser'],$this->menu[$x]['menus_idMenu'])."
                                </li><li><a>".$separator."</a></li>";
                        }
                    else
                        {
                        $menu.="<li><a href=".$this->menu[$x]['menus_ref']." onclick=".$this->menu[$x]['menus_operation']." >".ucfirst(strtolower($this->menu[$x]['menus_description']))."</a>".
                               $this->_getSubMenuPriv($this->menu[$x]['accessmenu_idUser'],$this->menu[$x]['menus_idMenu']);
                        }
                }
            else
                {
                    $menu.="<li><a href=#  onclick=".$this->menu[$x]['menus_operation']." >".ucfirst(strtolower($this->menu[$x]['menus_description']))."</a>".
                            $this->_getSubMenuPriv($this->menu[$x]['accessmenu_idUser'],$this->menu[$x]['menus_idMenu']);
                }
            $x++;
            }
       $menu.="</ul>";
       return $menu;
    }
//--------------------------------------------------------------------------------------------------------------------
function getMenuCount()
    {
    ;
    } 
//-------------------------------------------------------------------------------------------------------------------------
function _getSubMenuPriv($idUser,$idMenu)
    {
     $this->subMenu = $this->getSubMenuPriv($idUser,$idMenu);
     $subMenu="";
     if(count($this->subMenu) > 1)
        {
        $subMenu=$this->getMenuStructure($this->subMenu);
        }
     return $subMenu;
    }//-------------------------------------------------------------------------------------------------------------------------
function _getSubMenu($idMenu)
    {
     $this->subMenu = $this->getSubmenu($idMenu);
     $subMenu="";
     if(count($this->subMenu) > 1)
        {
        $subMenu=$this->getMenuStructure($this->subMenu);
        }
     return $subMenu;
    }
//---------------------------------------------------------------------------------------------------------------------------------------------------
function _getAditionalSubMenu()
    {
        $this->addMenus = $this->getAditionalSubMenu();
    }
//-----------------------------------------------------------------------------------------------------------------------------------------------------
private function getMenuStructure(array $menuStructure)
    {
    $menu="";
	if(count($menuStructure) != 0)
            {
            $menu="<ul class=".$this->subMenuClass.">";
            $x=0;
            while($x<count($menuStructure)-1)
                {
                    if($menuStructure[$x]['description'] != " ")
                        {
                            $menu.="<li><a href=# onclick=".$menuStructure[$x]['operation'].">".ucfirst(strtolower($menuStructure[$x]['description']))."</a>";
                                if($menuStructure[$x]['addOperations'] == 1){
                                   $menu.=$this->getAddtionalMenu(ucfirst(strtolower($menuStructure[$x]['operation'])));
                                   $menu.="</li>";
                                }else if($menuStructure[$x]['addOperations'] == 2){
                                    $menu.=$this->_getAddtionalMenu(ucfirst(strtolower($menuStructure[$x]['operation'])));
                                    $menu.="</li>";
                                }
                        }
                    $x++;
                }
            $menu.="</ul>";
            }

      return $menu;
      }
//--------------------------------------------------------------------------------------------------------------------
private function getAddtionalMenu($operation)
    {
    $addMenu="<ul  class=subMenu >";
    $addOpetaritions = $this->getAditionalSubMenu();
    $x=0;
            while($x<count($addOpetaritions))
                {
                    if($addOpetaritions[$x] != " ")
                    $addMenu.="<li><a href=# onclick=xajax_getForm('".ucfirst(strtolower($operation))."_".strtolower($addOpetaritions[$x])."') >".ucfirst(strtolower($addOpetaritions[$x]))."</a></li>";
                    $x++;
                }
       $addMenu.="</ul>";
      return $addMenu;
    }
//--------------------------------------------------------------------------------------------------------------------
private function _getAddtionalMenu($operation)
    {
    $addMenu="<ul  class=subMenu >";
    $addOpetaritions = $this->getAditionalSubMenu();
    $x=0;
            while($x<count($addOpetaritions))
                {
                    if($addOpetaritions[$x] != " ")
                    $addMenu.="<li><a href='home?token=".ucfirst(strtolower($operation."_".$addOpetaritions[$x]))."' >".ucfirst(strtolower($addOpetaritions[$x]))."</a></li>";
                    $x++;
                }
       $addMenu.="</ul>";
      return $addMenu;
    }
//--------------------------------------------------------------------------------------------------------------------
public function _getValFunctions($idUser)
    {
    $tfunctions = $this->getValFunctions($idUser);
     $x=0;
            while($x<count($tfunctions))
                {
                    if($tfunctions[$x] != " ")
                    $menu.="<li id='".$tfunctions[$x]['idFunc']."'><a class='box' onclick=".$tfunctions[$x]['function']." href='#' />&nbsp;&nbsp;&nbsp;".$tfunctions[$x]['description']."</a></li>";
                    $x++;
                }
    return $menu;
    }    
}
?>
