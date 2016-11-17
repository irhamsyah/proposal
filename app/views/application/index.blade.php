<!-- app/views/nerds/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
	<title>Look! I'm CRUDding</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
	<div class="navbar-header">
            <!-------kata proposal menunjukan folder tempat penyimpanan BLADE/WEB design/tempate anda--------->
		<a class="navbar-brand" href="{{ URL::to('application') }}">Aplikasi Monitoring Proposal</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('application') }}">Lihat Proposak Masuk</a></li>
		<li><a href="{{ URL::to('application/create') }}">Create a Nerd</a>
	</ul>
</nav>

<h1>STOK BARANG</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>Kode Barang</td>
			<td>Nama/Jenis Barang</td>
			<td>Jml Persedian</td>
			<td>Permintaan</td>
			<td>Tanggal Pesan</td>
		</tr>
	</thead>
	<tbody>
	@foreach($tampungan as $key => $value)   
		<tr>
			<td>{{ $value->kode_brg }}</td>
			<td>{{ $value->nama_barang }}</td>
			<td>{{ $value->jml_stock }}</td>
			<td>{{ $value->jml_permintaan }}</td>
                        <td>{{ $value->tgl_permintaan }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
				<!-- we will add this later since its a little more complicated than the other two buttons -->

				<!-- show the nerd (uses the show method found at GET /nerds/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('application/' . $value->nomor_proposal) }}">lihat</a>

				<!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('application/' . $value->nomor_proposal . '/edit') }}">Edit</a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
</body>
</html>