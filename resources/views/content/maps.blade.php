
@extends('../master')

@section('konten')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between items-center">
                            <h6>Alamat</h6>
                            <a href="{{ url('/content/maps/tambah') }}" class="btn d-flex btn-md btn-primary mx-1"><i class="fa fa-plus m-auto" aria-hidden="true"></i> &nbsp Tambah</a>
                            <a href="{{ url('/test') }}" class="btn d-flex btn-md btn-primary mx-1"><i class="fa fa-plus m-auto" aria-hidden="true"></i> &nbsp Test</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 w-100">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Cabang</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat Lengkap</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Latitude</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Langtitude</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection