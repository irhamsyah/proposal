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
<link href="{{ URL::to('css/bootstrap-responsive.css') }}" rel="stylesheet">    
<link href="{{ URL::to('css/prettify.css') }}" rel="stylesheet">
    <!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://getbootstrap.com/2.3.2/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://getbootstrap.com/2.3.2/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://getbootstrap.com/2.3.2/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="http://getbootstrap.com/2.3.2/assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="http://getbootstrap.com/2.3.2/assets/ico/favicon.png">

</head>

<body>
    <?php
    //public $tot=0;
    //echo date('Y-m-d');
    $pathini=__DIR__;
    
    $plf_pengajuan=0;
    $plf_real=0;
    $plf_pengajuan2=0;
    $plf_real2=0;
    $plf_pengajuan3=0;
    $plf_real3=0;
    
     $plf_pengajuan4=0;
    $plf_real4=0;
    foreach($tampungan as $key=>$value){
            $plf_pengajuan=$plf_pengajuan+($value->plafond_pengajuan);
            $plf_real=$plf_real+($value->plafond_real);
            
            if($value->plafond_real>0){
                $plf_pengajuan2=$plf_pengajuan2+($value->plafond_pengajuan);
                $plf_real2=$plf_real2+($value->plafond_real);
            }
        }
        
        foreach($setujuibelumcair as $tes1=>$value){
            
            $plf_pengajuan4=$plf_pengajuan4+($value->plafond_pengajuan);
            $plf_real4=$plf_real4+($value->plafond_real);
            
        }

   foreach($tdksetuju as $tes1=>$value){
            $plf_pengajuan3=$plf_pengajuan3+($value->plafond_pengajuan);
            $plf_real3=$plf_real3+($value->plafond_real);
            
        }

            
        
    ?>
<div class="bs-docs-example">
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab">Input Data</a></li>
              <li><a href="#profile" data-toggle="tab">Lihat Data/Pencarian Data</a></li>
              <li><a href="#realisasi" data-toggle="tab">Data Sudah Realisasi</a></li>
              <li><a href="#setujuibelumcair" data-toggle="tab">Disetujui Belum Cair</a></li>              
              <li><a href="#tidaksetuju" data-toggle="tab">Proposal Tidak Disetujui</a></li>
              <li class="dropdown">
                <!---<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#dropdown1" data-toggle="tab">@fat</a></li>
                  <li><a href="#dropdown2" data-toggle="tab">@m</a>            </li>
                </ul>--->
              </li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade in active" id="home">
              	<div class="container">
                 
<form id="form1" class="form-signin" name="form1" method="post" action="">
  <p>

        <label>Tanggal Masuk Proposal</label>
        <input type="text" class="form-control" placeholder="Tanggal Masuk Proposal" name="tanggalprop" value="<?php echo Form::old('tanggalprop') ?>" id="inputdtpckr1" required autofocus>
        <label>Unit</label>
        <input type="text" class="form-control" placeholder="Unit" name="unit" value="<?php echo Form::old('unit') ?>" id="input2" required>
        <label >Nomor Proposal</label>
        <input type="text" class="form-control" placeholder="Nomor Proposal" name="no_prop" value="<?php echo Form::old('no_prop') ?>" id="input2" required>
        <label for="input2">Produk</label>
       <!----- <select name="produk" id="input2">
            <option>New</option>    
            <option>Top Up</option>    
            <option>Reguler</option>    
            <option>KIPM</option>    
            <option>Retensi</option>    
            <option>3R</option>    
            <option>Top Up Retensi</option>    
        </select>----->
        
        {{Form::select('produk',array('New'=>'New','Top Up'=>'Top Up','Reguler'=>'Reguler','SUP'=>'SUP','KIPM'=>'KIPM','Retensi'=>'Retensi','3R'=>'3R','Top Up Retensi'=>'Top Up Retensi'))}}
