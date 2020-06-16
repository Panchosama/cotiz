<?php
    header('Content-Type: application/json');
//Preparamos la conexión con la base de datos
    $db = new mysqli('server', 'usuario', 'pass','db');
    
    $id=$_GET['id'];
//Si se busca algo ejecutamos una querrá y devolvemos los resultados en son

    $db->query('UPDATE cotizacion SET cot_firmado=1 WHERE cot_id="'.$id.'"');
    if ($db->affected_rows > 0){
    	echo 1;
    }else{
    	echo 0;
    };

    	
    
?>
