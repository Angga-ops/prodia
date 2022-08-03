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
                        <button class="btn d-flex btn-md btn-primary mx-1 showBtn" data-mode="add"><i class="fa fa-plus m-auto" aria-hidden="true"></i> &nbsp Tambah</button>
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
                      @if (isset($data) && isset($data['data']))
                      @foreach ($data['data']['fb'] as $key=>$item)
                      <tr>
                        <td class="text-center"><img src="{{ str_replace('http:/','http://',$item['image']) }}" class="avatar avatar-sm me-3" ></td>
                          <td>{{ $item['title'] }}</td>
                          <td>{{ $item['name'] }}</td>
                          <td>{{ $item['publish_date'] }}</td>
                          <td>
                            <a href="#"  type="button" class="btn btn-xs btn-info open_modal"   data-toggle="modal" data-artikel="{{ base64_encode(json_encode($data['data']['fb'][$key])) }}" data-mode="detail"><i class="fa fa-eye"></i> Detail</a>
                            <a href="#"  class="btn btn-xs btn-warning open_modal"  id="duar" data-artikel="{{ base64_encode(json_encode($data['data']['fb'][$key])) }}" data-mode="edit"><i class="fa fa-pencil"></i> Edit</a>
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
        {{-- modal show --}}
  <div class="modal fade" id="modal" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close done" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel"></h4>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="#title">Judul</label>
            <input type="text" class="form-control" id="title" name="title">
          </div>
          <div class="mb-3">
            <label for="#title">name</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="mb-3">
            <label for="#title">konten</label>
            <textarea type="text" class="form-control" id="content" name="content"></textarea>
          </div>
          <div class="mb-3">
            <label for="#title">Image</label>
            <input type="file" class="form-control" id="image" name="image">
          </div>
          <div class="mb-3">
            <img src="" id="image-preview" alt="" style="max-width: 25%">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default done" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary modal-save">Save</button>
        </div>
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
  const setValue = (dataEncrypt) => {
    const data = JSON.parse(atob(dataEncrypt))
    console.log(data)
    const publish_date = data.publish_date.split('T')

    $('#title').val(data.title)
    $('#name').val(data.name)
    $('#content').val(data.content)
    $('#publish_date').val(publish_date[0])
    $('#image-preview').attr('src',data.image.replace('http:/','http://'))
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
