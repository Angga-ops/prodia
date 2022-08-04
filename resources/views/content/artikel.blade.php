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
                        <h5>Artikel</h6>
                        <button class="btn d-flex btn-md btn-primary mx-1" type="button" data-bs-toggle="modal" data-bs-target="#modalAdd"><i class="fa fa-plus m-auto" aria-hidden="true"></i> &nbsp Tambah</button>
                      </div>
                    </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center data" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Judul</th>
                            <th>Nama</th>
                            <th>Publish</th>
                            <th rowspan="4" style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @if (isset($data) && isset($data['articles']))
                      @foreach ($data['articles'] as $key=>$item)
                      <tr>
                        <td class="text-center"><img src="{{ str_replace('http:/','http://',$item['image']) }}" class="avatar avatar-sm me-3" ></td>
                          <td>{{ $item['title'] }}</td>
                          <td>{{ $item['name'] }}</td>
                          <td>{{ $item['publish_date'] }}</td>
                          <td>
                            <a href="#"  type="button" class="btn btn-xs btn-primary detail_article"   data-artikel="{{ base64_encode(json_encode($data['articles'][$key])) }}" data-mode="detail"><i class="fa fa-eye"></i> Detail</a>
                            <a href="#"  class="btn btn-xs btn-warning edit_article" data-artikel="{{ base64_encode(json_encode($data['articles'][$key])) }}" data-mode="edit"><i class="fa fa-pencil"></i> Edit</a>
                            <a href="{{ route('artikel.delete', $item['article_id']) }}"  id="{{ $item['article_id'] }}" data-toggle="modal" class="btn btn-danger btn-xs hapus"><i class="fa fa-trash"></i> Delete</a></td>
                          </tr>  
                      @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
                
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->
  <!--Modal tambah-->
  <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Artikel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/content/artikel/tambah" method="post" enctype="multipart/form-data">
          @csrf
          <div class="m-3">
            <label for="exampleFormControlInput1" class="form-label">Judul</label>
            <input type="text" class="form-control" name="judul" placeholder="Masukan judul" required>
          </div>
          <div class="m-3">
            <label for="exampleFormControlTextarea1" class="form-label">Konten</label>
            <textarea class="form-control" name="konten" placeholder="Masukan" rows="3" required></textarea>
          </div>
          <div class="m-3">
              <label for="exampleFormControlInput1" class="form-label">Tanggal Pubish</label>
              <input type="date" class="form-control" name="tgl_publish" required>
          </div>
          <div class="m-3">
            <label for="#image">Foto</label>
            <input type="file" name="foto" class="form-control" >
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Kirim</button>
          </div>
        </form>
        </div>
    </div>
  </div>
  <!--Modal edit-->
  <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Artikel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" id="editModalClose" aria-label="Close"></button>
        </div>
        <form id="editForm" method="post" enctype="multipart/form-data">
          @csrf
          <div class="m-3">
            <label for="exampleFormControlInput1" class="form-label">Judul</label>
            <input type="text" class="form-control" name="judul" placeholder="Masukan judul" id="editTitle" required>
          </div>
          <div class="m-3">
            <label for="exampleFormControlTextarea1" class="form-label">Konten</label>
            <textarea class="form-control" name="konten" placeholder="Masukan" rows="3" id="editContent" required></textarea>
          </div>
          <div class="m-3">
              <label for="exampleFormControlInput1" class="form-label">Tanggal Pubish</label>
              <input type="date" class="form-control" name="tgl_publish" placeholder="Masukan judul" id="editPublish" required>
          </div>
          <div class="m-3">
            <label for="#image">Foto</label>
            <input type="file" name="foto" id="image" class="form-control">
          </div>
          <div class="m-3">
            <img src="" id="editImgPreview" class="w-100" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="editClose" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Kirim</button>
          </div>
        </form>
        </div>
    </div>
  </div>
  <!--Modal Detail-->
  <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Artikel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" id="detailModalClose" aria-label="Close"></button>
        </div>
        <form id="editForm" method="post" enctype="multipart/form-data">
          @csrf
          <div class="m-3">
            <label for="exampleFormControlInput1" class="form-label">Judul</label>
            <input type="text" class="form-control" name="judul" placeholder="Masukan judul" id="detailTitle" readonly>
          </div>
          <div class="m-3">
            <label for="exampleFormControlTextarea1" class="form-label">Konten</label>
            <textarea class="form-control" name="konten" placeholder="Masukan" rows="3" id="detailContent" readonly></textarea>
          </div>
          <div class="m-3">
              <label for="exampleFormControlInput1" class="form-label">Tanggal Pubish</label>
              <input type="date" class="form-control" name="tgl_publish" placeholder="Masukan judul" id="detailPublish" readonly>
          </div>
          
          <div class="m-3">
            <img src="" id="detailImgPreview" class="w-100" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="detailClose" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Kirim</button>
          </div>
        </form>
        </div>
    </div>
  </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script>
    $('.open_modal').on('click',function(e){
      if($(this).data('mode')=='detail'){
        disabled()
      }else{
        enable()
      }
      setValue($(this).data('artikel'))
       $('#modal').modal('show');
  });
  $('.done').on('click',function(e){
    $('#modal').modal('hide');
  });
  //Detail Modal
  $('.detail_article').on('click', function(e) {
    // setValueEdit(())
    setValueEdit($(this).data('artikel'))
    $('#modalDetail').modal('show')
  })
    $('#detailModalClose').on('click',function (e) {
      $('#modalDetail').modal('hide')
    })
    $('#detailClose').on('click',function (e) {
      $('#modalDetail').modal('hide')
    })
  // Edit Modal
  $('.edit_article').on('click', function(e){
    setValueEdit($(this).data('artikel'))
    $('#modalEdit').modal('show')
  })
  $('#editModalClose').on('click', function(e){
    $('#modalEdit').modal('hide')
  })
  $('#editClose').on('click', function(e){
    $('#modalEdit').modal('hide')
  })

  const setValueEdit = (dataEncrypt) => {
    const data = JSON.parse(atob(dataEncrypt))
    const publish_date = data.publish_date.split('T')
    const baseUrl = "{{ url('/content/artikel/edit/') }}"
    const actionForm = baseUrl + '/' + data.article_id

    $('#editForm').attr('action',actionForm)
    $('#editTitle').val(data.title)
    $('#name').val(data.name)
    $('#editContent').val(data.content)
    $('#editPublish').val(publish_date[0])
    $('#editImgPreview').attr('src',data.image.replace('http:/','http://'))
  }

  const setValue = (dataEncrypt) => {
    const data = JSON.parse(atob(dataEncrypt))
    console.log(data)
    const publish_date = data.publish_date.split('T')

    $('#detailTitle').val(data.title)
    $('#name').val(data.name)
    $('#detailContent').val(data.content)
    $('#detailPublish').val(publish_date[0])
    $('#detailImgPreview').attr('src',data.image.replace('http:/','http://'))
  }
  const disabled =()=>
  {
    $('#title').attr('disabled', true)
    $('#name').attr('disabled', true)
    $('#content').attr('disabled', true)
    $('#publish_date').attr('disabled', true)
    $('#image').attr('disabled', true)
    $('.modal-save').hide()
  }
  const enable=()=>{
    $('#title').attr('disabled', false)
    $('#name').attr('disabled', false)
    $('#content').attr('disabled', false)
    $('#publish_date').attr('disabled', false)
    $('#image').attr('disabled', false)
    $('.modal-save').show()
    $('#image-preview').hide()
  }
</script>
@endpush
