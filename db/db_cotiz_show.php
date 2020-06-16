<?php
    header('Content-Type: application/json');
//Preparamos la conexión con la base de datos
    $db = new mysqli('server', 'usuario', 'pass','db');

//Si se busca algo ejecutamos una querrá y devolvemos los resultados en json
//Buscar cotización específica
	if(isset($_GET['cotid']) && $_GET['cotid']!=""){
		$id=$_GET['cotid'];
		$q1= $db->query('SELECT * FROM cotizacion WHERE cot_id LIKE "'.$id.'"');
		$array=array();
		while($row = $q1->fetch_object()){
			$array[] = $row;
		}
		$q2=$db->query('SELECT * FROM cotiz_ac WHERE cot_id LIKE "'.$id.'"');
		$array2=array();
		while($row = $q2->fetch_object()){
			$array[] = $row;
		}
		echo json_encode($array);
	}else{
//Buscar todas las cotizaciones
		$query = $db->query('SELECT * FROM cotizacion');
		$array = array();
		while($row = $query->fetch_object()){
			$array[] = $row;
		}
		echo json_encode($array);
	}
   
?>
