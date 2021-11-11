<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
      content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">


    <title>Pos System</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
      rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />


    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="{{asset('assets/css/sleek.css')}}" />


    <!-- FAVICON -->
    <link href="{{asset('assets/img/favicon.png')}}" rel="shortcut icon" />


  </head>


  <body class="sidebar-fixed sidebar-dark header-light header-fixed" id="body">

    <div class="mobile-sticky-body-overlay"></div>
    <div class="wrapper">
      <!--
          ====================================
          ——— LEFT SIDEBAR WITH FOOTER
          =====================================
        -->
      <aside class="left-sidebar bg-sidebar">
        <div id="sidebar" class="sidebar">
          <!-- Aplication Brand -->
          <div class="app-brand">
            <a href="{{ route('dashboard') }}">
              <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33"
                viewBox="0 0 30 33">
                <g fill="none" fill-rule="evenodd">
                  <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                  <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                </g>
              </svg>
              <span class="brand-name">Dashboard</span>
            </a>
          </div>
          <!-- begin sidebar scrollbar -->
          <div class="sidebar-scrollbar">
            @if (Auth::user()->role == 'supmin')
                <!-- sidebar menu -->
                <ul class="nav sidebar-inner" id="sidebar-menu">
                  <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#documentation"
                      aria-expanded="false" aria-controls="documentation">
                      <i class="mdi mdi-book-open-page-variant"></i>
                      <span class="nav-text">Super Admin</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="documentation" data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        <li class="section-title">
                          Delivery Company
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('del-com-list')}}">
                            <span class="nav-text">Delivery Company Listing</span>
                          </a>
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('add-del-com')}}">
                            <span class="nav-text">Add Delivery Company</span>
                          </a>
                        </li>
                        <li class="section-title">
                          Category
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('add-category')}}">
                            <span class="nav-text">Add Category</span>
                          </a>
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('category-list')}}">
                            <span class="nav-text">Category List</span>
                          </a>
                        </li>
                        <li class="section-title">
                          Colors
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('color-list')}}">
                            <span class="nav-text">Color List</span>
                          </a>
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('add-color')}}">
                            <span class="nav-text">Add Color</span>
                          </a>
                        </li>
                        <li class="section-title">
                          Brands
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('brand-list')}}">
                            <span class="nav-text">Brand Listing</span>
                          </a>
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('add-brand')}}">
                            <span class="nav-text">Add Brand</span>
                          </a>
                        </li>
                        <li class="section-title">
                          Sizes
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('size-list')}}">
                            <span class="nav-text">Size Listing</span>
                          </a>
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('add-size')}}">
                            <span class="nav-text">Add Size</span>
                          </a>
                        </li>
                        <li class="section-title">
                          Qualities
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('quality-list')}}">
                            <span class="nav-text">Quality Listing</span>
                          </a>
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('add-quality')}}">
                            <span class="nav-text">Add Quality</span>
                          </a>
                        </li>
                      </div>
                    </ul>
                  </li>
                </ul>
            @endif
            @if (Auth::user()->role == 'supmin' || Auth::user()->role =='supplier')
                <!-- sidebar menu -->
                <ul class="nav sidebar-inner" id="sidebar-menu">
                  <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#documentation2"
                      aria-expanded="false" aria-controls="documentation2">
                      <i class="mdi mdi-book-open-page-variant"></i>
                      <span class="nav-text">Supply Handler</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="documentation2" data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        <li class="section-title">
                          Product
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('sh-add-product')}}">
                            <span class="nav-text">Add Product</span>
                          </a>
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('sh-product-list')}}">
                            <span class="nav-text">Product List</span>
                          </a>
                        </li>


                        <li class="section-title">
                          Supplier
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('sh-add-supplier')}}">
                            <span class="nav-text">Add Supplier</span>
                          </a>
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('sh-supplier-list')}}">
                            <span class="nav-text">Supplier List</span>
                          </a>
                        </li>
                      </div>
                    </ul>
                  </li>
                </ul>
            @endif
            @if (Auth::user()->role == 'supmin' || Auth::user()->role =='de')
                <!-- sidebar menu -->
                <ul class="nav sidebar-inner" id="sidebar-menu">
                  <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#documentation3"
                      aria-expanded="false" aria-controls="documentation3">
                      <i class="mdi mdi-book-open-page-variant"></i>
                      <span class="nav-text">Data Entry Handler</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="documentation3" data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        <li class="section-title">
                          Product
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('de-product-list')}}">
                            <span class="nav-text">Product List</span>
                          </a>
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('de-add-order')}}">
                            <span class="nav-text">Add Order</span>
                          </a>
                        </li>
                      </div>
                    </ul>
                  </li>
                </ul>
            @endif
            @if (Auth::user()->role == 'supmin' || Auth::user()->role =='manager')
                <!-- sidebar menu -->
                <ul class="nav sidebar-inner" id="sidebar-menu">
                  <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#documentation4"
                      aria-expanded="false" aria-controls="documentation4">
                      <i class="mdi mdi-book-open-page-variant"></i>
                      <span class="nav-text">Manager Products</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="documentation4" data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        <li class="section-title">
                          Product
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('ma-add-product')}}">
                            <span class="nav-text">Add Product</span>
                          </a>
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('ma-product-list')}}">
                            <span class="nav-text">Product List</span>
                          </a>
                        </li>
                        <li>
                          <a class="sidenav-item-link" href="{{route('ma-sorted-product-list')}}">
                            <span class="nav-text">Sorted Product List</span>
                          </a>
                        </li>
                      </div>
                    </ul>
                  </li>
                </ul>
            @endif





          </div>

        </div>
      </aside>
<div class="page-wrapper pt-0">
  @if(session()->has('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> {{ session()->get('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  @endif
  @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session()->get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  @endif  
      @yield('content')
</div>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>




    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/slimscrollbar/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/js/sleek.bundle.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/jsbarcode@latest/dist/JsBarcode.all.min.js"></script>

    @yield('js')

    @yield('modal')

  </body>

</html>
