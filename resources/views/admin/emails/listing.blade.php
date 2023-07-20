@extends('admin.services.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{$title}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('email.create') }}"> Send Email</a>
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
            <th>Sender Name</th>
            <th>Reciever Name</th>
            <th>Subject</th>
        </tr>
        @foreach ($emails as $email) 
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $email->sender->name }}</td>
            <td>{{ $email->reciever->name }}</td>
            <td>{{ $email->subject }}</td>
        </tr>
        @endforeach
    </table>
  
      
@endsection