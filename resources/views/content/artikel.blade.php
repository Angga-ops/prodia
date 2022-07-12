@extends('../master')

@section('konten')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>News Table</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class=" align-items-center justify-content-center  data">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Name</th>
                            <th>Content</th>
                            <th>Image</th>
                            <th>Publish</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTable.min.js') }}"></script>
<script type="text/javascript">
	$(function(){
		$('.data').DataTable({
                processing: true,
                ajax: '{!! route('content.datatables') !!}', // memanggil route yang menampilkan data json
                columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'content',
                        name: 'content'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'publish_date',
                        name: 'publish_date'
                    },
                ]
            });
        });
</script>
@endpush