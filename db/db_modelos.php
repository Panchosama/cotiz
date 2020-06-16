<?php
    header('Content-Type: application/json');
//Preparamos la conexión con la base de datos
    $db = new mysqli('server', 'usuario', 'pass','db');

//Si se busca algo ejecutamos una querrá y devolvemos los resultados en son

//Búsqueda de nave específica
    if(isset($_GET['mod'])){
    	$query = $db->query('SELECT * 
    			     FROM ac_modelo 
    			     where acmod_id='.$_GET["modelo"]);
    	$array = array();
   	    while($row = $query->fetch_object()){
        	$array[] = $row;
    	}
    	echo json_encode($array);

//Búsqueda de naves para presentación
    }elseif (isset($_GET['modelos'])){
        $mod[]=json_decode($_GET['modelos']);
        $row=array();
        $array=array();

        foreach($mod as $m){
            $query = $db->query('SELECT * FROM ac_modelo where acmod_id='.(int)$m);

            while($row = $query->fetch_object()){
                //var_dump($row);
                array_push($array, $row);
            }
        }

        echo json_encode($array);

//Opción de llamado sin GET
    }else {
    	$query = $db->query('SELECT * FROM ac_modelo');
    	$array = array();
   	    while($row = $query->fetch_object()){
        	$array[] = $row;
    	}
    	echo json_encode($array);
    }

//Búsqueda para vista previa

    
?>
