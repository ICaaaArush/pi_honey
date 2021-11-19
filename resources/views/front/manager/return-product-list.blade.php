@extends('front.layouts.main')


@section('content')


<div class="container-fluid">
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Product</th>
        <th scope="col">Quantity</th>
        <th scope="col">Order ID</th>
        <th scope="col">Customer Phone</th>
        <th scope="col">Note</th>
        <th scope="col">Status</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    @foreach($data as $key => $item)
    <tbody>
      <tr>
        <th scope="row">{{$key + 1}}</th>
        <td>{{$item->main_product_barcode}}</td>
        <td>{{$item->quantity}}</td>
        <td>{{$item->order_id}}</td>
        <td>{{$item->user_phone}}</td>
        <td>{{$item->note}}</td>
        <td>
          @if ($item->status == 0)
              <b style="color:blue"> Pending </b>
          @else
              <b style="color:green"> Returned </b> 
          @endif  
        </td>
        <td>
          @if ($item->status == 0)    
          <a href="#" onclick="confirm({{ $item->id }})" class="btn btn-primary fa fa-trash">Confirm</a>
          @endif
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

  function confirm(id) {
    html = `<input type="hidden" name="id" value="`+id+`">`;

    $('#b').append(html);

    $('.modal').modal('show');
  }
</script>

<script>
  function printDiv() {
      var divContents = document.getElementById("b").innerHTML;
      var a = window.open('', '', 'height=500, width=500');
      a.document.write('<html>');
      a.document.write('<body >');
      a.document.write(divContents);
      a.document.write('</body></html>');
      a.document.close();
      a.print();
  }
</script>


@endsection

@section('modal')
    <div class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirm?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('ma-confirm-return-product') }}" method="POST" id="b">
            @csrf
            <div class="form-row justify-content-center">
              <div class="col-md-10">
                <label>Note *</label>
                  <textarea class="form-control" name="note" required></textarea> <br>
              </div>
              <div class="col-md-6">
                <input style="width:100%" type="submit" value="Confirm" class="btn btn-success">
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection