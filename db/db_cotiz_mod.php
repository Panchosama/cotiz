<?php
header('Content-Type: application/json');
 
//Preparamos la conexión con la base de datos
    $db = new mysqli('server', 'usuario', 'pass','db');
 
//Recepción de los datos
    $cotiz = json_decode(file_get_contents("php://input"));
    $errores="";  

    //var_dump($cotiz->0);
//Borro registros antiguos
    $query1=$db->query("DELETE from cotiz_ac WHERE cot_id='".$cotiz[0]->cot_id."'") or die($errores .= $db->error.__LINE__);
    $borradas=$db->affected_rows;
    //var_dump($cotiz->2->valor);
//Ordeno la tabla
    if($borradas!=0){
      $query2=$db->query("ALTER TABLE cotiz_ac AUTO_INCREMENT=1") or die($errores .=$db->error.__LINE__);
      //var_dump($db->affected_rows);
  //Inserto Aeronaves
      for ($i=1; $i < count($cotiz) ; $i++) { 
          $query3=$db->query("INSERT INTO cotiz_ac (cot_id, acmod_id, cotac_valorhv, cotac_monedahv, cotac_ivahv) 
            VALUES ('".$cotiz[0]->cot_id."', ".$cotiz[$i]->modelo.", '".$cotiz[$i]->valor."', '".$cotiz[$i]->moneda."', '".$cotiz[$i]->iva."')") or die($errores .=$db->error.__LINE__);
          //var_dump($db->affected_rows);
      }
    }
//Formato de datos para almacenamiento

   $query4= "UPDATE cotizacion 
            SET cot_solicitante='".$cotiz[0]->cot_solicitante."',
                cot_empresa='".$cotiz[0]->cot_empresa."',
                cot_email='".$cotiz[0]->cot_email."',
                cot_fono='".$cotiz[0]->cot_fono."',
                cot_trabajo='".$cotiz[0]->cot_trabajo."',
                cot_fechavuelo='".$cotiz[0]->cot_fechavuelo."',
                cot_duracion='".$cotiz[0]->cot_duracion."',
                cot_lugar='".$cotiz[0]->cot_lugar."',
                cot_proyecto='".$cotiz[0]->cot_proyecto."',
                cot_alojamiento='".$cotiz[0]->cot_alojamiento."',
                cot_base='".$cotiz[0]->cot_base."',
                cot_camion='".$cotiz[0]->cot_camion."',
                cot_ferris='".$cotiz[0]->cot_ferris."',
                cot_piloto='".$cotiz[0]->cot_piloto."',
                cot_cga_inicio='".$cotiz[0]->cot_cga_inicio."',
                cot_cga_fin='".$cotiz[0]->cot_cga_fin."',
                cot_resp_cli='".$cotiz[0]->cot_resp_cli."',
                cot_resp_pago='".$cotiz[0]->cot_resp_pago."',
                cot_descripcion='".$cotiz[0]->cot_descripcion."',
                cot_formapago='".$cotiz[0]->cot_formapago."',
                cot_tiempovuelo='".$cotiz[0]->cot_tiempovuelo."' 
            WHERE cot_id like '".$cotiz[0]->cot_id."'";

//Actualizo datos tabla Cotización
    $res=$db->query($query4);
      
    //var_dump($res);

    $respuesta=array("ok"=>"","error"=>"");

    if($res){
        $respuesta["ok"]="Cotización modificada correctamente";
    }else{
        $respuesta["error"]=$db->errno.": ".$db->error;
    }
    
    echo json_encode($respuesta);


//Búsqueda de aeronave
 

   // if($_GET['cot'] != "" ){
   //      $query = $db->query('SELECT ac_id as id, 
   //      			    ac_matricula as mat 
   //      			    FROM aeronave 
   //      			    WHERE acmod_id ='.$_GET['ac']);
   //      $array = array();
   //      while($row = $query->fetch_object()){
   //          $array[] = $row;
   //      }
   //      echo json_encode($array);
   //  }



?>
