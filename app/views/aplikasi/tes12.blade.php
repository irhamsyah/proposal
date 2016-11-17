<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <title>Halaman Coba</title>
    <body>
 
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>No Proposal</td>
                    <td>Nama Debitur</td>
                </tr>
            </thead>
            <tbody>
                @foreach($tampungan as $key=>$value)
                <tr>
                    <td>{{$value->nomor_proposal}}</td>
                    <td>{{$value->nama_debitur}}</td>
                </tr>
                
                @endforeach
            </tbody>
        </table>
    </body>
</html>