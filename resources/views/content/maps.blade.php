@extends('../master')

@section('konten')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between items-center">
                            <h6>Forum</h6>
                            <a href="{{ route('forum.tambah') }}" class="btn d-flex btn-md btn-primary mx-1 showBtn"><i class="fa fa-plus m-auto" aria-hidden="true"></i> &nbsp Tambah</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div id="googleMap" style="width:100%;height:380px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    var map = L.map('googleMap').setView([-6.200000, 106.816666], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
}).addTo(map);


map.on('click', (e)=>{
    alert("Lat, Lon : " + e.latlng.lat + ", " + e.latlng.lng)
  });
</script>
@endpush