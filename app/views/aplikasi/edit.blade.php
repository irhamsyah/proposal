<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aplikasi Monitoring Proposal</title>
<!---------<link href="css/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>--->
<!-----Berikut ini untuk aplikasi datepicker---->
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

    <style type="text/css">
        select{
            background-color:#F00;
            width: 200px;
        }
    </style>

<!-- Bootstrap core CSS -->
<link href="{{ URL::to('css/bootstrap.css') }}" rel="stylesheet">
<h1>APLIKASI MONITORING PROPOSAL</h1>
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<!-- Documentation extras -->
<link href="{{ URL::to('css/signin.css') }}" rel="stylesheet">
<link href="{{ URL::to('css/docs.css') }}" rel="stylesheet">
<link href="{{ URL::to('css/bootstrap-responsive.css')}}" rel="stylesheet">    
<link href="{{ URL::to('css/prettify.css')}}" rel="stylesheet">
    <!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://getbootstrap.com/2.3.2/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://getbootstrap.com/2.3.2/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://getbootstrap.com/2.3.2/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="http://getbootstrap.com/2.3.2/assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="http://getbootstrap.com/2.3.2/assets/ico/favicon.png">

</head>

<body>
<div class="bs-docs-example">
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#" data-toggle="tab">Edit Data</a></li>
              <li><a href="{{URL::to('aplikasi')}}" >Home</a></li>
             <!-- <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#dropdown1" data-toggle="tab">@fat</a></li>
                  <li><a href="#dropdown2" data-toggle="tab">@m</a></li>
                </ul>
              </li>--->
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade in active" id="home">
              	<div class="container">
 
                    @foreach($dataedit as $key=>$value)
                        <h1>Edit {{ $value->nama_debitur }}</h1>
                    @endforeach
<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($value, array('route' => array('aplikasi.update', $value->nomor_proposal_lain), 'method' => 'PUT','class'=>'form-control')) }}

	<div class="form-group">
		{{ Form::label('1', 'Tanggal Masuk Proposal') }}
		{{ Form::text('tgl_masuk_proposal', null, array('class' => 'form-control','id'=>'inputdtpckr1')) }}
	</div>

	<div class="form-group">
		{{ Form::label('2', 'Unit') }}
		{{ Form::text('unit', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('3', 'Nomor Proposal') }}
                {{ Form::text('nomor_proposal', null, array('class' => 'form-control')) }}
		<!--{{ Form::select('tgl_masuk_proposal', array('0' => 'Select a Level', '1' => 'Sees Sunlight', '2' => 'Foosball Fanatic', '3' => 'Basement Dweller'), null, array('class' => 'form-control')) }}--->
	</div>

	<div class="form-group">
		{{ Form::label('4', 'Produk') }}
                {{ Form::select('produk', array('New'=>'New','Top Up'=>'Top Up','Reguler'=>'Reguler','KIPM'=>'KIPM','Retensi'=>'Retensi','3R'=>'3R','Top Up Retensi'=>'Top Up Retensi'), Input::old('produk'), array('class' => 'form-control')) }}
		<!--{{ Form::text('produk', null, array('class' => 'form-control')) }}--------->
	</div>
	<div class="form-group">
		{{ Form::label('5', 'Nama Debitur') }}
		{{ Form::text('nama_debitur', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('6', 'Plafond Pengajuan') }}
		{{ Form::text('plafond_pengajuan', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('7', 'Jenis Pinjaman/Fasilitas') }}
                {{ Form::select('fasilitas', array('MM 10'=>'MM 10', 'MM 25'=>'MM 25','MM 50'=>'MM 50','MM 100'=>'MM 100','MM 200'=>'MM 200','MM SUP 500'=>'MM SUP 500'), Input::old('fasilitas'), array('class' => 'form-control')) }}                
		<!-----{{ Form::text('fasilitas', null, array('class' => 'form-control')) }}------>
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
		{{ Form::label('14', 'Keterangan') }}
		{{ Form::text('keterangan', null, array('class' => 'form-control')) }}
	</div>
        <div class="form-group">
                {{ Form::label('15', 'Status Persetujuan') }}
                {{Form::select('persetujuan',array('Belum Disetujui'=>'Belum Disetujui','Disetujui'=>'Disetujui','Tidak Disetujui'=>'Tidak Disetujui'))}}
        </div>                
	{{ Form::submit('Edit Data', array('class' => 'btn btn-primary')) }}
        

        {{ Form::close()}}

                </div>
             </div>

        </div>
     </div>
              <!-- Le javascript
    ================================================== -->
    <!--Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="{{ URL::to('js/widgets.js') }}"></script>
    <script src="{{ URL::to('js/jquery.js')}}"></script>
    <script src="{{ URL::to('js/bootstrap-transition.js')}}"></script>
    <script src="{{ URL::to('js/bootstrap-modal.js')}}"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-tab.js"></script>
    <!--<script src="{{ URL::to('js/bootstrap-tab.js')}}"></script>
    <!--<script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-dropdown.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-scrollspy.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-tab.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-tooltip.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-popover.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-button.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-collapse.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-carousel.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-typeahead.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-affix.js"></script>

    <script src="http://getbootstrap.com/2.3.2/assets/js/holder/holder.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/google-code-prettify/prettify.js"></script>

    <script src="http://getbootstrap.com/2.3.2/assets/js/application.js"></script>
------------->
<script src="{{ URL::to('js/jquery-1.10.2.js')}}"></script>
<script src="{{ URL::to('js/bootstrap.js')}}"></script>

<script src="{{ URL::to('js/widgets.js')}}"></script>
<script src="{{ URL::to('js/holder.js')}}"></script>
<script src="{{ URL::to('js/application.js')}}"></script>

<script src="{{ URL::to('js/jquery-1.7.1.min.js')}}"></script>
<script src="{{ URL::to('js/jquery-ui-1.8.16.custom.min.js')}}"></script>
    <!-- Analytics
    ================================================== -->
    <script>
      var _gauges = _gauges || [];
      (function() {
        var t   = document.createElement('script');
        t.type  = 'text/javascript';
        t.async = true;
        t.id    = 'gauges-tracker';
        t.setAttribute('data-site-id', '4f0dc9fef5a1f55508000013');
        t.src = '//secure.gaug.es/track.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(t, s);
      })();
    </script>
    
    <!--script untuk buat datepicker-->

</body>
</html>