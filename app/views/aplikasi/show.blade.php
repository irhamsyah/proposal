<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{ URL::to('css/jquery-ui.css') }}">
<script src="{{ URL::to('js/jquery-1.9.1.js') }}"></script>
<script src="{{ URL::to('js/jquery-ui.js')}}"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
$(function() {
$( "#inputdtpckr1" ).datepicker();
$( "#inputdtpckr2" ).datepicker();
$( "#inputdtpckr3" ).datepicker();
$( "#inputdtpckr4" ).datepicker();
});
</script>
<link href="{{ URL::to('css/bootstrap.min.css') }}" rel="stylesheet">
<!-- Documentation extras -->
<link href="{{ URL::to('css/signin.css') }}" rel="stylesheet">
<link href="{{ URL::to('css/docs.css') }}" rel="stylesheet">
<link href="{{ URL::to('css/bootstrap-responsive.css')}}" rel="stylesheet">    
<link href="{{ URL::to('css/prettify.css')}}" rel="stylesheet">
	<title>Look! I'm CRUDding</title>
	<link rel="stylesheet" href="http://getbootstrap.com/2.3.2/assets/css/bootstrap.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('aplikasi') }}">Create a Nerd</a>
	</div>
	<ul class="nav navbar-nav">
		<!---<li><a href="{{ URL::to('aplikasi') }}">View All Nerds</a></li>--->
		<!--<li><a href="{{ URL::to('aplikasi/create') }}"></a>-->
	</ul>
</nav>

    @foreach($dataedit as $key=>$value)
        <h1>Edit {{ $value->nama_debitur }}</h1>
    @endforeach
<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($value, array('route' => array('aplikasi.show', $value->nomor_proposal), 'method' => 'PUT','class'=>'form-signin')) }}

	<div class="form-group">
		{{ Form::label('1', 'Tanggal Masuk Proposal') }}
		{{ Form::text('tgl_masuk_proposal', null, array('class' => 'form-control','id'=>'inputdtpckr1')) }}
	</div>

	<div class="form-group">
		{{ Form::label('2', 'Unit') }}
		{{ Form::email('unit', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('3', 'Nomor Proposal') }}
                {{ Form::email('nomor_proposal', null, array('class' => 'form-control')) }}
		<!--{{ Form::select('tgl_masuk_proposal', array('0' => 'Select a Level', '1' => 'Sees Sunlight', '2' => 'Foosball Fanatic', '3' => 'Basement Dweller'), null, array('class' => 'form-control')) }}--->
	</div>

	<div class="form-group">
		{{ Form::label('4', 'Produk') }}
		{{ Form::text('produk', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('5', 'Name Debitur') }}
		{{ Form::text('nama_debitur', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('6', 'Plafond Pengajuan') }}
		{{ Form::text('plafond_pengajuan', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('7', 'Jenis Pinjaman/Fasilitas') }}
		{{ Form::text('fasilitas', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('8', 'Tgl kirim unit') }}
		{{ Form::text('tgl_kirim_unit', null, array('class' => 'form-control','id'=>'inputdtpckr2')) }}
	</div>
	<div class="form-group">
		{{ Form::label('9', 'Tgl Kirim KP') }}
		{{ Form::text('tgl_kirim_kp', null, array('class' => 'form-control','id'=>'inputdtpckr3')) }}
	</div>
	<div class="form-group">
		{{ Form::label('10', 'BWMP Kacab') }}
		{{ Form::text('bwmpkacab', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('11', 'BWMP KP') }}
		{{ Form::text('bwmpkp', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('12', 'Tgl Realisasi') }}
		{{ Form::text('tgl_realisasi', null, array('class' => 'form-control','id'=>'inputdtpckr4')) }}
	</div>
	<div class="form-group">
		{{ Form::label('13', 'Plafon Realisasi') }}
		{{ Form::text('plafond_real', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('No Proposal', 'Keterangan') }}
		{{ Form::text('keterangan', null, array('class' => 'form-control')) }}
	</div>

{{ Form::close() }}

</div>
</body>
</html>