<!---<input type="text" class="form-control" placeholder="Produk" name="produk" value="<?php echo Form::old('produk') ?>" id="input2" required>-->
        <label for="input2">Nama Debitur</label>
        <input type="text" class="form-control" placeholder="Nama Debitur" name="nama_debitur" value="<?php echo Form::old('nama_debitur') ?>" id="input2" required>
        <label for="input2">Plafond pengajuan</label>
        <input type="text" class="form-control" placeholder="Plafond pengajuan" name="plf_pengajuan" value="<?php echo Form::old('plf_pengajuan') ?>" id="input2" required>
        <label for="input2">Jenis Pinjaman/Fasilitas</label>
        <select name="jns_pinj" id="input2">
                <option>MM 10</option>
                <option>MM 25</option>
                <option>MM 50</option>
                <option>MM 100</option>
                <option>MM 200</option>
                <option>MM SUP 500</option>
        </select>
<!----<input type="text" class="form-control" placeholder="Jenis Pinjaman" name="jns_pinj" value="<?php //Form::old('jns_pinj') ?>" id="input2" required>--->
        <label for="input2">Tgl kirim unit</label>
        <input type="text" class="form-control" placeholder="Tgl kirim unit" name="tgl_krm_unit" value="<?php echo Form::old('tgl_krm_unit') ?>" id="inputdtpckr2" >
        <label for="input2">Tgl Kirim KP</label>
        <input type="text" class="form-control" placeholder="Tgl Kirim KP" name="tgl_krm_kp" value="<?php echo Form::old('tgl_krm_kp') ?>" id="inputdtpckr3" >
        <label for="input2">BWMP Kacab</label>
        <input type="text" class="form-control" placeholder="BWMP Kacab" name="bwmpcab" value="<?php echo Form::old('bwmpcab') ?>" id="input2" >
        <label for="input2">BWMP KP</label>
        <input type="text" class="form-control" placeholder="BWMP KP" name="bwmpkp" value="<?php echo Form::old('bwmpkp') ?>" id="input2" >
        <label for="input2">Tgl Realisasi</label>
        <input type="text" class="form-control" placeholder="Tgl Realisasi" name="tgl_real" value="<?php echo Form::old('tgl_real') ?>" id="inputdtpckr4" >
        <label for="input2">Plafon Realisasi</label>
        <input type="text" class="form-control" placeholder="Plafon Realisasi" name="plf_real" value="<?php echo Form::old('plf_real') ?>" id="input2" >
        <label for="input2">Status Persetujuan</label>
        {{Form::select('statuspersetujuan',array('Belum Disetujui'=>'Belum Disetujui','Disetujui'=>'Disetujui','Tidak Disetujui'=>'Tidak Disetujui'))}}
        <label for="input3">Keterangan</label>
        <textarea class="form-control" name="ket" cols="45" rows="5"  id="input3" placeholder="Keterangan"></textarea>
    <p>
    <p>
    <label> </label>
    <button type="submit" class="btn btn-large btn-primary" name="simpan" id="simpan" value="Submit" >Simpan</button>
    <button type="reset" class="btn btn-large btn-primary" name="cancel" id="cancel" value="Submit" >Batal </button>
    </p>
        <p>
        </p>
  </p>
