<html>
    <head>
        <title>Pencarian data</title>
    <h1>Cari Data</h1>
    <br>
    <a href="{{URL::to('aplikasi')}}">Home</a>
    <br><br>
        <!------bootsrap utama--->
        <link rel="stylesheet" href="{{URL::to('css/bootstrap.css')}}">
       
        
        <link rel="stylesheet" href="{{URL::to('css/demo_table_jui.css')}}">
        <link rel="stylesheet" href="{{URL::to('css/jquery-ui-1.8.4.custom.css')}}">
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
        <table cellpaddin="0" cellspacing="0" border="1"  class="display" id="example">
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
                                    <!---<td>Tanggal Kirim KP</td>---->
                                    <td>BWMP Cabang</td>
                                    <td>BWMP KP Proposal</td>
                                    <td>Tanggal Realisasi</td>
                                    <td>Plafond Realisasi</td>
                                    
                                    <td>Pilihan1</td>
                                    <td>Pilihan2</td>
                </tr>
            </thead>
            <tbody>
                @foreach($tampungan as $key=>$value)
                <tr>
                                                <td>{{ $value->nomor_proposal }}</td>
                                                <td>{{ $value->unit }}</td>
                                                <td>{{ $value->nama_debitur }}</td>
                                                <td>
                                                    @if($value->tgl_masuk_proposal==NULL)
                                                    {{$value->tgl_masuk_proposal}}
                                                    @else
                                                    {{ date('d/m/Y',strtotime($value->tgl_masuk_proposal)) }}
                                                    @endif
                                                </td>
                                                <td>{{ number_format($value->plafond_pengajuan,2) }}</td>
                                                <td>{{ $value->produk }}</td>
                                                <td>{{ $value->fasilitas }}</td>
                                                <td>
                                                    @if($value->tgl_kirim_unit==NULL)
                                                    {{$value->tgl_kirim_unit}}
                                                    @else
                                                    {{ date('d/m/Y',strtotime($value->tgl_kirim_unit))}}
                                                    @endif
                                                </td>
                                                <!---<td>{{ date('d/m/Y',strtotime($value->tgl_kirim_kp))}}</td>--->
                                                <td>{{ $value->bwmpkacab }}</td>
                                                <td>{{ $value->bwmpkp }}</td>
                                                <td>
                                                    @if($value->tgl_realisasi==NULL)
                                                    {{$value->tgl_realisasi}}
                                                    @else
                                                    {{ date('d/m/Y',strtotime($value->tgl_realisasi))}}
                                                    @endif
                                                </td>
                                                <td>{{ number_format($value->plafond_real) }}</td>
                                                
                                                <td><a href="aplikasi/{{$value->nomor_proposal_lain}}">Edit</td>
                                                <td><a href="aplikasi/{{$value->nomor_proposal_lain}}/hapus">Hapus</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
        
        
    </body>
</html>