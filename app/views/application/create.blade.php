<!DOCTYPE html>
<html>
<head>
	<title>Look! I'm CRUDding</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/docs.css">
        <link rel="stylesheet" href="../css/signin.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('application') }}">Nerd Alert</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('application') }}">View All Nerds</a></li>
		<li><a href="{{ URL::to('application/create') }}">Create a Nerd</a>
	</ul>
</nav>

<h1>Create a Nerd</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'application')) }}

	<div class="form-group">
		{{ Form::label('tanggalprop', 'Tanggal Masuk Proposal') }}
		{{ Form::text('tanggalprop', Input::old('tanggalprop'), array('class' => 'form-control','id'=>'inputdtpckr1')) }}
	</div>

	<div class="form-group">
		{{ Form::label('Unit', 'Unit') }}
		{{ Form::text('Unit', Input::old('Unit'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('no_prop', 'Nomor Proposal') }}
		{{ Form::text('no_prop', Input::old('no_prop'), array('class' => 'form-control')) }}
	</div>

        <div class="form-group">
		{{ Form::label('produk', 'Produk') }}
		{{ Form::select('produk', array('0' => 'NEW', '1' => 'TOP UP', '2' => 'KIPM', '3' => 'RETENSI', '4' => '3R', '5' => 'TOP UP RETENSI'), Input::old('produk'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('nama_debitur', 'Nama Debitur') }}
		{{ Form::text('nama_debitur', Input::old('nama_debitur'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('plf_pengajuan', 'Plafond Pengajuan') }}
		{{ Form::text('plf_pengajuan', Input::old('plf_pengajuan'), array('class' => 'form-control')) }}
	</div>

        <div class="form-group">
		{{ Form::label('jns_pinj', 'Fasilitas/Jenis Pinjaman') }}
		{{ Form::select('jns_pinj', array('0' => 'MM 10', '1' => 'MM 25', '2' => 'MM 50', '3' => 'MM 100', '4' => 'MM 200', '5' => 'MM SUP 500'), Input::old('jns_pinj'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('tgl_krm_unit', 'tgl kirim unit') }}
		{{ Form::text('Unit', Input::old('Unit'), array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Create the Nerd!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>