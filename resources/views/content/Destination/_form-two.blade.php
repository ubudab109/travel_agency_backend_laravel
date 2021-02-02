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
        <form enctype="multipart/form-data" method="post" action="{{ route('destinations.store') }}">
            @csrf
            <div class="form-group">
                <div class="input-field">
                    <label class="active">Photos</label>
                    <div class="input-images-1" style="padding-top: .5rem;"></div>
                </div>
            </div>
            <div class="form-group">
                <select name="service_id" class="form-control">
                    @php
                        $service = \App\Service::all();
                    @endphp
                    @foreach ($service as $value)
                        <option value="{{$value->id}}">{{$value->service_name}}</option>
                    @endforeach
                </select>
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
