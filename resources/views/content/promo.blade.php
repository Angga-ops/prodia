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
                      <p class="mb-0 text-sm">{{ $carbon->parse($promo['date_start'])->isoFormat('dddd, D MMMM YYYY') }}</p>
                  </div>
                  </td>
                  <td>
                    <div class="d-flex flex-column justify-content-center">
                    <p class="mb-0 text-sm">{{ $carbon->parse($promo['date_end'])->isoFormat('dddd, D MMMM YYYY') }}</p>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex flex-sm-column flex-md-row justify-content-center">
                      <button class="btn d-flex btn-xs btn-primary mx-1 detailShowBtn" data-promo="{{ base64_encode(json_encode($promo)) }}" data-mode="detail"><i class="fa fa-eye m-auto" aria-hidden="true"></i> &nbsp Detail</button>
                      <button class="btn d-flex btn-xs btn-success mx-1 editShowBtn" data-promo="{{ base64_encode(json_encode($promo)) }}" data-mode="edit"><i class="fa fa-edit m-auto" aria-hidden="true"></i> &nbsp Edit</button>
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
<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/content/promo/add') }}" id="addForm" method="post" enctype="multipart/form-data">
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

<div class="modal" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addForm" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="#title">Judul</label>
            <input type="text" class="form-control" id="detailTitle" name="title" disabled />
          </div>
          <div class="mb-3">
            <label for="#date_start">Tanggal Mulai</label>
            <input type="date" name="date_start" id="detail_date_start" class="form-control" disabled />
          </div>
          <div class="mb-3">
            <label for="#date_end">Tanggal Akhir</label>
            <input type="date" name="date_end" id="detail_date_end" class="form-control" disabled />
          </div>
          <div class="mb-3">
            <label for="#content">Konten</label>
            <textarea name="content" id="detailContent" class="form-control" rows="5" disabled></textarea>
          </div>
          <div class="mb-3">
            <div class="d-flex flex-column">
              <div class="flex-shrink-1">
                <label for="#image">Foto</label>
                <input type="file" name="image" id="detailImage" class="form-control" disabled>
              </div>
              <div class="flex-shrink-1 p-2" style="max-width: 50%;">
                <img class="w-100" id="detail-image-preview" />
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editForm" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="#title">Judul</label>
            <input type="text" class="form-control" id="editTitle" name="title" />
          </div>
          <div class="mb-3">
            <label for="#date_start">Tanggal Mulai</label>
            <input type="date" name="date_start" id="edit_date_start" class="form-control" />
          </div>
          <div class="mb-3">
            <label for="#date_end">Tanggal Akhir</label>
            <input type="date" name="date_end" id="edit_date_end" class="form-control" />
          </div>
          <div class="mb-3">
            <label for="#content">Konten</label>
            <textarea name="content" id="editContent" class="form-control" rows="5"></textarea>
          </div>
          <div class="mb-3">
            <div class="d-flex flex-column">
              <div class="flex-shrink-1">
                <label for="#image">Foto</label>
                <input type="file" name="image" id="editImage" class="form-control">
              </div>
              <div class="flex-shrink-1 p-2" style="max-width: 50%;">
                <img class="w-100" id="edit-image-preview" />
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
    if ($(this).data('promo')) {
      setValue($(this).data('promo'), $(this).data('mode'))
    }
    $('#addModal').modal('show')
  });
  
  $("#addModal .modal-close").on("click", function(e) {
    $('#addModal').modal('hide')
  });

  // edit
  $(".editShowBtn").on("click", function(e) {
    if ($(this).data('promo')) {
      setValueEdit($(this).data('promo'))
    }
    $('#editModal').modal('show')
  });

  $("#editModal .modal-close").on("click", function(e) {
    $('#editModal').modal('hide')
  });

  // detail
  $(".detailShowBtn").on("click", function(e) {
    if ($(this).data('promo')) {
      setValueDetail($(this).data('promo'))
    }
    $('#detailModal').modal('show')
  });

  $("#detailModal .modal-close").on("click", function(e) {
    $('#detailModal').modal('hide')
  });
  
  const setValueDetail = (dataEncrypt) => {
    const data = JSON.parse(atob(dataEncrypt))
    const date_start = data.date_start.split('T')
    const date_end = data.date_end.split('T')

    $('#detailTitle').val(data.title)
    $('#detail_date_start').val(date_start[0])
    $('#detail_date_end').val(date_end[0])
    $('#detailContent').val(data.content)
    $('#detail-image-preview').attr('src', data.image.replace('http:/', 'http://'))
  }

  const setValueEdit = (dataEncrypt) => {
    const data = JSON.parse(atob(dataEncrypt))
    const url = "{{ url('/content/promo') }}"
    const date_start = data.date_start.split('T')
    const date_end = data.date_end.split('T')

    $('#editTitle').val(data.title)
    $('#edit_date_start').val(date_start[0])
    $('#edit_date_end').val(date_end[0])
    $('#editContent').val(data.content)
    $('#edit-image-preview').attr('src', data.image.replace('http:/', 'http://'))
    $('#editForm').attr('action', url + '/' + data.promotion_id)
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
      $('#addForm').attr('action', "{{ route('content.promo.edit'," + data.promotion_id + ") }}")
    }
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