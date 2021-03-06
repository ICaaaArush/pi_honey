@extends('front.layouts.main')


@section('content')


<div class="container-fluid">
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Customer Phone Number</th>
        <th scope="col">Products</th>
        <th scope="col">Delivery Company</th>
        <th scope="col">Delivery Charge</th>
        <th scope="col">Delivery Profit</th>
        <th scope="col">Processing Percentage</th>
        <th scope="col">Processing Fee</th>
        <th scope="col">Total</th>
      </tr>
    </thead>
    @foreach($data as $key => $item)
    <tbody>
      <tr>
        <th scope="row">{{$key + 1}}</th>
        <td>{{$item->customer->phone}}</td>
        <td>
          @php
              $string = '';
              foreach($item->orderdetails as $prod)
              {
                $add = $prod->product->name.'('.$prod->quantity.')'.',';

                $string .= $add;
              }
          @endphp
          {{ $string }}
        </td>
        <td>{{$item->delivery->company_name}}</td>
        <td>{{$item->delivery_charge}}</td>
        <td>{{$item->delivery_profit}}</td>
        <td>{{$item->precessing_percentage}}</td>
        <td>{{$item->precessing_fee}}</td>
        <td>{{$item->total}}</td>
      </tr>
    </tbody>
  @endforeach
  </table>
</div>


@endsection



