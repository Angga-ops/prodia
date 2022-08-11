@extends('../master')

@section('konten')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="d-flex flex-row justify-content-between items-center">
            <h5>Berita</h5>
            <button class="btn d-flex btn-md btn-primary mx-1 showBtn" data-mode="add"><i class="fa fa-plus m-auto" aria-hidden="true"></i> &nbsp Tambah</button>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0 mx-2">
            <table class="align-items-center justify-content-center mb-0 w-100 tables">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Publish</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Hapus</h5>
        <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin menghapus data ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">Close</button>
        <a href="{{ url('content/artikel') }}" id="confirm-delete" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
  moment.locale('id');
  $('.tables').DataTable({
   processing: true,
   serverSide: true,
   columnDefs: [{
      targets: 2,
      render: $.fn.dataTable.render.moment( 'YYYY-MM-DDTH:m:s.000Z', 'D/M/YYYY', 'id' ),
    },
  ],
  orderable:false, 
   ajax: "{!! route('artikel.tables') !!}",
   columns: [
     {data: 'title'},
     {data: 'name'},
     {data: 'publish_date'},
     {data: 'action', searchable: false, sortable: false},
   ]
 });

const openDelete = (id) => {
    $('#confirm-delete').attr('href', $('#confirm-delete').attr('href') + '/' + atob(id))
    $('#hapusModal').modal('show')
  };

  $("#hapusModal .modal-close").on("click", function(e) {
    $('#hapusModal').modal('hide')
  });
</script>
@endpush