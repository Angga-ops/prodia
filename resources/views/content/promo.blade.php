@extends('../master')

@section('konten')
<div class="container-fluid py-4">
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Projects table</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class=" align-items-center justify-content-center mb-0 yajra">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tenggat promo</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="max-width: 100px">konten</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Foto</th>
                  <th></th>
                </tr>
              </thead>
              {{-- <tbody>
                @foreach ($data['data'] as $item)
                <tr>
                  <td>
                    <div class="d-flex px-2">                  
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm">{{ $item['title'] }}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-sm font-weight-bold mb-0">{{ $item['date_start'] }} - {{ $item['date_end'] }}</p>
                  </td>
                  <td style="max-width: 150px!important;word-break: break-word;height: max-content!important;">
                    <span class="text-xs font-weight-bold" >{{ $item['content'] }}</span>
                  </td>
                  <td>
                    {{ $item['image'] }}
                  </td>
                </tr>
                @endforeach
              </tbody> --}}
            </table>
          </div>
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
		$('.yajra').DataTable({
                processing: true,
                ajax: '{!! route('content.dtPromo') !!}', // memanggil route yang menampilkan data json
                columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'date_start',
                        name: 'date_start'
                    },
                    {
                        data: 'date_end',
                        name: 'date_end'
                    },
                    {
                        data: 'content',
                        name: 'content'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                ]
            });
        });
</script>
@endpush