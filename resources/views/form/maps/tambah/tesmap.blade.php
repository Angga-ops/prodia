@extends('../../../master')

@section('konten')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between items-center">
                            <h6><a href="/content/maps"><i class="ni ni-bold-left"></i>Kembali</a></h6>
                            <h6>Duar jedeeer</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2 ">
                        <div id="map" style="width:100%;height:400px;"></div>
                    </div>
                    <div class="card-footer">
                        <form action="#" method="post">
                            <input type="text" name="lat" id="inpLat">
                            <input type="text" name="lng" id="inpLng">
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
    const providerMaps = new GeoSearch.OpenStreetMapProvider();

    var leafletMap = L.map('map',
    {
        fullscreenControl: true,
        fullscreenControl: {
            pseudoFullscreen:false
        },
        minZoom: 2
    }).setView([0, 0], 2)
    L.tileLayer('//{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(leafletMap);

    var MARKER = {};
    leafletMap.on('click', function (e) {
        let lat = e.latlng.lat.toString().substring(0, 15);
        let lng = e.latlng.lng.toString().substring(0, 15);
        if (MARKER != undefined) {
            leafletMap.removeLayer(MARKER);
        }
        $('#inpLat').val(lat);
        $('#inpLng').val(lng);

        MARKER = L.marker([lat, lng]).addTo(leafletMap);
        console.log(MARKER);
    })

    const search = new GeoSearch.GeoSearchControl({
    provider: providerMaps,
    style: 'bar',
});
leafletMap.addControl(search);
</script>
@endpush
