@extends('front.layouts.main')


@section('content')


<div class="container-fluid">
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Customer Name</th>
        <th scope="col">Customer email</th>
        <th scope="col">Customer Phone</th>
        <th scope="col">Customer Date Of Birth</th>
        <th scope="col">Customer Orders</th>
      </tr>
    </thead>
    @foreach($data as $key => $item)
    <tbody>
      <tr>
        <th scope="row">{{$key + 1}}</th>
        <td>{{$item->name}}</td>
        <td>{{$item->email}}</td>
        <td>{{$item->phone}}</td>
        <td>{{$item->dob}}</td>
        <td>{{$item->orders->count()}}</td>
      </tr>
    </tbody>
  @endforeach
  </table>
</div>


@endsection



