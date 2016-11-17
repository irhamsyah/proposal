<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pencarian Data</title>
<style type="text/css" title="currentStyle">
 @import url(//datatables.net/release-datatables/media/css/demo_table_jui.css);
    @import url(//datatables.net/media/css/ui-lightness/jquery-ui-1.8.4.custom.css);
	

</style>

<script type="text/javascript" src="{{URL::to('js/jquery.js')}}"></script>
<script type="text/javascript" src="{{URL::to('js/jquery.dataTables.js')}}"></script>
<script>
$(document).ready( function () {
     var oTable = $('#example').dataTable( {
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
				} );		
} );
</script>
</head>

<body>
    <table bgcolor="purple" cellpadding="0" cellspacing="0" border="1" class="display" id="example">
<thead>
  <tr>
    <td>Nomor Proposal</td>
    <td>Nama Debitur</td>
    <td>Produk</td>
    <td>Fasilitas</td>
    <td>Tgl Proposal</th>
    <td>Plafond Pengajuan</td>
    <td>status</td>
  </tr>
  </thead>
  <tbody>
  @foreach($tampungan as $key=>$value)
    <tr>
      <td>{{$value->nomor_proposal}}</td>
      <td>{{$value->nama_debitur}}</td>
      <td>{{$value->produk}}</td>
      <td>{{$value->fasilitas}}</td>
      <td>{{date('d/m/Y',strtotime($value->tgl_masuk_proposal))}}</td>
      <td>{{ number_format($value->plafond_pengajuan,2) }}</td>
      <td><a href="aplikasi/{{$value->nomor_proposal_lain}}">Edit</td>      
    </tr>
 @endforeach   
    </tbody>
</table>
</body>
</html>
