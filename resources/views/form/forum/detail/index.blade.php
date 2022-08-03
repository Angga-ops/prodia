@extends('../../../master')

@section('konten')
<div class="container-fluid py-4" >
    @if(session('success'))
                      <div class="card bg-gradient-success my-2">
                          <div class="card-body text-light">
                              {{ session('success') }}
                          </div>
                        </div>
                          @endif
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4" >
                                <h6>{{ $detail['data']['forum']['publisher'] }}</h6>
                            <p>{{ $detail['data']['forum']['category'] }}</p></div>
                                <hr class="horizontal dark">
                                <div class="mb-4">
                                    <h4>{{ $detail['data']['forum']['title'] }}</h4>
                                    {{ $detail['data']['forum']['content'] }}</div>
                                    <hr class="horizontal dark">   
                            <div class="d-flex justify-content-end"><a data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" href=""><i class="fa fa-reply"></i>
                            Balas</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @foreach ($detail['data']['reply'] as $rep)
        
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="name"><h6>{{ $rep['publisher'] }}</h6></div>
                                <span> Dibuat {{ date(" D,H:i",strtotime($rep['updated_at'])) }}</span>
                            </div>
                            <hr class="horizontal dark">
                            <div class="mb-4">
                                <p class="justify">{{ $rep['content'] }}</p>
                            </div>
                            <hr class="horizontal dark">
                            <div class="d-flex justify-content-end">
                                <a type="button" href="/forum/delete/{{ $rep['forum_reply_id'] }}"><i class="fa fa-trash"></i>
                                    Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
<!--Modal tambah data-->
<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Balas Forum</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('reply.tambah', request()->segments()[2]) }}" method="post">
            @csrf
            <div class="mb-3">
                <textarea type="text" class="form-control" name="balas" placeholder="Masukan balasan anda..." required></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection
