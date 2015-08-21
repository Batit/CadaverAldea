<?php
/**/
class Component
{
protected $component="";
protected $event="onClick";
//Construct--------------------------------------------------------------------------
function __construct($type,$class)
	{
            $this->component="<input type=".$type." class=".$class;
        }
function getComponent($id,$event,$function,$name)
	{
	return $this->component." id=".$id." "." name=".$name." ".$event."=".$function;
	}
function _getComponent($id,$function,$name)
	{
	return $this->component." id=".$id." name=".$name." ".$this->event."=".$function;
	}
	
}