</form>

    </div>
         </div>
              <div class="tab-pane fade" id="profile">
                <p>
                   
                    <div>
                        <p>
                            <a href="{{URL::to('cari/data')}}">Pencarian Data </a>
                            {{Form::open(array('url'=>'export'))}}
                            <table>
                                <tr>
                                    <td>{{Form::label('tet','Bulan ke 1')}} {{Form::text('bulan1',null)}}</td>
                                    <td>{{Form::label('tet','Tahun ke 1')}} {{Form::text('tahun1',null)}}</td>
                                </tr>
                                <tr>
                                    <td>{{Form::label('tet','Bulan ke 2')}} {{Form::text('bulan2',null)}}</td>
                                    <td>{{Form::label('tet','Tahun ke 2')}} {{Form::text('tahun2',null)}}</td>
                                </tr>
                            </table>
                            {{Form::submit('Export')}}
                            {{Form::close()}}
                    </div>
                  <table class="table table-striped table-bordered" id="example">
                            <thead>
                                <tr>
                                    <td>Nomor Proposal</td>
                                    <td>Unit</td>
                                    <td>Nama Debitur</td>
                                    <td>Tanggal Masuk Proposal</td>
                                    <td>Plafond Pengajuan</td>
                                    <td>Produk</td>
                                    <td>Fasilitas</td>
                                    <td>Tanggal Kirim Unit</td>
                                    <td>Tanggal Kirim KP</td>
                                    <td>BWMP Cabang</td>
                                    <td>BWMP KP Proposal</td>
                                    <td>Tanggal Realisasi</td>
                                    <td>Plafond Realisasi</td>
                                    <td>Keterangan</td>
                                    <td>Status</td>
                                </tr>
                            </thead>
                                <tbody>
                                @foreach($tampungan as $value)
                                   
                                        <tr>
                                                <td>{{ $value->nomor_proposal }}</td>
                                                <td>{{ $value->unit }}</td>
                                                <td>{{ $value->nama_debitur }}</td>
                                                <td>
                                                    @if($value->tgl_masuk_proposal==NULL)
                                                    {{$value->tgl_masuk_proposal}}
                                                    @else
                                                    {{ date('d/m/Y',strtotime($value->tgl_masuk_proposal))}}
                                                    @endif
                                                </td>
                                                <td>{{ number_format($value->plafond_pengajuan,2) }}</td>
                                                <td>{{ $value->produk }}</td>
                                                <td>{{ $value->fasilitas }}</td>
                                                <td>
                                                    @if($value->tgl_kirim_unit==NULL)
                                                    {{ $value->tgl_kirim_unit }}
                                                    @else
                                                    {{date('d/m/Y',strtotime($value->tgl_kirim_unit))}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($value->tgl_kirim_kp==NULL)
                                                    {{ $value->tgl_kirim_kp }}
                                                    @else
                                                    {{ date('d/m/Y',strtotime($value->tgl_kirim_kp))}}
                                                    @endif
                                                </td>
                                                <td>{{ $value->bwmpkacab }}</td>
                                                <td>{{ $value->bwmpkp }}</td>
                                                <td>
                                                    @if($value->tgl_realisasi==NULL)
                                                    {{ $value->tgl_realisasi }}
                                                    @else
                                                    {{ date('d/m/Y',strtotime($value->tgl_realisasi))}}
                                                    @endif
                                                    
                                                </td>
                                                <td>{{ number_format($value->plafond_real) }}</td>
                                                <td>{{ $value->keterangan }}</td>
                                                <td>{{ $value->persetujuan }}</td>
                                                <!-- we will also add show, edit, and delete buttons -->
                                                <td>
                                                        <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                                                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                                                        <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                                                        <a class="btn btn-small btn-success" href="{{ URL::to('aplikasi/'.$value->nomor_proposal_lain.'/hapus')}}">Hapus</a>
                                                        <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                                        <a class="btn btn-small btn-info" href="{{ URL::to('aplikasi/'.$value->nomor_proposal_lain)}}">Edit</a>
                                                </td>
                                        </tr>
                                   
                                @endforeach
                                </tbody>
                                <tr>
                                    <td ></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ number_format($plf_pengajuan,2) }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ number_format($plf_real,2) }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
 
</table>
<!-----Fungsi dibawah untuk paginasi -------------------->                    
   
           
                    <div class="pagination">
                            <ul>
                                    <?php echo $tampungan->links(); ?>
                            </ul>
                    </div>
             
