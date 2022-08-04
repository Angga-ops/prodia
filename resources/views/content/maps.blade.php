@extends('../master')

@section('konten')
<script>
    function initialize() {
  var propertiPeta = {
    center:new google.maps.LatLng(-8.5830695,116.3202515),
    zoom:9,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  
  var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
  
  // membuat Marker
  var marker=new google.maps.Marker({
      position: new google.maps.LatLng(-8.5830695,116.3202515),
      map: peta
  });

}

// event jendela di-load  
google.maps.event.addDomListener(window, 'load', initialize);
</script>
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
@push('script')

@endpush