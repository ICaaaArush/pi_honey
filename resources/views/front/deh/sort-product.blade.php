@extends('front.layouts.main')

@section('header_style')
    <style>
    #start .form-row{
    background: #8e8e8e;
    }
    #start .form-row input{
    background: #a7a7a7;
    }
    #start .form-row select{
    background: #a7a7a7;
    }
    #start .form-row:last-child{
    background: #fff;
    }
    #start .form-row:last-child input{
    background: #fff;
    }
    #start .form-row:last-child select{
    background: #fff;
    }
    .trash {
    margin-top: 30px;
    }
    </style>
@endsection
@section('content')
  <div class="container-fluid">
      <br>
      <br>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputPassword4">Quantity</label>
          <input type="number" step="0.01" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}" readonly>
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Total Sorted</label>
          <input type="number" step="0.01" class="form-control" id="total_sorted" value="{{ $product->total_sorted }}" readonly>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputAddress">Supplier</label>
          <input type="text" class="form-control" id="inputPassword4" name="supplier" value="{{ $product->supplier->id }}" readonly>
        </div>
        <div class="form-group col-md-6">
            <label for="inputAddress">Category</label>
            <input type="text" class="form-control" id="inputPassword4" name="category" value="{{ $product->category->category_name }}" readonly>
        </div>
      </div>
      <form action="{{route('de-insert-product')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="branch_id" value="{{ $product->branch_id }}">
        <div id="start">
            @if ($sorts != null)
                @foreach ($sorts as $sort)
                <div class="form-row">
                  <div class="form-group col-md-2">
                    <img src="{{ asset('public/'.$sort->pic) }}" class="img-fluid" id="output" style="width: 50px" alt="">
                    <label for="inputAddress">Product Image</label>
                    <input accept="image/*" type="file" class="form-control file" id="inputPassword4" name="product[{{ $sort->id }}][pic]" value="{{ $sort->pic }}">
                </div>
                  <div class="form-group col-md-2">
                      <label for="inputAddress">Product Description</label>
                      <input type="text" class="form-control" id="inputPassword4" name="product[{{ $sort->id }}][description]" value="{{ $sort->description }}">
                  </div>
                  <div class="form-group col-md-2">
                      <label for="inputAddress">Quantity</label>
                      <input type="text" class="form-control" id="quantity" name="product[{{ $sort->id }}][quantity]" value="{{ $sort->quantity }}">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="inputAddress">Sub Category</label>
                    <select class="form-control" name="product[{{ $sort->id }}][sub_category_id]">
                      @foreach ($sub_category as $item)
                          <option {{ $sort->sub_category_id == $item->id ? "selected":"" }}  value="{{ $item->id }}">{{ $item->sub_category }}</option>
                      @endforeach
                    </select>
                </div>
                  <div class="form-group col-md-1">
                      <label for="inputAddress">Brand</label>
                      <select class="form-control" name="product[{{ $sort->id }}][brand]">
                        @foreach ($brand as $item)
                            <option {{ $sort->brand_id == $item->id ? "selected":"" }}  value="{{ $item->id }}">{{ $item->brand }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="form-group col-md-1">
                    <label for="inputAddress">Color</label>
                    <select class="form-control" name="product[{{ $sort->id }}][color]">
                      @foreach ($color as $item)
                          <option {{ $sort->color_id == $item->id ? "selected":"" }} value="{{ $item->id }}">{{ $item->color }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-1">
                    <label for="inputAddress">Size</label>
                    <select class="form-control" name="product[{{ $sort->id }}][size]">
                      @foreach ($size as $item)
                          <option {{ $sort->size_id == $item->id ? "selected":"" }} value="{{ $item->id }}">{{ $item->size }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-1">
                    <a class="btn btn-primary edit" href="#"><b>edit</b></a>
                    <a class="btn btn-danger trash" href="#"><b>X</b></a>
                </div>
              </div>
                @endforeach
            @endif
            <div class="form-row">
                <input type="hidden" value="1" id="index">
                <input type="hidden" value="{{ $product->id }}" name="id">
                <input type="hidden" value="{{ $product->quantity }}" name="quantity">
                <input type="hidden" value="{{ $product->costing }}" name="cost">
                <div class="form-group col-md-2">
                  <img  class="img-fluid" id="output" style="width: 50px" alt="">
                  <label for="inputAddress">Product Image</label>
                  <input accept="image/*" type="file" class="form-control file" id="inputPassword4" name="product[0][pic]">
              </div>
                <div class="form-group col-md-2">
                    <label for="inputAddress">Product Description</label>
                    <input type="text" class="form-control" id="inputPassword4" name="product[0][description]" value="">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputAddress">Quantity</label>
                    <input type="text" class="form-control" id="quantity" name="product[0][quantity]" value="">
                </div>
                <div class="form-group col-md-2">
                  <label for="inputAddress">Sub Category</label>
                  <select class="form-control" name="product[0][sub_category_id]">
                    @foreach ($sub_category as $item)
                        <option value="{{ $item->id }}">{{ $item->sub_category }}</option>
                    @endforeach
                  </select>
              </div>
                <div class="form-group col-md-1">
                    <label for="inputAddress">Brand</label>
                    <select class="form-control" name="product[0][brand]">
                      @foreach ($brand as $item)
                          <option value="{{ $item->id }}">{{ $item->brand }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group col-md-1">
                  <label for="inputAddress">Color</label>
                  <select class="form-control" name="product[0][color]">
                    @foreach ($color as $item)
                        <option value="{{ $item->id }}">{{ $item->color }}</option>
                    @endforeach
                  </select>
              </div>
              <div class="form-group col-md-1">
                <label for="inputAddress">Size</label>
                <select class="form-control" name="product[0][size]">
                  @foreach ($size as $item)
                      <option value="{{ $item->id }}">{{ $item->size }}</option>
                  @endforeach
                </select>
            </div>
                <div class="form-group col-md-1 butns">
                    <a style="margin-top: 30px;" class="btn btn-success" onclick="addproduct()" href="#"> <b>+ </b> </a>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputAddress">Rejected Product reason</label>
                <input type="text" class="form-control" id="inputPassword4" name="reject reason" value="">
            </div>
            <div class="form-group col-md-6">
                <label for="inputAddress">Rejected Product Quantity</label>
                <input type="text" class="form-control" id="inputPassword4" name="rejectquantity" value="">
            </div>
        </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>



@endsection

@section('js')

<script>
  // $('.form-group').on('input', '#quantity',function(){
  //   total = document.getElementById('total_sorted').value;

  //   vall = $(this).closest('.form-group').find('input').val();

  //   valo = parseInt(vall);

  //   tot = parseInt(total)


  //   $('#total_sorted').val( tot + valo);
  // });
</script>

<script>
  $('#start').on('change', '.file',function(event) {
    output = $(this).closest('.form-group').find('img');
    console.log(URL.createObjectURL(event.target.files[0]));
    output.attr('src',URL.createObjectURL(event.target.files[0]));
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  });
</script>

<script>
  var $table = $('#table')
  var $remove = $('#remove')
  var selections = []

  function getIdSelections() {
    return $.map($table.bootstrapTable('getSelections'), function (row) {
      return row.id
    })
  }

  function responseHandler(res) {
    $.each(res.rows, function (i, row) {
      row.state = $.inArray(row.id, selections) !== -1
    })
    return res
  }

  function detailFormatter(index, row) {
    var html = []
    $.each(row, function (key, value) {
      html.push('<p><b>' + key + ':</b> ' + value + '</p>')
    })
    return html.join('')
  }

  function operateFormatter(value, row, index) {
    return [
      '<a class="like" href="javascript:void(0)" title="Like">',
      '<i class="fa fa-heart"></i>',
      '</a>  ',
      '<a class="remove" href="javascript:void(0)" title="Remove">',
      '<i class="fa fa-trash"></i>',
      '</a>'
    ].join('')
  }

  window.operateEvents = {
    'click .like': function (e, value, row, index) {
      alert('You click like action, row: ' + JSON.stringify(row))
    },
    'click .remove': function (e, value, row, index) {
      $table.bootstrapTable('remove', {
        field: 'id',
        values: [row.id]
      })
    }
  }

  function totalTextFormatter(data) {
    return 'Total'
  }

  function totalNameFormatter(data) {
    return data.length
  }

  function totalPriceFormatter(data) {
    var field = this.field
    return '$' + data.map(function (row) {
      return +row[field].substring(1)
    }).reduce(function (sum, i) {
      return sum + i
    }, 0)
  }

  function initTable() {
    $table.bootstrapTable('destroy').bootstrapTable({
      height: 550,
      locale: $('#locale').val(),
      columns: [
        [{
          field: 'state',
          checkbox: true,
          rowspan: 2,
          align: 'center',
          valign: 'middle'
        }, {
          title: 'Item ID',
          field: 'id',
          rowspan: 2,
          align: 'center',
          valign: 'middle',
          sortable: true,
          footerFormatter: totalTextFormatter
        }, {
          title: 'Item Detail',
          colspan: 3,
          align: 'center'
        }],
        [{
          field: 'name',
          title: 'Item Name',
          sortable: true,
          footerFormatter: totalNameFormatter,
          align: 'center'
        }, {
          field: 'price',
          title: 'Item Price',
          sortable: true,
          align: 'center',
          footerFormatter: totalPriceFormatter
        }, {
          field: 'operate',
          title: 'Item Operate',
          align: 'center',
          clickToSelect: false,
          events: window.operateEvents,
          formatter: operateFormatter
        }]
      ]
    })
    $table.on('check.bs.table uncheck.bs.table ' +
      'check-all.bs.table uncheck-all.bs.table',
    function () {
      $remove.prop('disabled', !$table.bootstrapTable('getSelections').length)

      // save your data, here just save the current page
      selections = getIdSelections()
      // push or splice the selections if you want to save all data selections
    })
    $table.on('all.bs.table', function (e, name, args) {
      console.log(name, args)
    })
    $remove.click(function () {
      var ids = getIdSelections()
      $table.bootstrapTable('remove', {
        field: 'id',
        values: ids
      })
      $remove.prop('disabled', true)
    })
  }

  $(function() {
    initTable()

    $('#locale').change(initTable)
  })
</script>

<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>

<script>
    function addproduct(){
        $('#start input').attr('readonly', 'readonly');
        $('#start select').attr("disabled", true);
        $('#start .file').attr("disabled", true);
        $('.butns').html('<a style="margin-top: 30px;" class="btn btn-primary edit" href="#"> <b>edit </b> </a> <a class="btn btn-danger trash" href="#"><b> X </b></a>')

        var brands = {!! json_encode($brand, JSON_HEX_TAG) !!};
        brand = [];
        brands.forEach(function (data){
          brand += ` <option value="`+data.id+`">`+data.brand+`</option>` 
        });

        var sizes = {!! json_encode($size, JSON_HEX_TAG) !!};
        size = [];
        sizes.forEach(function (data){
          size += ` <option value="`+data.id+`">`+data.size+`</option>` 
        });
        var colors = {!! json_encode($color, JSON_HEX_TAG) !!};
        color = [];
        colors.forEach(function (data){
          color += ` <option value="`+data.id+`">`+data.color+`</option>` 
        });
        var sub_categorys = {!! json_encode($sub_category, JSON_HEX_TAG) !!};
        sub_category = [];
        sub_categorys.forEach(function (data){
          sub_category += ` <option value="`+data.id+`">`+data.sub_category+`</option>` 
        });

        index = document.getElementById('index').value;

        addindex = document.getElementById('index').value = index + 1;

        html = `<div class="form-row">
          <div class="form-group col-md-2">
            <img  class="img-fluid" id="output" style="width: 50px" alt="">
            <label for="inputAddress">Product Image</label>
            <input accept="image/*" type="file" class="form-control file" id="inputPassword4" name="product[`+index+`][pic]">
          </div>
        <div class="form-group col-md-2">
            <label for="inputAddress">Product Description</label>
            <input type="text" class="form-control" id="inputPassword4" name="product[`+index+`][description]" value="">
        </div>
        <div class="form-group col-md-2">
            <label for="inputAddress">Quantity</label>
            <input type="text" class="form-control" id="quantity" name="product[`+index+`][quantity]" value="">
        </div>
        <div class="form-group col-md-2">
          <label for="inputAddress">Sub Category</label>
          <select class="form-control" name="product[`+index+`][sub_category_id]">
            `+sub_category+
            `
          </select>
        </div>
        <div class="form-group col-md-1">
          <label for="inputAddress">Brand</label>
          <select class="form-control" name="product[`+index+`][brand]">
            `+brand+
            `
          </select>
        </div>
        <div class="form-group col-md-1">
          <label for="inputAddress">Color</label>
          <select class="form-control" name="product[`+index+`][color]">
            `+color+
            `
          </select>
        </div>
        <div class="form-group col-md-1">
          <label for="inputAddress">Size</label>
          <select class="form-control" name="product[`+index+`][size]">
            `+size+
            `
          </select>
        </div>
        <div class="form-group col-md-1 butns">
            <a style="margin-top: 30px;" class="btn btn-success" onclick="addproduct()" href="#"> <b>+ </b> </a>
        </div>
        </div>`;

        $('#start').append(html);

    };

    $("#start").on('click','.trash', function () {
		$(this).closest('.form-row').remove();
		return false;
    });

    $("#start").on('click','.edit', function () {
      $(this).closest(".form-row").find("input").removeAttr('readonly');
      $(this).closest(".form-row").find("select").removeAttr('disabled');
      $(this).closest(".form-row").find(".file").removeAttr('disabled');
      $(this).closest(".form-row").attr('style', 'background: #fff');
      $(this).closest(".form-row").find("input").css('background', 'transparent');
      $(this).closest(".form-row").find("select").css('background', 'transparent');
      $(this).closest(".form-row").find("file").css('background', 'transparent');
      $(this).closest(".butns").html(`<a style="margin-top: 30px;" class="btn btn-success save" href="#"> <b>save </b> </a> <a class="btn btn-danger trash" href="#"><b> X </b></a>`);

    });

    $("#start").on('click','.save', function () {
      $(this).closest(".form-row").find("input").attr('readonly','readonly');
      $(this).closest(".form-row").find("select").attr("disabled", true);
      $(this).closest(".form-row").find(".file").attr("disabled", true);
      $(this).closest(".form-row").css('background', '#8e8e8e');
      $(this).closest(".form-row").find("input").css('background', 'transparent');
      $(this).closest(".form-row").find("select").css('background', 'transparent');
      $(this).closest(".form-row").find("file").css('background', 'transparent');
      $(this).closest(".butns").html(`<a style="margin-top: 30px;" class="btn btn-primary edit" href="#"> <b>edit </b> </a> <a class="btn btn-danger trash" href="#"><b> X </b></a>`);

    });
</script>
@endsection