<!-----Batas Fungsi paginasi -------------------->                    
          <!-- sample modal content
           
          <div id="edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 id="myModalLabel">Modal Heading</h3>
            </div>
             
             @if(isset($dataedit))
             @foreach($dataedit as $tampilan) 
             
                
            <div class="modal-body">
                <div class="form-group">
                    {{$value->nomor_proposal}}
		{{ Form::label('nomor_proposal', 'no proposal') }}
		{{ Form::text('nomor_proposal', null, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
		{{ Form::label('nama_debitur', 'nama') }}
		{{ Form::text('nama_debitur', null, array('class' => 'form-control')) }}
                </div>
            </div>
                {{ Form::close() }}
             
            <div class="modal-footer">
              <button class="btn" data-dismiss="modal">Close</button>
              <button class="btn btn-primary">Save changes</button>
            </div>
                
              @endforeach      
            @endif       
          </div>
           
            <!-- BATAS sample modal content  -->
                </p>
              </div>


                <div class="tab-pane fade" id="realisasi">
                       <!-----DATA PROPOSAL YG REALISASI-------->
                       <p>
                   
                    <div>
                        <p>
                            <a href="{{URL::to('cari/data')}}">Pencarian Data </a>
                            {{Form::open(array('url'=>'exportrealisasi'))}}
                            <table>
                                <tr>
                                    <td>{{Form::label('tet','Bulan ke 1')}} {{Form::text('bulan1',null)}}</td>
                                    <td>{{Form::label('tet','Tahun ke 1')}} {{Form::text('tahun1',null)}}</td>
                                </tr>
                                <tr>
                                    <td>{{Form::label('tet','Bulan ke 2')}} {{Form::text('bulan2',null)}}</td>
                                    <td>{{Form::label('tet','Tahun ke 2')}} {{Form::text('tahun2',null)}}</td>
                                </tr>
                            </table>
                            {{Form::submit('Export')}}
                            {{Form::close()}}
                    </div>
                        <table class="table table-striped table-bordered" id="example">
                            <thead>
                                <tr>
                                    <td>Nomor Proposal</td>
                                    <td>Unit</td>
                                    <td>Nama Debitur</td>
                                    <td>Tanggal Masuk Proposal</td>
                                    <td>Plafond Pengajuan</td>
                                    <td>Produk</td>
                                    <td>Fasilitas</td>
                                    <td>Tanggal Kirim Unit</td>
                                    <td>Tanggal Kirim KP</td>
                                    <td>BWMP Cabang</td>
                                    <td>BWMP KP Proposal</td>
                                    <td>Tanggal Realisasi</td>
                                    <td>Plafond Realisasi</td>
                                    <td>Keterangan</td>
                                    <td>Status</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($realisasi as $key => $value)
                                                           
                                        <tr>
                                                <td>{{ $value->nomor_proposal }}</td>
                                                <td>{{ $value->unit }}</td>
                                                <td>{{ $value->nama_debitur }}</td>
                                                <td>
                                                    @if($value->tgl_masuk_proposal==NULL)
                                                    {{$value->tgl_masuk_proposal}}
                                                    @else
                                                    {{ date('d/m/Y',strtotime($value->tgl_masuk_proposal))}}
                                                    @endif
                                                </td>
                                                <td>{{ number_format($value->plafond_pengajuan,2) }}</td>
                                                <td>{{ $value->produk }}</td>
                                                <td>{{ $value->fasilitas }}</td>
                                                <td>
                                                    @if($value->tgl_kirim_unit==NULL)
                                                    {{ $value->tgl_kirim_unit }}
                                                    @else
                                                    {{date('d/m/Y',strtotime($value->tgl_kirim_unit))}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($value->tgl_kirim_kp==NULL)
                                                    {{ $value->tgl_kirim_kp }}
                                                    @else
                                                    {{ date('d/m/Y',strtotime($value->tgl_kirim_kp))}}
                                                    @endif
                                                </td>
                                                <td>{{ $value->bwmpkacab }}</td>
                                                <td>{{ $value->bwmpkp }}</td>
                                                <td>
                                                    @if($value->tgl_realisasi==NULL)
                                                    {{ $value->tgl_realisasi }}
                                                    @else
                                                    {{ date('d/m/Y',strtotime($value->tgl_realisasi))}}
                                                    @endif
                                                    
                                                </td>
                                                <td>{{ number_format($value->plafond_real) }}</td>
                                                <td>{{ $value->keterangan }}</td>
                                                <td>{{ $value->persetujuan }}</td>
                                                <!-- we will also add show, edit, and delete buttons -->
                                                <td>
                                                        <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                                                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                                                        <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                                                        <a class="btn btn-small btn-success" href="{{ URL::to('aplikasi/'.$value->nomor_proposal_lain.'/hapus')}}">Hapus</a>
                                                        <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                                        <a class="btn btn-small btn-info" href="{{ URL::to('aplikasi/'.$value->nomor_proposal_lain)}}">Edit</a>
                                                </td>
                                        </tr>
                                    
                                @endforeach
                                </tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ number_format($plf_pengajuan2,2) }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ number_format($plf_real2,2) }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </table>
                    
<!-----Fungsi dibawah untuk paginasi -------------------->                    
           
                    <div class="pagination">
                            <ul>
                                    <?php echo $realisasi->links(); ?>
                            </ul>
                    </div>
           
            <!-- BATAS sample modal content  -->
                </p>
                </div>

              <div class="tab-pane fade" id="setujuibelumcair">
                  <!-----DATA PROPOSAL YG DISETUJUI belum cair-------->
                <p>
                   
                    <div>
                        <p>
                            <a href="{{URL::to('cari/data')}}">Pencarian Data </a>
                            {{Form::open(array('url'=>'exportbelumcair'))}}
                            <table>
                                <tr>
                                    <td>{{Form::label('tet','Bulan ke 1')}} {{Form::text('bulan1',null)}}</td>
                                    <td>{{Form::label('tet','Tahun ke 1')}} {{Form::text('tahun1',null)}}</td>
                                </tr>
                                <tr>
                                    <td>{{Form::label('tet','Bulan ke 2')}} {{Form::text('bulan2',null)}}</td>
                                    <td>{{Form::label('tet','Tahun ke 2')}} {{Form::text('tahun2',null)}}</td>
                                </tr>
                            </table>
                            {{Form::submit('Export')}}
                            {{Form::close()}}
                    </div>
                        <table class="table table-striped table-bordered" id="example">
                            <thead>
                                <tr>
                                    <td>Nomor Proposal</td>
                                    <td>Unit</td>
                                    <td>Nama Debitur</td>
                                    <td>Tanggal Masuk Proposal</td>
                                    <td>Plafond Pengajuan</td>
                                    <td>Produk</td>
                                    <td>Fasilitas</td>
                                    <td>Tanggal Kirim Unit</td>
                                    <td>Tanggal Kirim KP</td>
                                    <td>BWMP Cabang</td>
                                    <td>BWMP KP Proposal</td>
                                    <td>Tanggal Realisasi</td>
                                    <td>Plafond Realisasi</td>
                                    <td>Keterangan</td>
                                    <td>Status</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($setujuibelumcair as $key => $value)
                                   
                                        <tr>
                                                <td>{{ $value->nomor_proposal }}</td>
                                                <td>{{ $value->unit }}</td>
                                                <td>{{ $value->nama_debitur }}</td>
                                                <td>
                                                    @if($value->tgl_masuk_proposal==NULL)
                                                    {{$value->tgl_masuk_proposal}}
                                                    @else
                                                    {{ date('d/m/Y',strtotime($value->tgl_masuk_proposal))}}
                                                    @endif
                                                </td>
                                                <td>{{ number_format($value->plafond_pengajuan,2) }}</td>
                                                <td>{{ $value->produk }}</td>
                                                <td>{{ $value->fasilitas }}</td>
                                                <td>
                                                    @if($value->tgl_kirim_unit==NULL)
                                                    {{ $value->tgl_kirim_unit }}
                                                    @else
                                                    {{date('d/m/Y',strtotime($value->tgl_kirim_unit))}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($value->tgl_kirim_kp==NULL)
                                                    {{ $value->tgl_kirim_kp }}
                                                    @else
                                                    {{ date('d/m/Y',strtotime($value->tgl_kirim_kp))}}
                                                    @endif
                                                </td>
                                                <td>{{ $value->bwmpkacab }}</td>
                                                <td>{{ $value->bwmpkp }}</td>
                                                <td>
                                                    @if($value->tgl_realisasi==NULL)
                                                    {{ $value->tgl_realisasi }}
                                                    @else
                                                    {{ date('d/m/Y',strtotime($value->tgl_realisasi))}}
                                                    @endif
                                                    
                                                </td>
                                                <td>{{ number_format($value->plafond_real) }}</td>
                                                <td>{{ $value->keterangan }}</td>
                                                <td>{{ $value->persetujuan }}</td>
                                                <!-- we will also add show, edit, and delete buttons -->
                                                <td>
                                                        <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                                                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                                                        <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                                                        <a class="btn btn-small btn-success" href="{{ URL::to('aplikasi/'.$value->nomor_proposal_lain.'/hapus')}}">Hapus</a>
                                                        <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                                        <a class="btn btn-small btn-info" href="{{ URL::to('aplikasi/'.$value->nomor_proposal_lain)}}">Edit</a>
                                                </td>
                                        </tr>
                                   
                                @endforeach
                                </tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ number_format($plf_pengajuan4,2) }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </table>
                    
<!-----Fungsi dibawah untuk paginasi -------------------->                    
  
                    <div class="pagination">
                            <ul>
                                    <?php echo $setujuibelumcair->links(); ?>
                            </ul>
                    </div>
        
<!-----Batas Fungsi paginasi -------------------->                    
          <!-- sample modal content
           
          <div id="edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 id="myModalLabel">Modal Heading</h3>
            </div>
             
             @if(isset($dataedit))
             @foreach($dataedit as $tampilan) 
             
                
            <div class="modal-body">
                <div class="form-group">
                    {{$value->nomor_proposal}}
		{{ Form::label('nomor_proposal', 'no proposal') }}
		{{ Form::text('nomor_proposal', null, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
		{{ Form::label('nama_debitur', 'nama') }}
		{{ Form::text('nama_debitur', null, array('class' => 'form-control')) }}
                </div>
            </div>
                {{ Form::close() }}
             
            <div class="modal-footer">
              <button class="btn" data-dismiss="modal">Close</button>
              <button class="btn btn-primary">Save changes</button>
            </div>
                
              @endforeach      
            @endif       
          </div>
           
            <!-- BATAS sample modal content  -->
                </p>
              </div>                

              <div class="tab-pane fade" id="tidaksetuju">
                  <!-----DATA PROPOSAL YG TIDAK DISETUJUI-------->
                <p>
                   
                    <div>
                        <p>
                            <a href="{{URL::to('cari/data')}}">Pencarian Data </a>
                            {{Form::open(array('url'=>'exporttidaksetuju'))}}
                            <table>
                                <tr>
                                    <td>{{Form::label('tet','Bulan ke 1')}} {{Form::text('bulan1',null)}}</td>
                                    <td>{{Form::label('tet','Tahun ke 1')}} {{Form::text('tahun1',null)}}</td>
                                </tr>
                                <tr>
                                    <td>{{Form::label('tet','Bulan ke 2')}} {{Form::text('bulan2',null)}}</td>
                                    <td>{{Form::label('tet','Tahun ke 2')}} {{Form::text('tahun2',null)}}</td>
                                </tr>
                            </table>
                            {{Form::submit('Export')}}
                            {{Form::close()}}
                    </div>
                        <table class="table table-striped table-bordered" id="example">
                            <thead>
                                <tr>
                                    <td>Nomor Proposal</td>
                                    <td>Unit</td>
                                    <td>Nama Debitur</td>
                                    <td>Tanggal Masuk Proposal</td>
                                    <td>Plafond Pengajuan</td>
                                    <td>Produk</td>
                                    <td>Fasilitas</td>
                                    <td>Tanggal Kirim Unit</td>
                                    <td>Tanggal Kirim KP</td>
                                    <td>BWMP Cabang</td>
                                    <td>BWMP KP Proposal</td>
                                    <td>Tanggal Realisasi</td>
                                    <td>Plafond Realisasi</td>
                                    <td>Keterangan</td>
                                    <td>Status</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tdksetuju as $key => $value)
                                   
                                        <tr>
                                                <td>{{ $value->nomor_proposal }}</td>
                                                <td>{{ $value->unit }}</td>
                                                <td>{{ $value->nama_debitur }}</td>
                                                <td>
                                                    @if($value->tgl_masuk_proposal==NULL)
                                                    {{$value->tgl_masuk_proposal}}
                                                    @else
                                                    {{ date('d/m/Y',strtotime($value->tgl_masuk_proposal))}}
                                                    @endif
                                                </td>
                                                <td>{{ number_format($value->plafond_pengajuan,2) }}</td>
                                                <td>{{ $value->produk }}</td>
                                                <td>{{ $value->fasilitas }}</td>
                                                <td>
                                                    @if($value->tgl_kirim_unit==NULL)
                                                    {{ $value->tgl_kirim_unit }}
                                                    @else
                                                    {{date('d/m/Y',strtotime($value->tgl_kirim_unit))}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($value->tgl_kirim_kp==NULL)
                                                    {{ $value->tgl_kirim_kp }}
                                                    @else
                                                    {{ date('d/m/Y',strtotime($value->tgl_kirim_kp))}}
                                                    @endif
                                                </td>
                                                <td>{{ $value->bwmpkacab }}</td>
                                                <td>{{ $value->bwmpkp }}</td>
                                                <td>
                                                    @if($value->tgl_realisasi==NULL)
                                                    {{ $value->tgl_realisasi }}
                                                    @else
                                                    {{ date('d/m/Y',strtotime($value->tgl_realisasi))}}
                                                    @endif
                                                    
                                                </td>
                                                <td>{{ number_format($value->plafond_real) }}</td>
                                                <td>{{ $value->keterangan }}</td>
                                                <td>{{ $value->persetujuan }}</td>
                                                <!-- we will also add show, edit, and delete buttons -->
                                                <td>
                                                        <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                                                        <!-- we will add this later since its a little more complicated than the other two buttons -->
                                                        <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                                                        <a class="btn btn-small btn-success" href="{{ URL::to('aplikasi/'.$value->nomor_proposal_lain.'/hapus')}}">Hapus</a>
                                                        <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                                        <a class="btn btn-small btn-info" href="{{ URL::to('aplikasi/'.$value->nomor_proposal_lain)}}">Edit</a>
                                                </td>
                                        </tr>
                                   
                                @endforeach
                                </tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ number_format($plf_pengajuan3,2) }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </table>
                    
<!-----Fungsi dibawah untuk paginasi -------------------->                    
  
                    <div class="pagination">
                            <ul>
                                    <?php echo $tdksetuju->links(); ?>
                            </ul>
                    </div>
           
<!-----Batas Fungsi paginasi -------------------->                    
          <!-- sample modal content
           
          <div id="edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 id="myModalLabel">Modal Heading</h3>
            </div>
             
             @if(isset($dataedit))
             @foreach($dataedit as $tampilan) 
             
                
            <div class="modal-body">
                <div class="form-group">
                    {{$value->nomor_proposal}}
		{{ Form::label('nomor_proposal', 'no proposal') }}
		{{ Form::text('nomor_proposal', null, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
		{{ Form::label('nama_debitur', 'nama') }}
		{{ Form::text('nama_debitur', null, array('class' => 'form-control')) }}
                </div>
            </div>
                {{ Form::close() }}
             
            <div class="modal-footer">
              <button class="btn" data-dismiss="modal">Close</button>
              <button class="btn btn-primary">Save changes</button>
            </div>
                
              @endforeach      
            @endif       
          </div>
           
            <!-- BATAS sample modal content  -->
                </p>
              </div>

              <div class="tab-pane fade" id="dropdown2">
                <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
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
    <!----<script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-dropdown.js"></script>
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
    
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script>

<script src="js/widgets.js"></script>
<script src="js/holder.js"></script>
<script src="js/application.js"></script>

<script src="{{ asset('js/jquery-1.8.2.min.js') }}"></script>
<script src="js/jquery-ui-1.8.16.custom.min.js"></script>


    <!-- Analytics
    ================================================== -->
 <!----   <script>
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