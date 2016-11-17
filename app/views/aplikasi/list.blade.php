@section('scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#typeSelect').change(function(){
        $('#selectForm').submit(); 
      });
    });
  </script>
@stop

<div class="row">
  {{ Form::open(array('url'=>'admin/seo','method'=>'get','id'=>'selectForm','class'=>'form-horizontal'))}}
  <div class="col-md-6">
    <h2>
      SEO
    </h2>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <p>
    {{ Form::select('type', Config::get('config.seo_mapping'),array('id'=> 'typeSelect' ,'class'=> 'form-control'))}}
    </p>
  </div>
  {{ Form::close()}}
</div>
<div class="row">
  <div class="col-md-12">
      <table class="table table-hover table-bordered table-striped" style="margin-left:0">
        <thead>
          <tr>
            <th>Nomor Proposal</th>
             <th>Nama Debitur</th>
            <th>Produk</th>
             <th>Plafond Pengajuan</th>             
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($list as $item)

          <tr>
            <td>{{ $item->nomor_proposal }}</td>
            
              <td>{{$item->nama_debitur}}</td>
              <td>{{$item->produk}}</td>
              <td>{{$item->plafond_pengajuan}}</td>
              <td><a href="{{ url('admin/seo/'.$item->nomor_proposal.'/edit?type='.'&id='.$item->nomor_proposal)}}">Edit</a> </td>
              <td>
                <a href="{{ url('admin/seo/create?type='.'&id='.$item->nomor_proposal)}}">Add</a> 
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
  </div>
</div>

