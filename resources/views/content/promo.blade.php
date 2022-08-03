@extends('../master')

@section('konten')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="d-flex flex-row justify-content-between items-center">
            <h5>Event</h5>
            <button class="btn d-flex btn-md btn-primary mx-1 showBtn" data-mode="add"><i class="fa fa-plus m-auto" aria-hidden="true"></i> &nbsp Tambah</button>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0 ">
            <table class="table align-items-center mb-0 w-100">
              <thead>
                <tr>
                  
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Foto</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Mulai</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Akhir</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data['promotion'] as $promo)
                    
                <tr>
                  <td class="text-center">
                    <img src="{{ str_replace('http:/','http://',$promo['image']) }}" width="50px" height="50px" class="border rounded" alt="">
                  </td>
                  <td>
                      <div class="d-flex flex-column justify-content-center">
                        <p class="mb-0 text-sm">{{ $promo['title'] }}</p>
                      </div>
                  </td>
                  <td>
                  <div class="d-flex flex-column justify-content-center">
                      <p class="mb-0 text-sm">{{ date("D, d F Y",strtotime($promo['date_start'])) }}</p>
                  </div>
                  </td>
                  <td>
                    <div class="d-flex flex-column justify-content-center">
                    <p class="mb-0 text-sm">{{ date("D, d F Y",strtotime($promo['date_end'])) }}</p>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex flex-sm-column flex-md-row justify-content-center">
                      <button class="btn d-flex btn-xs btn-primary mx-1 showBtn" data-promo="{{ base64_encode(json_encode($promo['promotion_id'])) }}" data-mode="detail"><i class="fa fa-eye m-auto" aria-hidden="true"></i> &nbsp Detail</button>
                      <button class="btn d-flex btn-xs btn-success mx-1 showBtn" data-promo="{{ base64_encode(json_encode($promo['promotion_id'])) }}" data-mode="edit"><i class="fa fa-edit m-auto" aria-hidden="true"></i> &nbsp Edit</button>
                      <button class="btn d-flex btn-xs btn-danger mx-1 deleteBtn" data-id="{{ $promo['promotion_id'] }}"><i class="fa fa-trash m-auto" aria-hidden="true"></i> &nbsp Hapus</button>
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
<div class="modal" id="promoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/content/promo/add') }}" id="form" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="#title">Judul</label>
            <input type="text" class="form-control" id="title" name="title" />
          </div>
          <div class="mb-3">
            <label for="#date_start">Tanggal Mulai</label>
            <input type="date" name="date_start" id="date_start" class="form-control" />
          </div>
          <div class="mb-3">
            <label for="#date_end">Tanggal Akhir</label>
            <input type="date" name="date_end" id="date_end" class="form-control" />
          </div>
          <div class="mb-3">
            <label for="#content">Konten</label>
            <textarea name="content" id="content" class="form-control" rows="5"></textarea>
          </div>
          <div class="mb-3">
            <div class="d-flex flex-column">
              <div class="flex-shrink-1">
                <label for="#image">Foto</label>
                <input type="file" name="image" id="image" class="form-control">
              </div>
              <div class="flex-shrink-1 p-2" style="max-width: 50%;">
                <img class="w-100" id="image-preview" />
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary modal-save">Save changes</button>
        </div>
      </form>
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
        <a href="{{ url('content/promo') }}" id="confirm-delete" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
  $(".deleteBtn").on("click", function(e) {
    $('#confirm-delete').attr('href', $('#confirm-delete').attr('href') + '/' + $(this).data('id'))
    $('#hapusModal').modal('show')
  });

  $("#hapusModal .modal-close").on("click", function(e) {
    $('#hapusModal').modal('hide')
  });

  $(".showBtn").on("click", function(e) {
    modeCheck($(this).data('mode'))
    if ($(this).data('promo')) {
      setValue($(this).data('promo'), $(this).data('mode'))
    }
    $('#promoModal').modal('show')
  });

  $("#promoModal .modal-close").on("click", function(e) {
    $('#promoModal').modal('hide')
  });

  const modeCheck = (mode) => {
    switch (mode) {
      case "detail":
        disabled()
        break
      case "edit":
        enabled()
        $('.modal-save').text('Save')
        break
      case "add":
        cleared()
        enabled()
        $('.modal-save').text('Add')
    }
  }

  const setValue = (dataEncrypt, mode) => {
    const data = JSON.parse(atob(dataEncrypt))
    const date_start = data.date_start.split('T')
    const date_end = data.date_end.split('T')

    $('#title').val(data.title)
    $('#date_start').val(date_start[0])
    $('#date_end').val(date_end[0])
    $('#content').val(data.content)
    $('#image-preview').attr('src', data.image.replace('http:/', 'http://'))

    if (mode == 'edit') {
      $('#form').attr('action', "{{ route('content.promo.edit'," + data.promotion_id + ") }}")
    }
  }

  const disabled = () => {
    $('#title').attr('disabled', true)
    $('#date_start').attr('disabled', true)
    $('#date_end').attr('disabled', true)
    $('#content').attr('disabled', true)
    $('#image').attr('disabled', true)
    $('.modal-save').hide()
  }

  const enabled = () => {
    $('#title').attr('disabled', false)
    $('#date_start').attr('disabled', false)
    $('#date_end').attr('disabled', false)
    $('#content').attr('disabled', false)
    $('#image').attr('disabled', false)
    $('#image-preview').show()
    $('.modal-save').show()
  }

  const cleared = () => {
    $('#title').val('')
    $('#date_start').val('')
    $('#date_end').val('')
    $('#content').val('')
    $('#image').val('')
    $('#image-preview').hide()
    $('#image-preview').attr('src', '')
  }
</script>
@endpush