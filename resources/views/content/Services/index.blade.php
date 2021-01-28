@extends('layouts._header')
@section('content')
<div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title ">Service List</h4>
        <p class="card-category"> List Service For Each Destination</p>
        <div class="text-right">
            <a href="{{ route('services.create') }}" class="btn btn-primary btn-info">
                <i class="material-icons">library_add</i> Add Service
              </a>
          </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-shopping" id="service-table">
                <thead class=" text-primary">
                    <tr>
                        <th></th>
                        <th>Service Name</th>
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
            var table = $('#service-table').DataTable({
                processing:true,
                serverSide:true,
                ajax: "{{route('services.index')}}",
                columns:[
                    {data: 'logo', name:'logo', className:'text-center'},
                    {data: 'service_name', name:'service_name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className:'td-actions'},
                ]
            })
        })

        function deleteService(id, ele){
            // e.preventDefault();
            var url = "{{route('services.destroy', ':id')}}";
            url = url.replace(':id', id);
            var tr = $(ele).closest('tr');


            swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function (value) {
                if(value){
                    $.ajax({
                    type:'DELETE',
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    success:function (res) {
                        console.log(res);
                        console.log('sukses')
                        setTimeout(() => {
                            tr.fadeOut(500, function () {
                                tr.remove();
                            })
                        }, 300);
                    },
                    error:function (res) {
                        console.log(res);
                        console.log('error')
                    }
                })
                }
            })
        }
    </script>
@endsection
