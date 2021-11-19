<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
      content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">


    <title>Quickie Twinkle</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
      rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />


    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="{{asset('assets/css/sleek.css')}}" />


    <!-- FAVICON -->
    <link href="{{asset('assets/img/favicon.png')}}" rel="shortcut icon" />

    @yield('header_style')
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
          <div class="app-brand" style="background: #fff;">
            <a href="{{ route('dashboard') }}">
              <img style="max-width: 200px !important;" class="img-fluid" src="{{asset('logo.png')}}">
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
                    <ul class="collapse {{ \Request::is('supmin/*') ? 'show' : '' }} " id="documentation" data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        <li class="section-title">
                          Delivery Company
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'del-com-list') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('del-com-list')}}">
                            <span class="nav-text">Delivery Company Listing</span>
                          </a>
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'add-del-com') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('add-del-com')}}">
                            <span class="nav-text">Add Delivery Company</span>
                          </a>
                        </li>
                        <li class="section-title">
                          Category
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'add-category') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('add-category')}}">
                            <span class="nav-text">Add Category</span>
                          </a>
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'category-list') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('category-list')}}">
                            <span class="nav-text">Category List</span>
                          </a>
                        </li>
                        <li class="section-title">
                          SubCategory
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'add-sub-category') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('add-sub-category')}}">
                            <span class="nav-text">Add SubCategory</span>
                          </a>
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'sub-category-list') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('sub-category-list')}}">
                            <span class="nav-text">SubCategory List</span>
                          </a>
                        </li>
                        <li class="section-title">
                          Colors
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'color-list') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('color-list')}}">
                            <span class="nav-text">Color List</span>
                          </a>
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'add-color') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('add-color')}}">
                            <span class="nav-text">Add Color</span>
                          </a>
                        </li>
                        <li class="section-title">
                          Brands
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'brand-list') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('brand-list')}}">
                            <span class="nav-text">Brand Listing</span>
                          </a>
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'add-brand') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('add-brand')}}">
                            <span class="nav-text">Add Brand</span>
                          </a>
                        </li>
                        <li class="section-title">
                          Sizes
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'size-list') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('size-list')}}">
                            <span class="nav-text">Size Listing</span>
                          </a>
                        </li>
                        <li class {{ (\Request::route()->getName() == 'add-size') ? 'active' : '' }}
                          <a class="sidenav-item-link" href="{{route('add-size')}}">
                            <span class="nav-text">Add Size</span>
                          </a>
                        </li>
                        <li class="section-title">
                          Qualities
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'quality-list') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('quality-list')}}">
                            <span class="nav-text">Quality Listing</span>
                          </a>
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'add-quality') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('add-quality')}}">
                            <span class="nav-text">Add Quality</span>
                          </a>
                        </li>
                        <li class="section-title">
                          Branch
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'branch-list') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('branch-list')}}">
                            <span class="nav-text">Branch Listing</span>
                          </a>
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'add-branch') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('add-branch')}}">
                            <span class="nav-text">Add Branch</span>
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
                      <span class="nav-text">Supply Dept.</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse {{ \Request::is('supply-handler/*') ? 'show' : '' }}" id="documentation2" data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        <li class="section-title">
                          Supply
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'sh-add-product') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('sh-add-product')}}">
                            <span class="nav-text">Add Supply</span>
                          </a>
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'sh-product-list') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('sh-product-list')}}">
                            <span class="nav-text">Supply List</span>
                          </a>
                        </li>


                        <li class="section-title">
                          Supplier
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'sh-add-supplier') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('sh-add-supplier')}}">
                            <span class="nav-text">Add Supplier</span>
                          </a>
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'sh-supplier-list') ? 'active' : '' }}">
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
                      <span class="nav-text">Product Entry, Sales <br> & Return</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse {{ \Request::is('data-entry/*') ? 'show' : '' }}" id="documentation3" data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        <li class="section-title">
                          Product
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'de-product-list') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('de-product-list')}}">
                            <span class="nav-text">Product List / Add Product</span>
                          </a>
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'de-add-order') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('de-add-order')}}">
                            <span class="nav-text">Add Order</span>
                          </a>
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'de-add-return-product') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('de-add-return-product')}}">
                            <span class="nav-text">Return Notice</span>
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
                    <ul class="collapse {{ \Request::is('manager/*') ? 'show' : '' }}" id="documentation4" data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        <li class="section-title">
                          Product
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'ma-add-product') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('ma-add-product')}}">
                            <span class="nav-text">Add Product</span>
                          </a>
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'ma-product-list') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('ma-product-list')}}">
                            <span class="nav-text">Product List</span>
                          </a>
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'ma-sorted-product-list') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('ma-sorted-product-list')}}">
                            <span class="nav-text">Sorted Product List</span>
                          </a>
                        </li>
                        <li class=" {{ (\Request::route()->getName() == 'ma-return-product-list') ? 'active' : '' }}">
                          <a class="sidenav-item-link" href="{{route('ma-return-product-list')}}">
                            <span class="nav-text">Return Received</span>
                          </a>
                        </li>
                      </div>
                    </ul>
                  </li>
                </ul>
            @endif
            <ul class="nav sidebar-inner" id="sidebar-menu">
              <li class="has-sub {{ (\Request::route()->getName() == 'orders') ? 'active' : '' }}">
                <a class="sidenav-item-link" href="{{ route('orders') }}">
                  <i class="mdi mdi-book-open-page-variant"></i>
                  <span class="nav-text">Orders</span>
                </a>
              </li>
            </ul>
            <ul class="nav sidebar-inner" id="sidebar-menu">
              <li class="has-sub {{ (\Request::route()->getName() == 'customers') ? 'active' : '' }}">
                <a class="sidenav-item-link" href="{{ route('customers') }}">
                  <i class="mdi mdi-book-open-page-variant"></i>
                  <span class="nav-text">Customers</span>
                </a>
              </li>
            </ul>
            <ul class="nav sidebar-inner" id="sidebar-menu">
              <li class="has-sub">
                <a class="sidenav-item-link" href="{{ route('logout') }}">
                  <i class="mdi mdi-book-open-page-variant"></i>
                  <span class="nav-text">Log Out</span>
                </a>
              </li>
            </ul>




          </div>

        </div>
      </aside>
<div class="page-wrapper pt-0">
  <div id="toggle">
    <a style="width: 20px; padding: 12px;padding-right: 25px;" class="btn btn-success" onclick="hide()" href="#"><<</a>
  </div>
  

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

    <script>
      function hide(){
        $('aside').hide();
        $('.page-wrapper').css('padding-left', '0px');

        var change = `<a style="width: 20px; padding: 12px;padding-right: 25px;" class="btn btn-success" onclick="show()" href="#">>></a>`;

        $('#toggle').html(change);
      }

      function show(){
        $('aside').show();
        $('.page-wrapper').css('padding-left', '15.6rem');

        var change = `<a style="width: 20px; padding: 12px;padding-right: 25px;" class="btn btn-success" onclick="hide()" href="#"><<</a>`;

        $('#toggle').html(change);
      }
    </script>

    @yield('js')

    @yield('modal')

  </body>

</html>
