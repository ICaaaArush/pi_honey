@extends('front.layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="content">
       <!-- Top Statistics -->
       <div class="row">
          <div class="col-xl-3 col-sm-6">
             <div class="card card-mini mb-4">
                <div class="card-body">
                   <h2 class="mb-1">{{ $profits }}</h2>
                   <p>Total Profit</p>
                   <div class="chartjs-wrapper">
                      <canvas id="barChart"></canvas>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-xl-3 col-sm-6">
             <div class="card card-mini  mb-4">
                <div class="card-body">
                   <h2 class="mb-1">{{ $profits_this_month }}</h2>
                   <p>Monthly Total Profit</p>
                   <div class="chartjs-wrapper">
                      <canvas id="dual-line"></canvas>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-xl-3 col-sm-6">
             <div class="card card-mini mb-4">
                <div class="card-body">
                   <h2 class="mb-1">{{ $cost }}</h2>
                   <p>Monthly Cost</p>
                   <div class="chartjs-wrapper">
                      <canvas id="area-chart"></canvas>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-xl-3 col-sm-6">
             <div class="card card-mini mb-4">
                <div class="card-body">
                   <h2 class="mb-1">{{ $order_this_month }}</h2>
                   <p>Monthly Order</p>
                   <div class="chartjs-wrapper">
                      <canvas id="line"></canvas>
                   </div>
                </div>
             </div>
          </div>
          @if (Auth::user()->role == 'manager')    
          <div class="col-xl-3 col-sm-6">
            <div class="card card-mini mb-4">
               <div class="card-body">
                  @php
                      $supply = DB::table('products')->where('status', 1 )->count();
                  @endphp
                  <h2 class="mb-1">{{ $supply }}</h2>
                  <p>Sorted Supply</p>
               </div>
            </div>
           </div>
            <div class="col-xl-3 col-sm-6">
               <div class="card card-mini mb-4">
                  <div class="card-body">
                     @php
                        $unsupply = DB::table('products')->where('status', 0 )->count();
                     @endphp
                     <h2 class="mb-1">{{ $unsupply }}</h2>
                     <p>Unsorted Supply</p>
                  </div>
               </div>
            </div>
          @endif
       </div>
       <div class="row">
          {{-- <div class="col-xl-8 col-md-12">
             <!-- Sales Graph -->
             <div class="card card-default" data-scroll-height="675">
                <div class="card-header">
                   <h2>Sales Of The Year</h2>
                </div>
                <div class="card-body">
                   <canvas id="linechart" class="chartjs"></canvas>
                </div>
                <div class="card-footer d-flex flex-wrap bg-white p-0">
                   <div class="col-6 px-0">
                      <div class="text-center p-4">
                         <h4>$6,308</h4>
                         <p class="mt-2">Total orders of this year</p>
                      </div>
                   </div>
                   <div class="col-6 px-0">
                      <div class="text-center p-4 border-left">
                         <h4>$70,506</h4>
                         <p class="mt-2">Total revenue of this year</p>
                      </div>
                   </div>
                </div>
             </div>
          </div> --}}
          <div class="col-xl-4 col-md-12">
             <!-- Doughnut Chart -->
             <div class="card card-default" data-scroll-height="675">
                <div class="card-header justify-content-center">
                   <h2>Orders Overview</h2>
                </div>
                @php
                    $month = Carbon\Carbon::now()->format('m');
                    $completed = DB::table('orders')->whereMonth('created_at',$month)->where('status',1)->count();
                    $unpaid = DB::table('orders')->whereMonth('created_at',$month)->where('status',0)->count();
                @endphp
                <div class="card-body" >
                    <input type="hidden" id="completed_order" value="{{ $completed }}">
                    <input type="hidden" id="unpaid_order" value="{{ $unpaid }}">
                   <canvas id="doChart" ></canvas>
                </div>
                {{-- <a href="#" class="pb-5 d-block text-center text-muted"><i class="mdi mdi-download mr-2"></i> Download overall report</a> --}}
                <div class="card-footer d-flex flex-wrap bg-white p-0">
                   <div class="col-6">
                      <div class="py-4 px-4">
                         <ul class="d-flex flex-column justify-content-between">
                            <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color: #80e1c1 "></i>Order Completed</li>
                            <li><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color: #4c84ff"></i>Order Unpaid</li>
                         </ul>
                      </div>
                   {{-- </div>
                   <div class="col-6 border-left"> --}}
                      {{-- <div class="py-4 px-4 ">
                         <ul class="d-flex flex-column justify-content-between">
                            <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color: #8061ef"></i>Order Pending</li>
                            <li><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color: #ffa128"></i>Order Canceled</li>
                         </ul>
                      </div> --}}
                   </div>
                </div>
             </div>
          </div>
          {{-- <div class="col-xl-4 col-lg-6 col-12">
             <!-- Polar and Radar Chart -->
             <div class="card card-default">
                <div class="card-header justify-content-center">
                   <h2>Sales Overview</h2>
                </div>
                <div class="card-body pt-0">
                   <ul class="nav nav-pills mb-5 mt-5 nav-style-fill nav-justified" id="pills-tab" role="tablist">
                      <li class="nav-item">
                         <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Sales Status</a>
                      </li>
                      <li class="nav-item">
                         <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Monthly Sales</a>
                      </li>
                   </ul>
                   <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                         <canvas id="polar"></canvas>
                      </div>
                      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                         <canvas id="radar"></canvas>
                      </div>
                   </div>
                </div>
             </div>
          </div> --}}
          <div class="col-xl-4 col-lg-6 col-12">
             <!-- Top Sell Table -->
             <div class="card card-table-border-none" data-scroll-height="550">
                <div class="card-header justify-content-between">
                   <h2>Sold by Units</h2>
                </div>
                <div class="card-body slim-scroll py-0">
                   <table class="table ">
                      <tbody>
                          @foreach ($top_products as $item)
                          <tr>
                            <td class="text-dark">{{ $item->name }}</td>
                            @php
                                $top_product_count = 0;
                                foreach($item->orders as $order)
                                {
                                    $top_product_count += $order->quantity;
                                }
                            @endphp
                            <td class="text-center">{{ $top_product_count }}</td>
                         </tr>
                          @endforeach
                      </tbody>
                   </table>
                </div>
             </div>
          </div>
          <div class="col-xl-4 col-lg-6 col-12">
            <!-- New Customers -->
            <div class="card card-table-border-none"  data-scroll-height="580">
               <div class="card-header justify-content-between ">
                  <h2>New Customers</h2>
               </div>
               <div class="card-body pt-0">
                  <table class="table ">
                     <tbody>
                         @foreach ($customers as $item)
                         <tr>
                            <td >
                               <div class="media">
                                  <div class="media-body align-self-center">
                                     <a href="#">
                                        <h6 class="mt-0 text-dark font-weight-medium">{{ $item->name }}</h6>
                                     </a>
                                     <small>{{ $item->email }}</small>
                                  </div>
                               </div>
                            </td>
                            <td >{{ $item->orders->count() }} Orders</td>
                            <td class="text-dark d-none d-md-block">{{ $item->orders->sum('total') }} BDT</td>
                         </tr>
                         @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
       </div>
       <div class="row">
          <div class="col-12">
             <!-- Recent Order Table -->
             <div class="card card-table-border-none" id="recent-orders">
                <div class="card-header justify-content-between">
                   <h2>Recent Orders</h2>
                   <div class="date-range-report ">
                      <span></span>
                   </div>
                </div>
                <div class="card-body pt-0 pb-5">
                   <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                      <thead>
                         <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th class="d-none d-md-table-cell">Order Date</th>
                            <th class="d-none d-md-table-cell">Order Cost</th>
                            <th>Status</th>
                            <th></th>
                         </tr>
                      </thead>
                      <tbody>
                          @foreach ($orders as $item)
                          <tr>
                            <td >{{ $item->id }}</td>
                            <td >
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
                            <td class="d-none d-md-table-cell">{{ Carbon\Carbon::parse($item->created_at)->format('d M, Y') }}</td>
                            <td class="d-none d-md-table-cell">{{ $item->total }} BDT</td>
                            <td >
                                @if ($item->status == 1)
                                    <span class="badge badge-success">Completed</span>
                                @else
                                    <span class="badge badge-primary">Pending</span>
                                @endif
                            </td>
                            <td class="text-right">
                               <div class="dropdown show d-inline-block widget-dropdown">
                                  <a class="dropdown-toggle icon-burger-mini" href="" role="button" id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                                     <li class="dropdown-item">
                                        <a href="#">View</a>
                                     </li>
                                     <li class="dropdown-item">
                                        <a href="#">Remove</a>
                                     </li>
                                  </ul>
                               </div>
                            </td>
                         </tr>
                          @endforeach
                      </tbody>
                   </table>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 
@endsection