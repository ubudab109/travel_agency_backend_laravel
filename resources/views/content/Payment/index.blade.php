@extends('layouts._header')
@section('content')
<div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title ">Payment List</h4>
        <p class="card-category"> Here is a payment list</p>
        <div class="text-right">
            <a href="{{ route('payments.create') }}" class="btn btn-primary btn-info">
                <i class="material-icons">library_add</i> Add New Payment
              </a>
          </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table" id="payment-list">
            <thead class=" text-primary">
              <th>Payment Name</th>
              <th>Created At</th>
              <th>Action</th>
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
            var table = $('#payment-list').DataTable({
                processing:true,
                serverSide:true,
                ajax: "{{route('payments.index')}}",
                columns:[
                    {data: 'payment_name', name:'payment_name'},
                    {data: 'created_at', name:'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className:'td-actions'},
                ]
            })
        })

        function deletePayment(id, ele) {
            var url = "{{route('payments.destroy', ':id')}}";
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
                        setTimeout(() => {
                            tr.fadeOut(500, function () {
                                tr.remove();
                            })
                        }, 300);
                    },
                    error:function (res) {
                        alert("There's Something Wrong, Please Try Again");
                    }
                })
                }
            })
        }
    </script>
@endsection
