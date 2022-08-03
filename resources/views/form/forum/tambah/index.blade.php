@extends('../../../master')

@section('konten')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between items-center">
                            <h6><a href="/content/forum"><i class="ni ni-bold-left"></i>Kembali</a></h6>
                            <h6>Tambah Forum</h6>
                        </div>
                      </div>
                      <div class="card-body ">
                        <div class="card bg-gradient-success my-2 hidden">
                            <div id="message" class="card-body text-light">
                            </div>
                          </div>
                        <div class="row">
                            <form action="" method="post">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Judul</label>
                                    <input class="form-control" name="judul" type="text" placeholder="Masukan Judul" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Kategori</label>
                                    <select name="category" id="" class="form-select">
                                        @foreach ($cat['categories'] as $item)
                                            <option value="{{ $item['forum_category_id'] }}">{{  $item['category'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">konten</label>
                                    <textarea class="form-control" type="text" name="konten" placeholder="Masukan Isi Konten" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <a  type="submit" class="btn-submit btn btn-sm btn-info mb-0 d-none d-lg-block">Tambah</a>
                            </div>
                        </div>
                    </form>
                      </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('.hidden').addClass('visually-hidden')

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $('.btn-submit').click(function(e) {
            var judul = $("input[name=judul]").val();
            var category = $("select[name=category]").val();
            var konten = $("textarea[name=konten]").val();

            $.ajax({
                type:'POST',
                url:"{{ route('forum.post') }}",
                data:{judul:judul,category:category,konten:konten},
                success: (res) => {
                    if (res.success) {
                        $('#message').text(res.message);
                        $('.hidden').removeClass('visually-hidden');
                    }
                }
            })
        })
    </script>
@endpush