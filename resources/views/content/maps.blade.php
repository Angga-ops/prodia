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
                    <div class="card-footer">
                        <form action="#" method="post">
                            <input type="hidden" name="lng" id="inpLng">
                            <input type="hidden" name="lat" id="inpLat">
                            <div class="d-flex flex-row justify-content-between align-items-end">
                                <div>
                                    <label for="#address">Alamat Lengkap</label>
                                    <textarea name="alamat_lengkap" class="form-control" style="resize: none;" id="address" cols="100" rows="5"></textarea>
                                </div>
                                <div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
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
    var map = L.map('googleMap').setView([-6.200000, 106.816666], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);


    var MARKER = L.marker([-6.200000, 106.816666]).addTo(map)

    map.on('click', (e)=>{
        let lat = e.latlng.lat
        let lng = e.latlng.lng

        $('#inpLat').val(lat)
        $('#inpLng').val(lng)

        MARKER.setLatLng([lat, lng]).addTo(map);
    });
</script>
@endpush