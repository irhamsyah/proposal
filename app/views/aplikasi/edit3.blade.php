<!DOCTYPE html>
<html>
<head>
	<title>Look! I'm CRUDding</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
        <h1>APLIKASI MONITORING PROPOSAL</h1>
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('aplikasi') }}">APLIKASI Alert</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('aplikasi') }}">View All PROP</a></li>
		<li><a href="{{ URL::to('aplikasi') }}">Create a PROP</a>
	</ul>
</nav>
@foreach($dataedit as $key=>$value)
<h1>Edit {{ $value->nama_debitur }}</h1>
@endforeach
<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($value, array('route' => array('aplikasi.update', $value->nomor_proposal), 'method' => 'PUT')) }}

	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('nama_debitur', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('email', 'Unit') }}
		{{ Form::text('unit', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('nerd_level', 'Produk') }}
		{{ Form::select('produk', array('0' => 'Select a Level', '1' => 'Sees Sunlight', '2' => 'Foosball Fanatic', '3' => 'Basement Dweller'), null, array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Edit the Nerd!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>