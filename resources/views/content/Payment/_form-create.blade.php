@extends('layouts._header')
@section('content')
{{-- {{dd()}} --}}
<div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title ">Payment Add</h4>
        <p class="card-category"> Add New Payment</p>
        <div class="text-right">
            <a href="{{ route('payments.index') }}" class="btn btn-primary btn-info">
                <i class="material-icons">backspace</i> Back To List
              </a>
          </div>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('payments.store') }}">
            @csrf
            <div class="form-group">
              <label for="services">Payment Name</label>
              <input type="text" class="form-control" id="payment_name" name="payment_name" placeholder="Enter payment name">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
    </div>
  </div>
@endsection
