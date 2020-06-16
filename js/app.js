angular
	.module('cotizaciones',['ngRoute'])
// RUTAS
	.config(function($routeProvider) {
		$routeProvider
			.when('/',{
				controller:'listCtrl',
				controllerAs:'list',
				templateUrl:'pages/cot_list.php'
			})
			.when('/crearCot',{
				controller:'makeCtrl',
				controllerAs:'crea',
				templateUrl:'pages/cot_crea.php'
			})
			.when('/editarCot/:idcot*',{
				controller:'editCtrl',
				controllerAs: 'edit',
				templateUrl: 'pages/cot_edit.php'
			})
			.when('/mostrarCot/:idcot*',{
				controller:'showCtrl',
				controllerAs:'show',
				templateUrl:'pages/cot_ver.php'
			})
	})

// CONTROLADORES
//Controlador de navegación
	.controller('navCtrl',function($location){
        var map=this;
        map.estoy=function(ruta){
            return $location.path() == ruta;
        }
    })

//Controlador Listado
    .controller('listCtrl',function($http){
    	var list= this;
    //Busca todas las cotizaciones en la DB
    	$http.get("db/db_cotiz_show.php")
            .success(function(res){
                list.cotiz=res;
        })
    //Firmar cotizacion
            
    })

//Controlador creación
    .controller('makeCtrl',function($http){
    	var mcot=this;
    	mcot.datos={}; //Variable que almacena la cotización nueva
    	mcot.mod={}; //Variable para amacenar precios y modelos de aeronaves seleccionados

    //Busca modelos de aeronaves
        $http.get("db/db_modelos.php")
            .success(function(response){
                mcot.modelos=response;
            });
    //Busca tipo de cambio
        $http.get("db/db_monedas.php")
            .success(function(res){
                mcot.monedas=res;
            })  
    //Almacenado de formulario

        mcot.guardaCot = function(){
            $http.post("db/db_cotiz_add.php", mcot.datos)
            .success(function(response){
    			mcot.ok=true;
                mcot.respuesta=response;
                mcot.valid=true;
            })
            .error(function(response){
    			mcot.ok=true;
                mcot.respuesta=response;
                mcot.valid=false;
            });
        };
    })

//Controlador edición
    .controller('editCtrl',function($http,$routeParams){
    	var edit=this;
        edit.respuesta="";
        edit.ok=false;
        edit.valid=false;
    	edit.idsel=$routeParams.idcot; //Es el ID de la cotización (cot_id) a editar. 
    	edit.datos={}; //Almacena los datos de la tabla cotizacion en JSON, para editar
      
        //Estas variables almacenan lo recuperado de la tabla cotiz_ac
        edit.mod=[];
        edit.valor={};
        edit.iva={};
        edit.moneda={};

    //Buscar cotización específica
    	$http({url: "db/db_cotiz_show.php", 
            method: "GET",
            params: {cotid: edit.idsel}
            }).success(function(response) {
              edit.datos = response;
              datos=edit.datos;
            
            //Estandarizado la fecha
              if(edit.datos[0].cot_fechavuelo!='0000-00-00'){
                edit.datos[0].cot_fechavuelo = new Date(edit.datos[0].cot_fechavuelo);
              }else{
                  edit.datos[0].cot_fechavuelo="";
                  document.getElementById('fechaVuelo').disabled=true;
              }
              
            //Relleno las naves y los valores por cada una
              for(var i=1;i<=edit.datos.length-1;i++){
            	  edit.mod.push(edit.datos[i].acmod_id);
                  edit.valor[edit.datos[i].acmod_id]=parseInt(edit.datos[i].cotac_valorhv);
                  edit.moneda[edit.datos[i].acmod_id]=edit.datos[i].cotac_monedahv;
                  edit.iva[edit.datos[i].acmod_id]=edit.datos[i].cotac_ivahv;
              };
        });

	//Busca modelos de aeronaves
		$http.get("db/db_modelos.php")
		.success(function(response){
		    edit.modelos=response;
		});
	//Busca tipo de cambio
		$http.get("db/db_monedas.php")
		.success(function(res){
		    edit.monedas=res;
		})  

        edit.editar=function(){
        /*  Preparo los datos a enviar.
            cot va a contener los datos del json 0 en el array de datos
            merged va a ser el resultado a enviar. merged es un array
        */
            var cot = angular.copy(edit.datos[0]);
            var merged=[];
        /*
            Inserto los datos en merged. 
            Primero cot, y luego cada aeronave resumida en ac
        */
            for(var i=1;i<=edit.mod.length;i++){
                 var mod=edit.mod[i-1];
                 var ac={};
                 ac.modelo=mod;
                 ac.valor=edit.valor[mod];
                 ac.iva=edit.iva[mod];
                 ac.moneda=edit.moneda[mod];
                 if (i===1){
                    merged.push(cot);
                 } 
                 merged.push(ac);
            }

            $http.post("db/db_cotiz_mod.php", merged)
            .success(function(response) {
                if(response.ok!=""){
                    edit.respuesta = response.ok;
                    edit.ok=true;
                    edit.valid=true;
                }else{
                    edit.respuesta = response.error;
                    edit.ok=true;
                    edit.valid=false;
                }
              
            })
        }

    })

