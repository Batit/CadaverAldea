<?php
/*
 * this class define object select 

 *  */
require_once ('Component.class.php');
require_once ("class/settings/MySqlModel.class.php");
class Select extends Component
{
private $select="";

//Construct--------------------------------------------------------------------------
function __construct($class)
	{
	 $this->component="<select class =".$class;
        }
//--------------------------------------------------------------------------
function getSelectDbSelect($id,$event,$function,array $option,$name,$field,$selected)
	{
        $this->event=$event;
            $this->select=parent::getComponent($id,$event,$function,$name)." ><option value=0 >--Seleccionar--</option>";
            foreach($option as $key => $value)
                {
                    if($value[$field] == $selected)
                        {
                        $this->select.="<option value=".$value[$id]." id=".$id." selected > ".ucfirst(strtolower($value[$field]))."</option>";
                        }
                    $this->select.="<option value=".$value[$id]." id=".$id." > ".ucfirst(strtolower($value[$field]))."</option>";
                }
        return $this->select."<option>--Add new--</option></select>";
	}//--------------------------------------------------------------------------
function getSelectDb($id,$event,$function,array $option,$name,$field)
	{
        $this->event=$event;
            $this->select=parent::getComponent($id,$event,$function,$name)." ><option value=0 >--Seleccionar--</option>";
            foreach($option as $key => $value)
                {
                $this->select.="<option value=".$value[$id]." id=".$id." > ".ucfirst(strtolower($value[$field]))."</option>";
                }
        return $this->select."<option>--Add new--</option></select>";
	}
//--------------------------------------------------------------------------
function _getSelectDb($id,$function,array $option,$field)
	{
            $this->select=parent::_getComponent($id,$function,$id)." ><option value=0 >--Seleccionar--</option>";
            foreach ($option as $key => $value)
                {
                $this->select.="<option value=".$value[$id]." id=".$id." >".ucfirst(strtolower($value[$field]))."</option>";
                }
        return $this->select."</select>";
	}//--------------------------------------------------------------------------
function getSelect($id,$event,$function,array $option,$name)
	{
        $this->event=$event;
            $this->select=parent::getComponent($id,$event,$function,$name)." ><option id=0  >--Seleccionar--</option>";
            foreach($option as $key => $value)
                {
                $this->select.="<option>".$value."</option>";
                }
        return $this->select."</select>";
	}       
//--------------------------------------------------------------------------
function _getSelect($id,$function,array $option)
	{
            $this->select=parent::_getComponent($id,$function)." ><option id=0 >--Seleccionar--</option>";
            foreach ($option as $key => $value) 
                {
                $this->select.="<option>".$value."</option>";
                }
        return $this->select."</select>";
	}
//--------------------------------------------------------------------------
function getSelectLabel($id,$function,$label,array $option)
	{
            $selectlabel="<label>".$label."</label>".$this->_getSelect($id,$function,$option);
         return $selectlabel;
	}
//--------------------------------------------------------------------------
function _getSelectLabel($id,$event,$function,$label,array $option,$name)
	{
            $selectlabel="<label>".$label."</label>".$this->getSelect($id, $event, $function, $option, $name, $field);
	return $selectlabel;
        }
//--------------------------------------------------------------------------
function getSelectLabelDb($id,$function,$label,array $option,$field)
	{
            $selectlabel="<label>".$label."</label>".$this->_getSelectDb($id,$function,$option,$field);
         return $selectlabel;
	}
//--------------------------------------------------------------------------
function _getSelectLabelDb($id,$event,$function,$label,array $option,$name,$field)
	{
            $selectlabel="<label>".$label."</label>".$this->getSelectDb($id,$event,$function,$option,$name,$field);
	return $selectlabel;
        }
//--------------------------------------------------------------------------
function getSize()
	{
	
	}
//--------------------------------------------------------------------------
function getOptionsDb($tabla,$values,$filter,$id,$arr = false)
        {
            $conn= new MySqlModel();
            $conn->connect();
            $sentence = Sentences::_getSentenceSelect($tabla, $values, $filter);
            $order = explode(",",$values);
            $x = count($order)-1;
            $options=$conn->excecuteSelect($sentence." ORDER BY ".$order[$x]);
	    array_pop($options);
            $arrayOption=$this->getOptions($options,$values,$id,$arr);	
            return $arrayOption;
         }
//------------------------------------------------------------------------------------------------------------------------------------------------
function getOptions(array $array,$field,$id,$arr = false)
    {
    $options="<option>--Seleccionar--</option>";
    $arrField=explode(",", $field);
    if(count($arrField)>1)
        {
        $optValue=$arrField[0];
        $optField=$arrField[1];
        }
     else
        {
            $optValue=$arrField[0];
            $optField=$arrField[0];
        }
   foreach ($array as $key => $value)
        {
	    if($arr){
		$str = "";	
			foreach($value as $k => $v){
				if(in_array($k,$arrField)){
				$str.=$v."&nbsp";
				}
			}
		$options.="<option id=".$id." value='".utf8_decode($value[$optValue])."' >".html_entity_decode(html_entity_decode(html_entity_decode(utf8_decode($str))))."</option>";
	     		
		}
	   else{
		$options.="<option id=".$id." value='".utf8_decode($value[$optValue])."' >".html_entity_decode(html_entity_decode(html_entity_decode(utf8_decode($value[$optField]))))."</option>";
		} 	
        }
    return $options;
    }
//--------------------------------------------------------------------------
function _getOptionsDb($tabla,$values,$filter,$id,$selected,$arr = false)
        {
            $conn= new MySqlModel();
            $conn->connect();
            $sentence = Sentences::_getSentenceSelect($tabla, $values, $filter);
            $options=$conn->excecuteSelect($sentence);
	    array_pop($options);
            if(is_array($selected)){
                $arrayOption=$this->_getOptionsArray($options,$values,$id,$selected,$arr);
            }else{
                $arrayOption=$this->_getOptions($options,$values,$id,$selected,$arr);
            }
            	
         return $arrayOption;
         }
//------------------------------------------------------------------------------------------------------------------------------------------------
function _getOptions(array $array,$field,$id,$selected,$arr = false)
    {
    $options="<option>--Seleccionar--</option>";
    $arrField=explode(",", $field);
    if(count($arrField)>1)
        {
        $optValue=$arrField[0];
        $optField=$arrField[1];
        }
     else
        {
            $optValue=$arrField[0];
            $optField=$arrField[0];
        }
   foreach ($array as $key => $value)
        {	
        if($value[$optField] == $selected || $value[$optValue] == $selected )
            {
            if($arr){		
		$str = "";	
			foreach($value as $k => $v){
				if(in_array($k,$arrField)){
				$str.=$v."&nbsp";
				}
			}
		$options.="<option id=".$id." value='".utf8_decode($value[$optValue])."' selected >".html_entity_decode(html_entity_decode(html_entity_decode(utf8_decode($str))))."</option>";
	     		
		}
	   else{
		$options.="<option id=".$id." value='".utf8_decode($value[$optValue])."' selected >".html_entity_decode(html_entity_decode(html_entity_decode(utf8_decode($value[$optField]))))."</option>";
		} 
            }
        else
            {
            	if($arr){		
		$str = "";	
			foreach($value as $k => $v){
				if(in_array($k,$arrField)){
				$str.=$v."&nbsp";
				}
			}
		$options.="<option id=".$id." value='".utf8_decode($value[$optValue])."' >".html_entity_decode(html_entity_decode(html_entity_decode(utf8_decode($str))))."</option>";
	     		
		}
	   else{
		$options.="<option id=".$id." value='".utf8_decode($value[$optValue])."' >".html_entity_decode(html_entity_decode(html_entity_decode(utf8_decode($value[$optField]))))."</option>";
		} 
	    }

        }
    return $options;
    }


//--------------------------------------------------------------------------
function getOptionsDbSel($tabla,$values,$filter,$id,$selected,$arr = false)
        {
            $conn= new MySqlModel();
            $conn->connect();
            $sentence = Sentences::_getSentenceSelect($tabla, $values, $filter);
            $options=$conn->excecuteSelect($sentence);
	    array_pop($options);
            if(is_array($selected)){
                $arrayOption=$this->getOptionsArraySel($options,$values,$id,$selected,$arr);
            }else{
                $arrayOption=$this->getOptionsSel($options,$values,$id,$selected,$arr);
            }
            	
         return $arrayOption;
         }
//------------------------------------------------------------------------------------------------------------------------------------------------
function getOptionsSel(array $array,$field,$id,$selected,$arr = false)
    {
    $options="";
    $arrField=explode(",", $field);
    if(count($arrField)>1)
        {
        $optValue=$arrField[0];
        $optField=$arrField[1];
        }
     else
        {
            $optValue=$arrField[0];
            $optField=$arrField[0];
        }
   foreach ($array as $key => $value)
        {	
            if($arr){		
		$str = "";	
			foreach($value as $k => $v){
				if(in_array($k,$arrField) && $k != $id){
				$str.=$v."&nbsp";
				}
			}
		$options.="<li style='list-style:none;' id=".$id." value='".utf8_decode($value[$optValue])."' >".$str."</li>";
	     		
		}
	   else{
		$options.="<li style='list-style:none;' id=".$id." value='".utf8_decode($value[$optValue])."' >".$value[$optField]."</li>";
		} 
	}
    return $options;
    }

function getOptionsArraySel(array $arrayF,$field,$id,$selected,$arr)
    {
       	$options = "";
        $arrField = explode(",", $field);
        if (count($arrField) > 1) {
            $optValue = $arrField[0];
            $optField = $arrField[1];
        } else {
            $optValue = $arrField[0];
            $optField = $arrField[0];
        }
        foreach ($arrayF  as $key => $value) {
            if(in_array($value[$id],$selected))
            	{
            		if($arr){		
				$str = "";	
				foreach($value as $k => $v){
					if(in_array($k,$arrField) && $k != $id){
					$str.=$v."&nbsp";
					}
				}
			$options.="<li style='list-style:none;' id=".$id." value='".utf8_decode($value[$optValue])."' >".$str."</li>";	
			}
            	}
        }
        return $options;
    }


//------------------------------------------------------------------------------------------------------------------------------------------------
function _getOptionsArray(array $arrayF,$field,$id,$selected,$arr)
    {
        $options = "<option>--Seleccionar--</option>";
        $arrField = explode(",", $field);
        if (count($arrField) > 1) {
            $optValue = $arrField[0];
            $optField = $arrField[1];
        } else {
            $optValue = $arrField[0];
            $optField = $arrField[0];
        }
        foreach ($arrayF  as $key => $value) {
            if(in_array($value[$id],$selected))
            	{
            		if($arr){		
				$str = "";	
				foreach($value as $k => $v){
					if(in_array($k,$arrField)){
					$str.=$v."&nbsp";
					}
				}
			$options.="<option id=".$id." value='".utf8_decode($value[$optValue])."' selected >".html_entity_decode(html_entity_decode(html_entity_decode(utf8_decode($str))))."</option>";	
			}
	   	else	{
				$options.="<option id=".$id." value='".utf8_decode($value[$optValue])."' selected >".html_entity_decode(html_entity_decode(html_entity_decode(utf8_decode($value[$optField]))))."</option>";
			} 
            	}
           else
            	{
            	if($arr){		
				$str = "";	
				foreach($value as $k => $v){
					if(in_array($k,$arrField)){
					$str.=$v."&nbsp";
					}
				}
			$options.="<option id=".$id." value='".utf8_decode($value[$optValue])."'  >".html_entity_decode(html_entity_decode(html_entity_decode(utf8_decode($str))))."</option>";	
			}
	   	else	{
				$options.="<option id=".$id." value='".utf8_decode($value[$optValue])."'  >".html_entity_decode(html_entity_decode(html_entity_decode(utf8_decode($value[$optField]))))."</option>";
			} ;
            	}

        }
        return $options;
    }
}
?>
