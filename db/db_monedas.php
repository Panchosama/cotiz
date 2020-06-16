<?php
    header('Content-Type: application/json');
//Preparamos la conexión con la base de datos
    $db = new mysqli('server', 'usuario', 'pass','db');

//Si se busca algo ejecutamos una querrá y devolvemos los resultados en son

    	$query = $db->query('SELECT m_nom as moneda FROM tipocambio');
    	$array = array();
   	 while($row = $query->fetch_object()){
        	$array[] = $row;
    	}
    	echo json_encode($array);
    
?>
