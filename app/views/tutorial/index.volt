<h1>Tutorial<h1>

<p>This is a tutorial</p>
<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
		$('#tablas').DataTable();
	} );
</script>
<div id="tdiv" style="font-size:0.5em;">
<table id="tablas" class="display" cellspacing="0" width="80%" >
<thead><tr>
	<th>Codigo</th>
	<th>Nombre</th>
	<th>Apellido</th>
	<th>Creacion</th>
</tr></thead>
<tbody>
{% for user in cr_usuario %}
<tr>
	<td>{{ user.u_codigo }}</td>
	<td>{{ user.u_nombre }}</td>
	<td>{{ user.u_apellido }}</td>
	<td>{{ user.u_fcreacion }}</td>
</tr>
{% endfor %}
</tbody>
</table>
</div>