@extends('admin.services.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>User Purchase Services</h2>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Service Name</th>
            <th>Service Price</th>
            <th>Status</th>
        </tr>
        @foreach ($services as $service)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $service->service->name }}</td>
            <td>{{$service->service->price}}$</td>
            <td>{{ $service->status }}</td>
           
        </tr>
        @endforeach
    </table>
  
      
@endsection