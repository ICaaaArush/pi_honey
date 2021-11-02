@extends('front.layouts.main')


@section('content')
  <div class="container-fluid">
      <br>
      @if(session()->has('error'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error</strong> {{ session()->get('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        @endif 
      <br>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Product Lot Name</label>
          <input type="text" class="form-control" id="inputEmail4" name="name" value="{{ $product->name }}" readonly>
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Quantity</label>
          <input type="number" step="0.01" class="form-control" id="inputPassword4" name="quantity" value="{{ $product->quantity }}" readonly>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputAddress">Supplier</label>
          <input type="text" class="form-control" id="inputPassword4" name="supplier" value="{{ $product->supplier->supplier_name }}" readonly>
        </div>
        <div class="form-group col-md-6">
            <label for="inputAddress">Category</label>
            <input type="text" class="form-control" id="inputPassword4" name="category" value="{{ $product->category->category_name }}" readonly>
        </div>
      </div>
      <form action="{{route('de-insert-product')}}" method="post">
        @csrf
        <div id="start">
            <div class="form-row">
                <input type="hidden" value="1" id="index">
                <input type="hidden" value="{{ $product->id }}" name="id">
                <input type="hidden" value="{{ $product->quantity }}" name="quantity">
                <div class="form-group col-md-3">
                    <label for="inputAddress">Product Name</label>
                    <input type="text" class="form-control" id="inputPassword4" name="product[0][name]" value="">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputAddress">Quantity</label>
                    <input type="text" class="form-control" id="inputPassword4" name="product[0][quantity]" value="">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputAddress">Barcode</label>
                    <input type="text" class="form-control" id="inputPassword4" name="product[0][barcode]" value="">
                </div>
                <div class="form-group col-md-3">
                    <a class="btn btn-success" onclick="addproduct()" href="#">Add</a>
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
        index = document.getElementById('index').value;

        addindex = document.getElementById('index').value = index + 1;

        html = `<div class="form-row">
        <div class="form-group col-md-3">
            <label for="inputAddress">Product Name</label>
            <input type="text" class="form-control" id="inputPassword4" name="product[`+index+`][name]" value="">
        </div>
        <div class="form-group col-md-3">
            <label for="inputAddress">Quantity</label>
            <input type="text" class="form-control" id="inputPassword4" name="product[`+index+`][quantity]" value="">
        </div>
        <div class="form-group col-md-3">
            <label for="inputAddress">Barcode</label>
            <input type="text" class="form-control" id="inputPassword4" name="product[`+index+`][barcode]" value="">
        </div>
        <div class="form-group col-md-3">
            <a class="btn btn-danger trash" href="#">Remove</a>
        </div>
        </div>`;

        $('#start').append(html);

    };

    $("#start").on('click','.trash', function () {
		$(this).closest('.form-row').remove();
		return false;
    });
</script>
@endsection