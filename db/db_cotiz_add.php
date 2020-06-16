<?php
    header('Content-Type: application/json');
    
//Preparamos la conexión con la base de datos
    $db = new mysqli('localhost', 'sistema', 'sistheli09','helicopters_intra');

    $cotiz = json_decode(file_get_contents("php://input"));
    
//Ajuste de id
    $id = "";
    $q = $db->query("SELECT * FROM cotizacion WHERE cot_id LIKE '%".date('Y')."'");
    $cuenta=$q->num_rows;
//$cuenta=+1;
    $id = $cuenta + 1 ."/". date('Y');
//Se preparan los contadores de filas
    $filas_cot=0;
    $filas_cotac=0;
//Tipo de alojamiento
    if($cotiz->alojamiento=="Otro"){
        $aloj=$cotiz->otro;
    }else{
        $aloj=$cotiz->alojamiento;
    }

//Almacenado de cotización
//Tabla `cotizacion`
    $query = $db->query('INSERT INTO `cotizacion`(
            `cot_id`, 
            `cot_fecha`, 
            `cot_solicitante`, 
            `cot_empresa`, 
            `cot_email`, 
            `cot_fono`, 
            `cot_trabajo`, 
            `cot_fechavuelo`, 
            `cot_duracion`, 
            `cot_lugar`, 
            `cot_proyecto`, 
            `cot_alojamiento`, 
            `cot_base`, 
            `cot_camion`, 
            `cot_ferris`, 
            `cot_piloto`, 
            `cot_cga_inicio`, 
            `cot_cga_fin`, 
            `cot_resp_cli`, 
            `cot_resp_pago`, 
            `cot_descripcion`, 
            `cot_formapago`, 
            `cot_tiempovuelo`
            ) VALUES (
            "'.$id.'",
            "'.date('Y-m-d').'", 
            "'.$cotiz->solicitante.'",
            "'.$cotiz->empresa.'",
            "'.$cotiz->email.'",
            "'.$cotiz->telefono.'",
            "'.$cotiz->trabajo.'",
            "'.$cotiz->fechaVuelo.'",
            "'.$cotiz->duracion.'",
            "'.$cotiz->lugar.'",
            "'.$cotiz->proyecto.'",
            "'.$aloj.'",
            "'.$cotiz->base.'",
            "'.$cotiz->camion.'",
            "'.$cotiz->ferris.'",
            "'.$cotiz->piloto.'",
            "'.$cotiz->cga_inicio.'",
            "'.$cotiz->cga_fin.'",
            "'.$cotiz->resp_cli.'",
            "'.$cotiz->resp_pago.'",
            "'.$cotiz->descripcion.'",
            "'.$cotiz->formaPago.'",
            "'.$cotiz->tiempoVuelo.'"
    )') or die($db->error.__LINE__);
    
    $filas_cot = $db->affected_rows;

//Tabla `cotiz_ac`
    if($filas_cot!=0){
        for ($i=0;$i<count($cotiz->mod);$i++){
    //Capturo el valor de la nave
            $mod=$cotiz->mod[$i]; 
    //vuelvo el valor de la nave como un int para revisar los otros array
            $imod=intval($mod); 
    //Se hace la inserción en la db
            $query=$db->query("INSERT INTO cotiz_ac (cot_id, acmod_id, cotac_valorhv, cotac_monedahv, cotac_ivahv) VALUES ('".$id."', ".$imod.", '".$cotiz->valor->$imod."', '".$cotiz->mon->$imod."', '".$cotiz->iva->$imod."')") 
            or die($db->error.__LINE__);
        }
         $filas_cotac = $db->affected_rows;
    }

    if($filas_cotac!=0){
        echo "Cotizaci&oacute;n almacenada correctamente";
    }else{
        $error = $db->error.__LINE__;
        $query = $db->query("DELETE from cotizacion WHERE cot_id = '".$id."'");
        echo $error;
    }


?>