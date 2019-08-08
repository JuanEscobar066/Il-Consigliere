<!DOCTYPE html>
<html lang="es">
	<head>
	    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
	    <title>Informacion</title>
	    
	</head>
	<body>
		<table>
			<tr>
				<th>Titulo</th>
				<th>Considerando</th>
				<th>Acuerda</th>
				<th>Propuesto por</th>
			</tr>
			
		    @foreach($listaPuntos as $punto)
				<tr>
					<td>
						{{$punto->titulo}}
					</td>
					<td>
						{{$punto->considerando}}
					</td>
					<td>
						{{$punto->acuerda}}
					</td>
					<td>
						{{$punto->nombremiembro}} {{$punto->apellido1miembro}} {{$punto->apellido2miembro}}
					</td>
				</tr>
		    @endforeach
		</table>
	    
	</body>
</html>