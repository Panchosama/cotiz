<?php
header('Content-Type: application/json');
 
//Preparamos la conexión con la base de datos
    $db = new mysqli('server', 'usuario', 'pass','db');
 
//Almacenado de cotización
 
   if($_GET['cot'] != "" ){
        $query = $db->query('SELECT ac_id as id, 
        			    ac_matricula as mat 
        			    FROM aeronave 
        			    WHERE acmod_id ='.$_GET['ac']);
        $array = array();
        while($row = $query->fetch_object()){
            $array[] = $row;
        }
        echo json_encode($array);
    }


?>
