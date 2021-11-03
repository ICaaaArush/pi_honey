@extends('front.layouts.main')


@section('content')

<div class="container-fluid">
  <form action="{{route('ma-insert-product')}}" method="post">
    @csrf
    <br>
    <br>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Product Name</label>
        <input type="text" class="form-control" id="inputEmail4" name="name" placeholder="Enter Name">
      </div>
      <div class="form-group col-md-6">
        <label for="inputPassword4">Quantity</label>
        <input type="number" step="0.01" class="form-control" id="inputPassword4" name="quantity" placeholder="Enter Number">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputAddress">Supplier</label>
        <select type="select" class="form-control" id="inputAddress2" name="category_id" placeholder="Enter Category">
          @foreach($suppliers as $supplier)
          <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-row">
      <!-- <div class="form-group col-md-6">
        <label for="inputAddress2">Costing</label>
        <input type="number" step="0.01" class="form-control" id="inputAddress2" name="costing" placeholder="Enter Costing">
      </div> -->
      <div class="form-group col-md-6">
        <label for="inputAddress2">Price</label>
        <input type="number" step="0.01" class="form-control" id="inputAddress2" name="price" placeholder="Enter Price">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputAddress2">Profit</label>
        <input type="number" step="0.01" class="form-control" id="inputAddress2" name="profit" placeholder="Enter Profit">
      </div>
      <div class="form-group col-md-6">
        <label for="inputAddress2">Category</label>
        <select type="select" class="form-control" id="inputAddress2" name="category_id" placeholder="Enter Category">
          @foreach($categories as $category)
          <option value="{{$category->id}}">{{$category->category_name}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="inputAddress2">Sub Category</label>
        <select type="select" class="form-control" id="inputAddress2" name="category_id" placeholder="Enter Category">
          @foreach($categories as $category)
          <option value="{{$category->id}}">{{$category->category_name}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="inputAddress2">Barcode</label>
      <input type="text" class="form-control" id="inputAddress2" name="m_barcode" placeholder="Enter Barcode">
    </div>
    <button type="submit" class="btn btn-primary">Add</button>
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
@endsection