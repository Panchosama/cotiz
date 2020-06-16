<?php
    header('Content-Type: application/json');
 
//Preparamos la conexión con la base de datos
    $db = new mysqli('localhost', 'sistema', 'sistheli09','helicopters_intra');
 
//Si se busca algo ejecutamos una querrá y devolvemos los resultados en son
 
   if($_GET['ac'] != "" ){
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

    //busqueda para vista previa
    if($_GET['ac_view'] != ""){
        $query = $db->query('SELECT * FROM ac_modelo WHERE acmod_id='.$_GET['ac_view']);
        $array = array();
        while($row = $query->fetch_object()){
            $array[] = $row;
        }
        echo json_encode($array);
    }

    $db->close();
?>