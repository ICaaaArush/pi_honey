@extends('front.layouts.main')


@section('content')


<div class="container-fluid">
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Quantity</th>
        <th scope="col">Costing</th>
        <th scope="col">Price</th>
        <th scope="col">Profit</th>
        <th scope="col">Category</th>
        <th scope="col">Bar Code</th>
        <th scope="col">Delete</th>
        <th scope="col">Edit</th>
        <th scope="col">Barcode</th>
      </tr>
    </thead>
    @foreach($listings as $listing)
    <tbody>
      <tr>
        <th scope="row">{{$listing->id}}</th>
        <td>{{$listing->name}}</td>
        <td>{{$listing->quantity}}</td>
        <td>{{$listing->cost}}</td>
        <td>
        <form class="container-fluid" action="{{route('ma-save-price')}}" method="post">
        @csrf
        <!-- <input type="hidden" name="productId" value="{{$listing->id}}">
        <input type="text" name="price" id="price" value="{{$listing->price}}"> -->
        <button type="btn btn-danger" id="butsave">Set Price</button>
        </form>
        </td>
        <td>{{$listing->profit}}</td>
        <td>{{$listing->product->category->category_name}}</td>
        <td>{{$listing->bar_code_ma}}</td>
        <td>
        <a href="{{route('delete-main',[$listing->id])}}" class="btn btn-danger fa fa-trash">Delete</a>
        </td>
        <td>
        <a href="{{route('ma-edit',[$listing->id])}}" class="btn btn-danger fa fa-trash">Edit</a>
        </td>
        <td>
        <?php
          echo DNS1D::getBarcodeSVG($listing->bar_code_ma, 'C39');
          // echo DNS1D::getBarcodePNGPath($listing->bar_code_ma, 'PHARMA2T');
          // echo DNS2D::getBarcodeHTML($listing->bar_code_ma, 'QRCODE');
        ?>
        </td>
      </tr>
    </tbody>
  @endforeach
  </table>
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

  function deleteFunction(id) {
     // body...
  }







</script>


@endsection

