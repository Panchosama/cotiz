<div>


</div>

<div class="container-fluid" >
	<div id="cuerpo" class="row">
		<div id="contenido">
			<h2>Cotizaciones</h2><br />
			<a href="#/crearCot" class="btn btn-success"><i class="fa fa-plus"></i> Crear cotizaci&oacute;n</a><br />
			<table id="cot_list" class="table table-bordered table-condensed table-striped table-hover col-sm-6">
				<caption>Cotizaciones ingresadas</caption>
				<thead>
					<th>Cotizaci&oacute;n</th>
					<th>Trabajo cot.</th>
					<th>Empresa</th>
					<th>Lugar</th>
					<th>Firmada</th>
					<th>Enviada</th>
					<th>Editar</th>
				</thead>
				<tbody>
				<tr ng-repeat="c in list.cotiz track by c.cot_id">
					<td>
						<a href="#/mostrarCot/{{c.cot_id}}" class="btn btn-primary">{{c.cot_id}}</a>
					</td>
					<td>{{c.cot_trabajo}}</td>
					<td>{{c.cot_empresa}}</td>
					<td>{{c.cot_lugar}}</td>
					<td>
						<span ng-if="c.cot_firmado==1"><i class="fa fa-check"></i></span>
						<span ng-if="c.cot_firmado==0"><i class="fa fa-remove"></i></span>
					</td>
					<td>
						<span ng-if="c.cot_enviado==1"><i class="fa fa-check" ></i>&nbsp;&nbsp;{{c.cot_fechaenvio}}</span>
						<span ng-if="c.cot_enviado==0"><i class="fa fa-remove" ></i></span>
					</td>
					<td><a class="btn btn-success" href="#/editarCot/{{c.cot_id}}" ng-if="c.cot_enviado==0"><i class="fa fa-edit"></i></a></td>
				</tr>
				</tbody>
			</table> 

		</div>
	</div>
</div>