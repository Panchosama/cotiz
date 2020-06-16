<?php
	session_start();
	$user=$_SESSION['idloged'];
?>
<div class="container-fluid" ng-init="show.userNow(<?php echo $user; ?>)">
	<script type="text/javascript">
		alert(show.user);
	</script>
	<div ng-if="show.ok">
		<div ng-if="show.msg_pdf">
		PDF Generado! <a class="btn btn-danger" href="pdf/{{show.newid}}.pdf" target="_blank"><i class="fa fa-pdf-o"></i> Ver</a><br />
		<a class="btn btn-default" href="#/"><i class="fa fa-chevron-circle-left"></i> Volver</a>
		</div>
		<div ng-if="show.msg_mail">
			Correo enviado <br />
			<a class="btn btn-default" href="#/"><i class="fa fa-chevron-circle-left"></i> Volver</a>
		</div>
	</div>
	<div class="botones">
		<br />
		<button class="btn btn-info" ng-click="show.firmar()" ng-if="(show.datos[0].cot_firmado == 0) && ((show.user==5)||(show.user==15))">
			<i ng-if="(show.datos[0].cot_firmado == 0) && ((show.user==5) || (show.user==15))" class="fa fa-check-square-o"></i> Firmar
		</button>&nbsp;&nbsp;
		<button class="btn btn-danger" ng-click="show.crearpdf()" ng-if="(show.ok==false) && (show.datos[0].cot_firmado == 1)">
			<i ng-if="(show.ok==false) && (show.datos[0].cot_firmado == 1)" class="fa fa-file-pdf-o"></i> Descargar PDF
		</button>&nbsp;&nbsp;
		<!---->
		<button class="btn btn-success" ng-click="show.enviarmail()" ng-if="(show.ok==false) && (show.datos[0].cot_firmado == 1) && (show.datos[0].cot_enviado==0)">
			<i ng-if="(show.ok==false) && (show.datos[0].cot_firmado == 1) && (show.datos[0].cot_enviado==0)" class="fa fa-send"></i> Enviar por correo
		</button>
		<!---->
		<br /><br />
	</div>
	<div id="cuerpo" class="row" ng-model="cot">
		<style type="text/css">
			td{
				padding:0 10px 2px 10px;
			}

			#tblAc> td, #tblAc>th{
				
				border: 1px solid #666;
			}
			#condiciones{
				text-size:8px;
			}


		</style>
		<table style="border:1px solid #000; table-layout:fixed; width:100%;" ng-if="show.ok==false">
			<thead>
		  		<tr>
		    		<th style="border:1px solid #000; padding: 5px; width:20%; text-align: center">
		    			<img src="logo_DAI.jpg" style="width: 80px; height: auto; text-align: center;" />
		    		</th>
					<th colspan="6" style="border:1px solid #000; text-align: center;"><h3>COTIZACION</h3></th>
					<td colspan="2" style="border:1px solid #000; text-align: center;">DAI-R-VEN-01</td>
		  		</tr>
			</thead>
			
			<tbody>
			  <tr>
			    <td colspan="4">Nº Cotizaci&oacute;n: <strong>{{show.datos[0].cot_id}}</strong></td>
			    <td colspan="5">Fecha: {{show.datos[0].cot_fecha}}</td>
			  </tr>
			  <tr>
			    <td colspan="4">Solicitada por: {{show.datos[0].cot_solicitante}}</td>
			    <td colspan="5">Empresa: {{show.datos[0].cot_empresa}}</td>
			  </tr>
			  <tr >
			    <td colspan="4">e-mail: {{show.datos[0].cot_email}}</td>
			    <td colspan="5">Tel&eacute;fono: {{show.datos[0].cot_fono}}</td>
			  </tr>
			  <tr >
			    <td colspan="9" style="border:1px solid #000;"><strong>Condiciones Generales</strong></td>
			  </tr>
			  <tr>
			    <td colspan="3">Descripci&oacute;n del trabajo: </td><td colspan="6">{{show.datos[0].cot_trabajo}}</td>
			  </tr>
			  <tr>
			    <td colspan="3">Fecha del vuelo:</td><td colspan="6"> {{show.fecha}}</td>
			  </tr>
			  <tr>
			    <td colspan="3">Duraci&oacute;n del trabajo:</td><td colspan="6"> {{show.datos[0].cot_duracion}}</td>
			  </tr>
			  <tr>
			    <td colspan="3">Tiempos de vuelo diarios:</td><td colspan="6"> {{show.datos[0].cot_tiempovuelo}}</td>
			  </tr>
			  <tr>
			    <td colspan="3">Lugar:</td><td colspan="6">{{show.datos[0].cot_lugar}}</td>
			  </tr>
			  <tr>
			    <td colspan="3">Proyecto:</td><td colspan="6">{{show.datos[0].cot_proyecto}}</td>
			  </tr>
			  <tr>
			    <td colspan="3">Alojamiento y alimentaci&oacute;n:</td><td colspan="6">{{show.aloj}}</td>
			  </tr>
			  <tr>
			    <td colspan="3">Base de inicio y t&eacute;rmino de la operaci&oacute;n:</td><td colspan="6">{{show.datos[0].cot_base}}</td>
			  </tr>
			  <tr>
			    <td colspan="3">Cami&oacute;n y combustible de la operaci&oacute;n:</td><td colspan="6">{{show.datos[0].cot_camion}}</td>
			  </tr>
			  <tr>
			    <td colspan="3">Traslado terrestre de la tripulaci&oacute;n:</td><td colspan="6">{{show.datos[0].cot_ferris}}</td>
			  </tr>
			  <tr>
			    <td colspan="9" style="border:1px solid #000;"><strong>Características de la(s) Aeronave(s)</strong></td>
			  </tr>
			  <tr>
			    <td colspan="9">
			    	<table id="tblAc" class="table table-stripped" style="table-layout:fixed; width:100%;">
			    		<thead>
			    			<tr >
								<td style="text-align:center"><strong>Aeronave</strong></td>
								<td style="text-align:center"><strong>Fabricante</strong></td>
								<td style="text-align:center"><strong>Autonom&iacute;a a nivel del mar</strong></td>
								<td style="text-align:center"><strong>Capacidad de Pasajeros</strong></td>
			    			</tr>
			    		</thead>
			    		<tbody>
			    			<tr ng-repeat="acd in show.ac track by acd.acmod_id" ng-if="show.acmod.contains(acd.acmod_id)">
			    				<td >{{acd.acmod_modelo}}</td>
			    				<td>{{acd.acmod_fabricante}}</td>
			    				<td style="text-align:center">{{acd.acmod_autonomia}}</td>
			    				<td>{{acd.acmod_pax}}</td>
			    			</tr>
			    		</tbody>
			    	</table>
			    </td>
			  </tr>
			  <tr>
			    <td colspan="9" style="border:1px solid #000;"><strong>Otros Antecedentes</strong></td>
			  </tr>
			  <tr>
			    <td colspan="9">
			    	<ol>
			    		<li><small>Empresa certificada ISO Integral para Trabajos Aereos, Transporte no Regular de Pasajeros, Mantenimiento y SMS.</small></li>
			    		<li><small>Las performances del helic&oacute;ptero permiten trasladar carga externa m&aacute;xima de 1026 kg. con 10&deg;C a 3300 m ó 10000 pies.</small></li>
			    		<li><small>Horas de vuelo m&aacute;ximas de un piloto sobre 10000 pies (3000 m) de altitud: 6 horas de vuelo. Bajo esta altitud, 8 horas de vuelo.</small></li>
			    		<li><small>Los valores por hora de vuelo podr&aacute;n disminuir en la medida que se conozca el plan de uso por mes.</small></li>
			    		<li><small>Durante el contrato, el cliente podr&aacute; usar una o m&aacute;s aeronaves seg&uacute;n su requerimiento y disponibilidad.</small></li>
			    		<li><small>El piloto que realizar&aacute; este trabajo aereo ser&aacute;: {{show.datos[0].cot_piloto}}<span ng-if="show.datos[0].cot_piloto=='' ">No Definido</span></small></li>
			    		<li><small>Lugar de toma de carga: {{show.datos[0].cot_cga_inicio}}<span ng-if="show.datos[0].cot_cga_inicio=='' ">No Aplica</span></small></li>
			    		<li><small>Lugar donde se colocar&aacute;n las cargas: {{show.datos[0].cot_cga_fin}}<span ng-if="show.datos[0].cot_cga_fin=='' ">No Aplica</span></small></li>
			    		<li><small>Responsable cliente en terreno: {{show.datos[0].cot_resp_cli}}<span ng-if="show.datos[0].cot_resp_cli=='' ">No Aplica</span></small></li>
			    		<li><small>Responsable del pago de los servicios: {{show.datos[0].cot_resp_pago}}<span ng-if="show.datos[0].cot_resp_pago=='' ">No Aplica</span></small></li>
			    	</ol>
			    </td>
			  </tr>
			  <tr>
			    <td colspan="9" style="border:1px solid #000;"><strong>Condiciones Econ&oacute;micas</strong></td>
			  </tr>
			  <tr>
			    <td colspan="9">
			    	<table id="tblcosto" class="table table-stripped" style="table-layout:fixed; ">
			    		<thead>
			    			<tr >
								<td style="text-align:center"><strong>Aeronave</strong></td>
								<td style="text-align:center"><strong>Valor hora de vuelo</strong></td>
																
			    			</tr>
			    		</thead>
			    		<tbody>
			    			<tr ng-repeat="c in show.costos track by c.cotac_id">
			    				<td>{{c.modelo}}</td>
			    				<td>{{c.cotac_valorhv}} {{c.cotac_monedahv}} {{c.cotac_ivahv}}</td>
			    			</tr>
			    		</tbody>
			    	</table>
			    </td>
			  </tr>
			  <tr>
			    <td colspan="2">Forma de pago: </td>
			    <td colspan="7">{{show.datos[0].cot_formapago}}</td>
			  </tr>
			  <tr>
			    <td colspan="9" style="border:1px solid #000;"><strong>Descripci&oacute;n del trabajo</strong></td>
			  </tr>
			  <tr>
			    <td colspan="9">{{show.datos[0].cot_descripcion}}</td>
			  </tr>
			  <tr>
			    <td colspan="9" style="border:1px solid #000;"><strong>Condiciones</strong></td>
			  </tr>
			  <tr>
			    <td colspan="9">
			    	<ul id="condiciones">
			    		<li><small>Los lugares asignados para trabajar por el cliente deber&aacute;n reunir todas las caracter&iacute;sticas que permitan una operaci&oacute;n segura al despegue y aterrizaje, contar con un helipuerto adecuado y con seguridad durante su permanencia en &eacute;l.</small></li>
			    		<li><small>Las horas de vuelo para el traslado o ferry para este trabajo tienen el mismo valor.</small></li>
			    		<li><small><em>Discovery Air Chile</em> no se hace responsable si por decisi&oacute;n del cliente &eacute;ste decide permanecer en un lugar y luego las condiciones atmosf&eacute;ricas impiden o dificultan su posterior traslado.</small></li>
			    		<li><small><em>Discovery Air Chile</em> cuenta con la totalidad de seguros exigidos por la Legislaci&oacute;n Nacional considerando tambi&eacute;n seguros por responsabilidad civil a terceros de hasta US$ 30.000.000 por cada evento.</small></li>
			    		<li><small>En el caso de transportes de carga externa contamos con un seguro por da&ntilde;os hasta US$ 1.000.000 con u deducible de US$ 2.500 con cargo al cliente.</small></li>
			    	</ul>
			    </td>
			  </tr>
			  <tr>
			    <td colspan="5">
			    	Atentamente,<br />
			    	<img src="firma_ai_timbre_dai_transp.png" style="width:150px; height: auto;" ng-if="show.datos[0].cot_firmado == 1"> 
			    	<span ng-if="show.datos[0].cot_firmado == 0"><s>FALTA APROBACION PARA FIRMA</s></span><br />
			    	Alvaro Irigoyen<br />
			    	Gerente General<br />
			    	<a href="mailto:airigoyen@discoveryair.cl">airigoyen@discoveryair.cl</a><br />
			    	<a href="http://www.discoveryair.cl">www.discoveryair.cl</a><br />
			    	Celular : (56-9) 813 99395<br />
			    	Tel&eacute;fono: (56) 722 216 555 (Rancagua)


			    </td>
			    <td colspan="4" style="text-align:right; vertical-align: bottom; ">
			    	<img src="iso_logo.png" style="width:120px; height:auto;" />
			    </td>
			  </tr>

			</tbody>
			
		</table>

	</div>
	<div class="botones">
		<br />
		<button class="btn btn-info" ng-click="show.firmar()" ng-if="(show.datos[0].cot_firmado == 0) && ((show.user==5) || (show.user==15))">
			<i ng-if="(show.datos[0].cot_firmado == 0) && ((show.user==5) || (show.user==15))" class="fa fa-check-square-o"></i> Firmar
		</button>&nbsp;&nbsp;
		<button class="btn btn-danger" ng-click="show.crearpdf()" ng-if="(show.ok==false) && (show.datos[0].cot_firmado == 1) ">
			<i ng-if="(show.ok==false) && (show.datos[0].cot_firmado == 1) " class="fa fa-file-pdf-o"></i> Descargar PDF
		</button>&nbsp;&nbsp;
		<!-- -->
		<button class="btn btn-success" ng-click="show.enviarmail()" ng-if="(show.ok==false) && (show.datos[0].cot_firmado == 1) && (show.datos[0].cot_enviado==0)">
			<i ng-if="(show.ok==false) && (show.datos[0].cot_firmado == 1) && (show.datos[0].cot_enviado==0)" class="fa fa-send"></i> Enviar por correo
		</button>
		<!-- -->
	</div>
</div>

