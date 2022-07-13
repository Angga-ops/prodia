@extends('../master')

@section('konten')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Artikel</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center data" width="100%">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Nama</th>
                             <th>Foto</th>
                            <th>Publish</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['data']['fb'] as $item)
                        <tr>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td><img src="{{ $item['image'] }}" ></td>
                            <td>{{ $item['publish_date'] }}</td>
                            <td><a href="{{ route('artikel.delete',$item['article_id']) }}"></a></td>
                        </tr>
                        @endforeach
                    </tbody>
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

@endpush