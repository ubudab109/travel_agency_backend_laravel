@extends('layouts._header')
@section('content')
<div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title ">Destination List</h4>
        <p class="card-category"> List Destination</p>
        <div class="text-right">
            <a href="{{ route('destinations.create') }}" class="btn btn-primary btn-info">
                <i class="material-icons">library_add</i> Add Service
              </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-shopping" id="destination-table">
                <thead class=" text-primary">
                    <tr>
                        <th>Image</th>
                        <th>Destination Name</th>
                        <th>Price</th>
                        <th>Services</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        var table = $('#destination-table').DataTable({
            processing:true,
            serverSide:true,
            ajax: "{{route('destinations.index')}}",
            columns:[
                {data: 'image', name:'image'},
                {data: 'name', name:'name'},
                {data: 'price', name:'price'},
                {data: 'service', name:'service'},
                {data: 'action', name: 'action', orderable: false, searchable: false, className:'td-actions'},
            ]
        })
    })
</script>
@endsection
