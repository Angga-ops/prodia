@extends('../../../master')

@section('konten')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between items-center">
                            <h6><a href="/content/maps"><i class="ni ni-bold-left"></i>Kembali</a></h6>
                            <h6>Tambah Alamat</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2 ">
                        <div id="googleMap" style="width:100%;height:380px;"></div>
                    </div>
                    <div class="card-footer">
                        <form action="#" method="post">
                            <input type="hidden" name="lng" id="inpLng">
                            <input type="hidden" name="lat" id="sinpLat">
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
@push('styles')
<link
  rel="stylesheet"
  href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css"
/>
@endpush
@push('scripts')
<script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>
<script>
    var map = L.map('googleMap').setView([-6.200000, 106.816666], 20);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    

    const search = new GeoSearch.GeoSearchControl({
        provider: new GeoSearch.OpenStreetMapProvider(),
    });

    var MARKER = L.marker([-6.200000, 106.816666]).addTo(map)

    map.on('click', (e)=>{
        let lat = e.latlng.lat
        let lng = e.latlng.lng

        $('#inpLat').val(lat)
        $('#inpLng').val(lng)

        MARKER.setLatLng([lat, lng]).addTo(map);
    });

    map.addControl(search)
</script>
@endpush