//Controlador Vista Previa
    .controller('showCtrl', function($http,$routeParams){
        var show = this;
        show.idsel=$routeParams.idcot; // ID de la cotización
        show.datos={};
        show.newid="";
        show.ok=false;
        show.msg_mail=false;
        show.msg_pdf=false;
        show.fecha="";
        show.aloj="";
        show.acmod=[]; //Array de id de modelos deaeronaves tomadas
        show.ac={}; //Regreso de datos aeronaves
        show.costos=[]; //Array de costos por ID
        show.user=0;
       //Almaceno el usuario con sesión
        show.userNow=function(id){
            show.user=id;
        }
    
    //Buscar cotización específica
        $http({url: "db/db_cotiz_show.php", 
            method: "GET",
            params: {cotid: show.idsel}
            }).success(function(response) {
              show.datos = response;
                if(show.datos[0].cot_fechavuelo!='0000-00-00'){
                    show.fecha=show.datos[0].cot_fechavuelo;
                }else{
                    show.fecha="Por Confirmar";
                }

                if (show.datos[0].cot_alojamiento=='Cliente'){
                    show.aloj="Con cargo al Cliente";
                }else if(show.datos[0].cot_alojamiento=='Empresa'){
                    show.aloj="Con cargo a la Empresa";
                }else{
                    show.aloj=show.datos[0].cot_alojamiento;
                }

                for(var i=1;i<=show.datos.length-1;i++){
                   show.acmod.push(show.datos[i].acmod_id);
                };

                for(var i=1;i<=show.datos.length-1;i++){
                   show.costos.push(show.datos[i]);
                   switch(show.datos[i].acmod_id){
                        case "1":
                            show.datos[i].modelo="AS-350 B2";
                            break;
                        case "2":
                            show.datos[i].modelo="AS-350 B3";
                            break;
                        case "3":
                            show.datos[i].modelo="Bell 212";
                            break;
                        case "4":
                            show.datos[i].modelo="Bell B-205 A-1";
                            break;
                        case "5":
                            show.datos[i].modelo="Bell UH-1H";
                            break;
                        case "6":
                            show.datos[i].modelo="Bell 209 Cobra";
                            break;
                   }
                };

                $http.get("db/db_modelos.php", {modelos: show.acmod})
                .success(function(res) {
                    show.ac=res;
                })
        })

        show.firmar=function(){
            $http({url:"db/db_firmar.php",
                method:"GET",
                params: {id: show.datos[0].cot_id}
            }).success(function(res){
                show.datos[0].cot_firmado=res;
            })
        }

        
        show.crearpdf=function(){
            show.newid = show.datos[0].cot_id.replace('/', '_');
            $http({url: "pdf/savePDF.php",
                method: "GET",
                params: {div: document.getElementById('cuerpo').innerHTML,
                         id: show.newid}
            }).success(function(response){
                //alert(response);
                show.ok=true;
                show.msg_pdf=true;
                window.location.href="pdf/"+show.newid+".pdf";
            });
        };

        show.enviarmail=function(){
            show.newid = show.datos[0].cot_id.replace('/', '_');
            $http({url: "pdf/savePDF.php",
                method: "GET",
                params: {div: document.getElementById('cuerpo').innerHTML,
                         id: show.newid,
                         mail:show.datos[0].cot_email}
            }).success(function(response){
                //alert(response);
                show.ok=true;
                show.msg_mail=true;
                //location.href="pdf/"+show.datos[0].cot_id+".pdf";
            });
        }

    })

//Reviso contenido de array modelos para activar el precio x hora
Array.prototype.contains = function(element) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] == element) {
            return true;
        }
    }
    return false;
};

// Compara arrays
Array.prototype.equals = function (array) {
    // if the other array is a falsy value, return
    if (!array)
        return false;

    // compare lengths - can save a lot of time 
    if (this.length != array.length)
        return false;

    for (var i = 0, l=this.length; i < l; i++) {
        // Check if we have nested arrays
        if (this[i] instanceof Array && array[i] instanceof Array) {
            // recurse into the nested arrays
            if (!this[i].equals(array[i]))
                return false;       
        }           
        else if (this[i] != array[i]) { 
            // Warning - two different object instances will never be equal: {x:20} != {x:20}
            return false;   
        }           
    }       
    return true;
}   