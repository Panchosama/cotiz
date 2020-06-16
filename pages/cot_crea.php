<!-- <div>
	<h2>Acá se crean cada una de las cotizaciones</h2>
	Hola, mundo!!!
	<br />
	<a class="btn btn-default"  href="#/">Listado de Cotizaciones</a>
<a href="#/crearCot/">Nueva Cotizaci&oacute;n</a><a class="btn btn-default"  href="#/editarCot/">Editar Cotizaci&oacute;n</a>
<a class="btn btn-default"  href="#/mostrarCot/">Mostrar Cotizaci&oacute;n</a>
</div> -->

<div class="container-fluid" >
	<div id="cuerpo" class="row">
		<div id="contenido">
			<div id="form" ng-hide="crea.ok">
				<form id="cotizacion" name="cotizacion" class="form-horizontal" ng-submit="crea.guardaCot()" >
					<legend>Crear Cotizaci&oacute;n Nueva</legend>

					<u><h4>Datos del Cliente</h4></u>
					<div class="form-group has-feedback" ng-class="{'has-error':!cotizacion.solicitante.$pristine && cotizacion.solicitante.$invalid}">
						<label for="solicitante" class="col-sm-3 control-label">* Solicitado por</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" id="solicitante" name="solicitante" ng-model="crea.datos.solicitante" ng-required="true" />
							<span ng-if="!cotizacion.solicitante.$pristine && cotizacion.solicitante.$invalid" class="fa fa-remove form-control-feedback"></span>
							<span ng-if="!cotizacion.solicitante.$pristine && cotizacion.solicitante.$invalid" class="help-block">Ingrese nombre del solicitante</span>
						</div>
					</div>
					<div class="form-group has-feedback" ng-class="{'has-error':!cotizacion.empresa.$pristine && cotizacion.empresa.$invalid}">
						<label for="empresa" class="col-sm-3 control-label">* Empresa</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" id="empresa" name="empresa" ng-model="crea.datos.empresa" ng-required="true" />
							<span ng-if="!cotizacion.empresa.$pristine && cotizacion.empresa.$invalid" class="fa fa-remove form-control-feedback"></span>
							<span ng-if="!cotizacion.empresa.$pristine && cotizacion.empresa.$invalid" class="help-block">Ingrese empresa representada</span>
						</div>
					</div>
					<div class="form-group has-feedback"  ng-class="{'has-error':!cotizacion.telefono.$pristine && cotizacion.telefono.$invalid}">
						<label for="telefono" class="col-sm-3 control-label">* Tel&eacute;fono</label>
						<div class="col-sm-6">
							<input type="tel" placeholder="Ej: +56722216555" pattern="[\u002B]{0,1}[0-9]{1,}" class="form-control input-sm" id="telefono" name="telefono" ng-required="true" ng-model="crea.datos.telefono" />
							<span ng-if="!cotizacion.telefono.$pristine && cotizacion.telefono.$invalid" class="fa fa-remove form-control-feedback"></span>
							<span ng-if="!cotizacion.telefono.$pristine && cotizacion.telefono.$invalid" class="help-block">Use el formato correcto</span>
							<p class="help-block">A&ntilde;ada s&oacute;lo n&uacute;meros y/o el signo +.</p>
						</div>
					</div>
					<div class="form-group has-feedback"  ng-class="{'has-error':!cotizacion.email.$pristine && cotizacion.email.$invalid}">
						<label for="email" class="col-sm-3 control-label" >* e-Mail</label>
						<div class="col-sm-6">
							<input type="email" class="form-control input-sm" id="email" name="email" ng-model="crea.datos.email" ng-required="true" placeholder="ejemplo@email.com"/>
							<span ng-if="!cotizacion.email.$pristine && cotizacion.email.$invalid" class="fa fa-remove form-control-feedback"></span>
							<span ng-if="!cotizacion.email.$pristine && cotizacion.email.$invalid" class="help-block">Use el formato correcto</span>
						</div>
					</div>
					<u><h4>Datos de la Operaci&oacute;n</h4></u>
					<div class="form-group">
						<label for="mod" class="col-sm-3 control-label">Modelo de Aeronave</label>
						<div class="col-sm-6">
							<select multiple id="mod" class="form-control input-sm" name="mod" ng-init="0" size="7" ng-model="crea.datos.mod">
								<option value="0" disabled >Use Ctrl + click para seleccionar varios</option>
							 	<option ng-repeat="modelo in crea.modelos" value="{{modelo.acmod_id}}">{{modelo.acmod_modelo}}</option>
					  		</select>
					  	</div>
					</div>
					<div class="form-group">
						<label for="trabajo" class="col-sm-3 control-label">Trabajo a realizar</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" id="trabajo" name="trabajo" ng-model="crea.datos.trabajo" />
						</div>
					</div>
					<div class="form-group">
						<label for="descripcion" class="col-sm-3 control-label">Descripci&oacute;n del trabajo</label>
						<div class="col-sm-6">
							<textarea placeholder="Describa el trabajo a realizar" rows="4" class="form-control input-sm" id="descripcion" name="descripcion" ng-model="crea.datos.descripcion" />
							</textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="fechaVuelo" class="col-sm-3 control-label">Fecha del Vuelo</label>
						<div class="row col-sm-6">
							<div class="col-sm-6">
								<input type="date" class="form-control input-sm" placeholder="dd-mm-aaaa" id="fechaVuelo" name="fechaVuelo" ng-disabled="crea.datos.pc" ng-model="crea.datos.fechaVuelo" />
							</div>
							<div class="checkbox col-sm-6">
								<label>
									<input type="checkbox" ng-model="crea.datos.pc" id="pc" value="" /> Por confirmar
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="duracion" class="col-sm-3 control-label">Duraci&oacute;n del trabajo</label>
						<div class="col-sm-6"><input type="text" class="form-control input-sm" id="duracion" name="duracion" ng-model="crea.datos.duracion" />
					</div></div>
					<div class="form-group">
						<label for="tiempoVuelo" class="col-sm-3 control-label">Tiempos de vuelo diarios</label>
						<div class="col-sm-6"><input type="text" class="form-control input-sm" id="tiempoVuelo" name="tiempoVuelo" ng-model="crea.datos.tiempoVuelo" />
					</div></div>
					<div class="form-group">
						<label for="lugar" class="col-sm-3 control-label">Lugar de la operaci&oacute;n</label>
						<div class="col-sm-6"><input type="text" class="form-control input-sm" id="lugar" name="lugar" ng-model="crea.datos.lugar" />
					</div></div>
					<div class="form-group">
						<label for="proyecto" class="col-sm-3 control-label">Proyecto</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" id="proyecto" name="proyecto" ng-model="crea.datos.proyecto" />
						</div>
					</div>
					<div class="form-group">
						<label for="alojamiento" class="col-sm-3 control-label">Alojamiento y alimentaci&oacute;n</label>
						<div class="row col-sm-6">
							<div class="col-sm-6">
								<select id="alojamiento" class="form-control input-sm" name="alojamiento" ng-model="crea.datos.alojamiento" ng-init="0">
								 	<option value="Cliente">Con cargo al cliente</option>
							  		<option value="Empresa">Con cargo de la empresa</option>
							  		<option value="Otro">Otro</option>
						  		</select>
						  	</div>
						  	<div class="col-sm-6">
					  			<input type="text" class="form-control input-sm col-sm-3" placeholder="Describa" ng-if="datos.alojamiento == 'Otro'" ng-model="crea.datos.otro">
					  		</div>
						</div>
					</div>
					<div class="form-group">
						<label for="base" class="col-sm-3 control-label">Base inicio y t&eacute;rmino de la operaci&oacute;n</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" id="base" name="base" ng-model="crea.datos.base" />
						</div>
					</div>

					<div class="form-group">
						<label for="camion" class="col-sm-3 control-label">Cami&oacute;n de combustible de aviaci&oacute;n</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" id="camion" name="camion" ng-model="crea.datos.camion" />
						</div>
					</div>
					<div class="form-group">
						<label for="ferris" class="col-sm-3 control-label">Ferris de traslado de helic&oacute;ptero</label>
						<div class="col-sm-6">
							<input type="text" class="form-control input-sm" id="ferris" name="ferris" ng-model="crea.datos.ferris" />
						</div>
					</div>
					<div class="form-group">
						<label for="valor" class="col-sm-3 control-label">Valor hora de vuelo de trabajo</label>
						
						<div class="row col-sm-10" ng-if="crea.datos.mod.contains(1)==true">
							<div class="col-sm-3">
								<span class="ac"/>AS 350-B2</span>
							</div>
							<div class="col-sm-3">
								<input type="number" class="form-control input-sm" id="valor" name="valor" ng-model="crea.datos.valor[1]" />
							</div>
							<div class="col-sm-3">
								<select id="mon" class="form-control input-sm" name="mon" ng-model="crea.datos.mon[1]" ng-init="1" >
								 	<option ng-repeat="moneda in crea.monedas" value="{{moneda.moneda}}">{{moneda.moneda}}</option>
					  			</select>
							</div>
							<div class="col-sm-3">
								<select id="iva" class="form-control input-sm" name="iva" ng-model="crea.datos.iva[1]">
								 	<option value="+ IVA">+ IVA</option>
								 	<option value="IVA Inc.">IVA incluido</option>
								 	<option value="Exento">Exento</option>
					  			</select>
							</div>
						</div>
						
						<div class="row col-sm-10" ng-if="crea.datos.mod.contains(2)==true">
							<div class="col-sm-3">
								<span class="ac"/>AS 350-B3</span>
							</div>
							<div class="col-sm-3">
								<input type="number" class="form-control input-sm" id="valor" name="valor" ng-model="crea.datos.valor[2]" />
							</div>
							<div class="col-sm-3">
								<select id="mon" class="form-control input-sm" name="mon" ng-model="crea.datos.mon[2]" ng-init="1" >
								 	<option ng-repeat="moneda in crea.monedas" value="{{moneda.moneda}}">{{moneda.moneda}}</option>
					  			</select>
							</div>
							<div class="col-sm-3">
								<select id="iva" class="form-control input-sm" name="iva" ng-model="crea.datos.iva[2]">
								 	<option value="+ IVA">+ IVA</option>
								 	<option value="IVA Inc.">IVA incluido</option>
								 	<option value="Exento">Exento</option>
					  			</select>
							</div>
						</div>
						<div class="row col-sm-10" ng-if="crea.datos.mod.contains(3)==true">
							<div class="col-sm-3">
								<span class="ac"/>Bell 212</span>
							</div>
							<div class="col-sm-3">
								<input type="number" class="form-control input-sm" id="valor" name="valor" ng-model="crea.datos.valor[3]" />
							</div>
							<div class="col-sm-3">
								<select id="mon" class="form-control input-sm" name="mon" ng-model="crea.datos.mon[3]" ng-init="1" >
								 	<option ng-repeat="moneda in crea.monedas" value="{{moneda.moneda}}">{{moneda.moneda}}</option>
					  			</select>
							</div>
							<div class="col-sm-3">
								<select id="iva" class="form-control input-sm" name="iva" ng-model="crea.datos.iva[3]">
								 	<option value="+ IVA">+ IVA</option>
								 	<option value="IVA Inc.">IVA incluido</option>
								 	<option value="Exento">Exento</option>
					  			</select>
							</div>
						</div>
						<div class="row col-sm-10" ng-if="crea.datos.mod.contains(4)==true">
							<div class="col-sm-3">
								<span class="ac"/>Bell B-205 A-1</span>
							</div>
							<div class="col-sm-3">
								<input type="number" class="form-control input-sm" id="valor" name="valor" ng-model="crea.datos.valor[4]" />
							</div>
							<div class="col-sm-3">
								<select id="mon" class="form-control input-sm" name="mon" ng-model="crea.datos.mon[4]" ng-init="1" >
								 	<option ng-repeat="moneda in crea.monedas" value="{{moneda.moneda}}">{{moneda.moneda}}</option>
					  			</select>
							</div>
							<div class="col-sm-3">
								<select id="iva" class="form-control input-sm" name="iva" ng-model="crea.datos.iva[4]">
								 	<option value="+ IVA">+ IVA</option>
								 	<option value="IVA Inc.">IVA incluido</option>
								 	<option value="Exento">Exento</option>
					  			</select>
							</div>
						</div>
						<div class="row col-sm-10" ng-if="crea.datos.mod.contains(5)==true">
							<div class="col-sm-3">
								<span class="ac"/>Bell UH-1H</span>
							</div>
							<div class="col-sm-3">
								<input type="number" class="form-control input-sm" id="valor" name="valor" ng-model="crea.datos.valor[5]" />
							</div>
							<div class="col-sm-3">
								<select id="mon" class="form-control input-sm" name="mon" ng-model="crea.datos.mon[5]" ng-init="1" >
								 	<option ng-repeat="moneda in crea.monedas" value="{{moneda.moneda}}">{{moneda.moneda}}</option>
					  			</select>
							</div>
							<div class="col-sm-3">
								<select id="iva" class="form-control input-sm" name="iva" ng-model="crea.datos.iva[5]">
								 	<option value="+ IVA">+ IVA</option>
								 	<option value="IVA Inc.">IVA incluido</option>
								 	<option value="Exento">Exento</option>
					  			</select>
							</div>
						</div>
						<div class="row col-sm-10" ng-if="crea.datos.mod.contains(6)==true">
							<div class="col-sm-3">
								<span class="ac"/>Bell 209 Cobra</span>
							</div>
							<div class="col-sm-3">
								<input type="number" class="form-control input-sm" id="valor" name="valor" ng-model="crea.datos.valor[6]" />
							</div>
							<div class="col-sm-3">
								<select id="mon" class="form-control input-sm" name="mon" ng-model="crea.datos.mon[6]" ng-init="1" >
								 	<option ng-repeat="moneda in crea.monedas" value="{{moneda.moneda}}">{{moneda.moneda}}</option>
					  			</select>
							</div>
							<div class="col-sm-3">
								<select id="iva" class="form-control input-sm" name="iva" ng-model="crea.datos.iva[6]">
								 	<option value="+ IVA">+ IVA</option>
								 	<option value="IVA Inc.">IVA incluido</option>
								 	<option value="Exento">Exento</option>
					  			</select>
							</div>
						</div>
					</div>
						<div class="form-group">
						<label for="formaPago" class="col-sm-3 control-label">Forma de pago</label>
						<div class="col-sm-6">
							<textarea placeholder="Describa la forma de pago" rows="3" class="form-control input-sm" id="formaPago" name="formaPago" ng-model="crea.datos.formaPago" />
							</textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="piloto" class="col-sm-3 control-label">Nombre del piloto responsable</label>
						<div class="col-sm-6">
							<input type="text" placeholder="No aplica" class="form-control input-sm" id="piloto" name="piloto" ng-model="crea.datos.piloto" />
						</div>
					</div>
					<div class="form-group">
						<label for="cga_inicio" class="col-sm-3 control-label">Lugar de toma de carga</label>
						<div class="col-sm-6">
							<input type="text" placeholder="No aplica" class="form-control input-sm" id="cga_inicio" name="cga_inicio" ng-model="crea.datos.cga_inicio" />
						</div>
					</div>
					<div class="form-group">
						<label for="cga_fin" class="col-sm-3 control-label">Lugar donde se colocar&aacute;n las cargas</label>
						<div class="col-sm-6">
							<input type="text" placeholder="No aplica" class="form-control input-sm" id="cga_fin" name="cga_fin" ng-model="crea.datos.cga_fin" />
						</div>
					</div>
					<div class="form-group">
						<label for="resp_cli" class="col-sm-3 control-label">Responsable cliente en terreno</label>
						<div class="col-sm-6">
							<input type="text" placeholder="No aplica" class="form-control input-sm" id="resp_cli" name="resp_cli" ng-model="crea.datos.resp_cli" />
						</div>
					</div>
					<div class="form-group">
						<label for="resp_pago" class="col-sm-3 control-label">Responsable del pago de los servicios</label>
						<div class="col-sm-6">
							<input type="text" placeholder="No aplica" class="form-control input-sm" id="resp_pago" name="resp_pago" ng-model="crea.datos.resp_pago" />
						</div>
					</div>
					
					<br />
					<div class="text-center">
						<input type="submit" class="btn btn-default" data-ng-disabled="!cotizacion.$valid" name="enviar" value="Guardar"  />
					</div>
					
				</form>
			</div>

			<div id="estado" class="alert" ng-show="crea.ok" ng-class="crea.valid ? 'alert-success' : 'alert-warning'">
				{{crea.respuesta}}<br />
				<a class="btn btn-default" href="#/"><i class="fa fa-arrow-left"></i> Volver</a>				
			</div>
		</div>
	</div>
</div>
