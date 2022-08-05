@extends('../master')

@section('konten')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
              @if(session('success'))
                      <div class="card bg-gradient-success my-2">
                          <div class="card-body text-light">
                              {{ session('success') }}
                          </div>
                        </div>
                          @endif
            <div class="d-flex flex-row justify-content-between items-center">
              <h6>Forum</h6>
              <a href="{{ route('forum.tambah') }}" class="btn d-flex btn-md btn-primary mx-1 showBtn"><i class="fa fa-plus m-auto" aria-hidden="true"></i> &nbsp Tambah</a>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0 ">
              <table class="table align-items-center justify-content-center mb-0 w-100">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Judul</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($forum['data'] as $f)
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              @if ($f ['photos'] != null)
                                  <img src="{{ $f['photos'] }}" alt="">
                              @else
                                <img src="../assets/img/no-images.png" class="avatar avatar-sm me-3" alt="user1">
                              @endif
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ $f['publisher'] }}</h6>
                              <p class="text-xs text-secondary mb-0">{{ $f['category'] }}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $f['title'] }}</p>
                        <p class="text-xs text-secondary mb-0">{{ $f['replies'] }} balasan</p>
                        </td>
                        <td>
                        <div class="d-flex flex-sm-column flex-md-row justify-content-center">
                          <a href="{{ route('forum.detail', $f['forum_id']) }}"  type="button" class="btn btn-xs mx-1 btn-info"><i class="fa fa-eye"></i> Detail</a>
                            <a href="{{ route('forum.delete', $f['forum_id']) }}"  id="{{ $f['forum_id'] }}" data-toggle="modal" class="btn btn-danger btn-xs mx-1 hapus"><i class="fa fa-trash"></i> Delete</a></td>
</div>
                          </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection