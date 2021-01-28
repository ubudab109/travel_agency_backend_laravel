@extends('layouts._header')
@section('content')
{{-- {{dd()}} --}}
<div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title ">Service Add</h4>
        <p class="card-category"> Add New Service</p>
        <div class="text-right">
            <a href="{{ route('services.index') }}" class="btn btn-primary btn-info">
                <i class="material-icons">backspace</i> Back To List
              </a>
          </div>
      </div>
      <div class="card-body">
        <form enctype="multipart/form-data" method="post" action="{{ route('services.store') }}">
            @csrf
            <div class="form-group">
              <label for="services">Service Name</label>
              <input type="text" class="form-control" id="services" name="service_name" placeholder="Enter service name">
            </div>
            <div class="row py-4">
                <div class="col-lg-6 mx-auto">

                    <!-- Upload image input-->
                    <div class="input-group mb-3 px-2 py-2 rounded-pill bg-gray shadow-sm">
                        <input id="upload" type="file" name="logo" onchange="readURL(this);" class="form-control border-0">
                        <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                        <div class="input-group-append">
                            <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                        </div>
                    </div>

                    <!-- Uploaded image area-->
                    <p class="font-italic text-white text-center">The image uploaded will be rendered inside the box below.</p>
                    <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
    </div>
  </div>


@endsection
@section('script')
    <script>

    /*  ==========================================
        SHOW UPLOADED IMAGE
    * ========================================== */
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imageResult')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function () {
        $('#upload').on('change', function () {
            readURL(input);
        });
    });

    /*  ==========================================
        SHOW UPLOADED IMAGE NAME
    * ========================================== */
    var input = document.getElementById( 'upload' );
    var infoArea = document.getElementById( 'upload-label' );

    input.addEventListener( 'change', showFileName );
    function showFileName( event ) {
    var input = event.srcElement;
    var fileName = input.files[0].name;
    infoArea.textContent = 'File name: ' + fileName;
    }

    </script>
@endsection
