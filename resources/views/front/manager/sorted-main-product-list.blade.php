@extends('front.layouts.main')


@section('content')


<div class="container-fluid">
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Picture</th>
        <th scope="col">Name</th>
        <th scope="col">Quantity</th>
        <th scope="col">Costing</th>
        <th scope="col">Price</th>
        <th scope="col">Category</th>
        <th scope="col">Bar Code</th>
        <th scope="col">Delete</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    @foreach($listings as $key => $listing)
    <tbody>
      <tr>
        <th scope="row">{{$key + 1}}</th>
        <td> <img src="{{ asset($listing->pic) }}" class="img-fluid" style="width: 50px" alt=""></td>
        <td>{{$listing->name}}</td>
        <td>{{$listing->quantity}}</td>
        <td>{{$listing->cost}}</td>
        <td>{{$listing->price}}</td>
        <td>{{$listing->product->category->category_name}}</td>
        <td> <a onclick="barcode( {{ $listing->m_barcode }} )" href="#">{{$listing->m_barcode}}</a> </td>
        <td>
        <a href="{{route('delete-main',[$listing->id])}}" class="btn btn-danger fa fa-trash">Delete</a>
        </td>
        <td>
        <a href="{{route('ma-edit',[$listing->id])}}" class="btn btn-danger fa fa-trash">Edit</a>
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
  function barcode(id)
  { 
    $('#details').empty();

    $.ajax({
        url: "/de-get-product-detail/"+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            html = `<div class="row">
                      <div class="col-md-6">
                        Company: `+res.supplier.supplier_name+` <br>
                        Color: `+res.color.color+` <br>
                        Size: `+res.size.size+`
                      </div>
                      <div class="col-md-6">
                        Category: `+res.category.category_name+` <br>
                        Price: `+res.price+`
                      </div>
                    </div>`;

                  $('#details').empty();

                  JsBarcode("#barcode", id);

                  

                  $('#details').append(html);

                  $('.modal').modal('show');
        }
    });
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
            <h5 class="modal-title">Barcode</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div id="b" class="modal-body">
            <div class="row justify-content-center">
              <div class="col-md-8">
                <svg id="barcode"></svg>
                <div id="details">

                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
              <div class="col-12" style="text-align: center">
                <a href="javascript:void" onclick="printDiv()" rel="noopener" class="btn btn-success">
                  <i class="fas fa-print"></i>
                  Print
                </a>
              </div>
          </div>
        </div>
      </div>
    </div>
@endsection