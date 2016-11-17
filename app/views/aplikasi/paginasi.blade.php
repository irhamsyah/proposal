<?php
$plf_pengajuan=0;
    $plf_real=0;
    foreach($tampungan as $key=>$value){
            $plf_pengajuan=$plf_pengajuan+($value->plafond_pengajuan);
            $plf_real=$plf_real+($value->plafond_real);
        }
?>

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
                                @foreach($tampungan as $key => $value)
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
<?php
	$presenter = new Illuminate\Pagination\BootstrapPresenter($tampungan);
?>

<?php if ($tampungan->getLastPage() > 1): ?>
	<div class="pagination">
		<ul>
			<?php echo $presenter->render(); ?>
		</ul>
	</div>
<?php endif; ?>