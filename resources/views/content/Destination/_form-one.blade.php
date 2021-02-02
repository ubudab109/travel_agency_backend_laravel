@extends('layouts._header')
@section('content')
{{-- {{dd()}} --}}
<div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title ">Destination Add</h4>
        <p class="card-category"> Add New Destination</p>
        <div class="text-right">
            <a href="#" class="btn btn-primary btn-info">
                <i class="material-icons">backspace</i> Back To List
              </a>
          </div>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('destinations.store') }}" enctype="multipart/form-data">
            @csrf
            {{-- <div class="form-group">
                <div class="input-field">
                    <label class="active">Photos</label>
                    <div class="input-images-1" style="padding-top: .5rem;"></div>
                </div>
            </div> --}}
            <input type="file" name="images_destination[]" multiple>
            <div class="form-group">
              <label for="services">Destination Name</label>
              <input type="text" class="form-control" name="destination_name" placeholder="Enter destination name">
            </div>
            <div class="form-group">
                <label for="services">Destination Price</label>
                <input type="text" class="form-control" name="price" placeholder="Ex: 2">
            </div>
            <div class="form-group">
                <label for="services">Description</label>
                <textarea class="form-control" name="description" placeholder="Description of destination"></textarea>
            </div>
            <div class="form-group">
                <label for="services">Maps URL</label>
                <input type="text" class="form-control" name="maps_url" placeholder="Maps destination ( This is optional)">
            </div>
            <div class="form-group">
                <label><strong>Select Services :</strong></label><br/>
                    @php
                        $service = \App\Service::all();
                    @endphp
                    @foreach ($service as $value)
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" name="service_id[]" type="checkbox" id="service_group{{$value->id}}" value="{{$value->id}}"> {{$value->service_name}}
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>

                        </label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
    </div>
  </div>


@endsection
@section('script')
    <script>
        $('.input-images-1').imageUploader();
    </script>
@endsection
