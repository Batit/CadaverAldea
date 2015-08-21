<?php
require_once('class/settings/MySqlModel.class.php');
require_once('class/settings/Sentences.class.php');
class Cadaver 
{
	private $cnn;
	private $table = "cadaver";
	function __construct()
	{
		$this->cnn = new MySqlModel();
		$this->cnn->connect();
	}

	private function getFilterColaborador($value='')
	{
		if($value == ""){
			return false;
		}
		$sentence = "SELECT * FROM comentarios
		INNER JOIN comentarios_has_cadaver ON
		comentarios_has_cadaver.comentarios_id = 
		comentarios.id WHERE colaborador = '" . $value ."'";
		$result = $this->cnn->excecuteSelect($sentence); 
		array_pop($result);
		if($result == 0){
			return false;
		}
		$filter = "cadaver_id = " . $result[0]['cadaver_id'];
		unset($result[0]);
		if(count($result) > 1){
			foreach ($variable as $key => $value) {
				$filter .= " AND cadaver_id =" . $value['cadaver_id'];
			}
		}
		return $filter;
	}
	public function order($array)
	{		
		$counter	= 0;
		$limit 		= 30;
		$result 	= array();
		$current_c	= 0;
		foreach ($array as $key => $value) {
			if($current_c == 0){
				$current_c = $value['cadaver_id'];
				$counter ++;
			}else if($current_c != $value['cadaver_id']){
				$current_c = $value['cadaver_id'];
				$counter ++;
			}
			if($counter == $limit){
				break;
			}
			$result[] = $value;
		}
		return $result;
	}
	public function getData($values) {     
		$filter = "cadaver.estado = '1'";    
		if(isset($values['id'])){ 
			$filter = "cadaver.id = ". $values['id'] ;
		}elseif (isset($values['limit'])) {
			$order = "";
		}elseif (isset($values['colaborador'])) {
			$filter = $this->getFilterColaborador($values['colaborador']);
		} 
		$sentence = "SELECT * FROM comentarios
		INNER JOIN comentarios_has_cadaver ON
		comentarios_has_cadaver.comentarios_id = comentarios.id INNER
		JOIN cadaver ON comentarios_has_cadaver.cadaver_id =
		cadaver.id INNER JOIN plantillas ON cadaver.plantillas_id =
		plantillas.id WHERE " . $filter . " GROUP BY comentarios.id  ORDER BY  `comentarios`.`fecha` DESC " . $order; 
		$result = $this->cnn->excecuteSelect($sentence); 
		array_pop($result);
		$result = $this->order($result);
		echo json_encode($result); 
	}

	public function search() {
	}

	public function setData($values)
	{
		$sentence = "INSERT INTO `batitco_cadaver`.`comentarios` (comentario, colaborador, fecha) VALUES ( '" . utf8_encode($values['comentario']) . "', '" . $values['colaborador'] . "', '" . $values['fecha'] . "' )";
		$result = $this->cnn->excecute($sentence);
	}
}
$cv = new Cadaver();
if(!empty($_POST)){
	$ban = false;
	if(isset($_POST['collaborador'])){
		$data = $_POST['collaborador'];
		unset($_POST['collaborador']);
		$_POST['colaborador'] = $data;
		$_POST['fecha'] = date("Y-m-d H:i:s");
		$ban = true;
	}
	$cv->setData($_POST);
	if($ban){
		header('Location: /index.html');
	}
} else if(!empty($_GET)){
	$cv->getData($_GET);
}
?>