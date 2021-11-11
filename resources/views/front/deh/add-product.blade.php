@extends('front.layouts.main')


@section('content')
  <div class="container-fluid">
    <form action="{{route('de-insert-product')}}" method="post">
      @csrf
      <br>
      <br>
      <div class="form-row">
        <div class="form-group col-md-12">
          <label for="inputEmail4">Product Code</label>
          <input type="text" class="form-control" id="code" name="name" placeholder="Enter Code">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Add</button>
    </form>
  </div>
  <form action="{{ route('de-place-order') }}" method="POST">
    @csrf
    <div id="adds" class="row justify-content-center" style="margin-top: 50px;">
      <div class="col-md-5" style="border: 1px solid #000;text-align: center;font-size: 17px;color: #000;padding: 5px 0px;background: #fff">
        <span> <b>Product Name</b> </span>
      </div>
      <div class="col-md-2" style="border: 1px solid #000;text-align: center;font-size: 17px;color: #000;padding: 5px 0px;background: #fff">
        <span> <b>Unit Price</b> </span>
      </div>
      <div class="col-md-2" style="border: 1px solid #000;text-align: center;font-size: 17px;color: #000;padding: 5px 0px;background: #fff">
        <span> <b>Quantity</b> </span>
      </div>
    </div>
    <div class="row justify-content-center" style="margin-top: 0px;">
      <div class="col-md-7" style="border: 1px solid #000;text-align: center;font-size: 17px;color: #000;padding: 5px 0px;background: #fff">
        <b>Total Cost</b>
      </div>
      <div class="col-md-2" style="border: 1px solid #000;text-align: center;font-size: 17px;color: #000;padding: 5px 0px;background: #fff">
        <span> <b id="total">0</b> </span>
        <input type="hidden" id="totall" name="total" value="">
      </div>
    </div>
    <input type="hidden" id="index" value="0">
    <div class="row justify-content-center" style="margin-top: 50px;">
      <div class="col-md-5">
        <label for="">Customer Phone</label>
        <input type="text" name="customer_phone" class="form-control">
      </div>
      <div class="col-md-5">
        <label for="">Delivery Company</label>
        <select name="delivery_id" class="form-control">
          @foreach ($delivery as $item)
              <option value="{{ $item->id }}"> {{ $item->company_name }} </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-5">
        <label for="">Delivery Charge</label>
        <input type="text" name="delivery_charge" class="form-control">
      </div>
      <div class="col-md-5">
        <label for="">Delivery Profit</label>
        <input type="text" name="delivery_profit" class="form-control">
      </div>
      <div class="col-md-8" style="margin-top: 60px;">
        <input type="submit" value="Place Order" style="width:100%" class="btn btn-success">
      </div>
    </div>
  </div>
  </form>



@endsection

@section('js')
<script>
  $('#code').on('input', function(){
    var code = $('#code').val();

    var length = code.length;

    if( length == 10)
    {
      $.ajax({
        url: "/data-entry/de-add-product/"+code,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            html = `<div class="row">
                      <div class="col-md-6">
                        <label> Name </label>
                        <input type="text" class="form-control" value="`+res.name+`" readonly>
                      </div>
                      <div class="col-md-6">
                        <label> Price </label>
                        <input type="text" class="form-control" value="`+res.price+`" readonly>
                      </div>
                      <div class="col-md-6">
                        <label>Available Quantity </label>
                        <input type="text" class="form-control" value="`+res.quantity+`" readonly>
                      </div>
                      <div class="col-md-6">
                        <label> Quantity </label>
                        <input id="quantity" type="text" class="form-control" >
                      </div>
                    </div>`;

              $('.modal-body').html(html);
              $('.modal').modal('show');
        }
    });
    }

    
  });
</script>

<script>
  function add_prod(){

    var index = document.getElementById('index').value;

    index = index +1;

    var code = $('#code').val();

    var quantity = $('#quantity').val();

    $.ajax({
        url: "/data-entry/de-add/"+code,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            var html2 = `<div class="col-md-5" style="border: 1px solid #000;text-align: center;font-size: 17px;padding: 5px 0px;background: #fff">
                          <input type="hidden" name="product[`+index+`][id]" value="`+res.data.id+`">
                          <input type="text" value="`+res.data.name+`-`+res.color.color+`-`+res.size.size+`-`+res.brand.brand+`" class="form-control" readonly>
                         </div>
                         <div class="col-md-2" style="border: 1px solid #000;text-align: center;font-size: 17px;padding: 5px 0px;background: #fff">
                          <span>`+res.data.price+`</span>
                         </div>
                         <div class="col-md-2" style="border: 1px solid #000;text-align: center;font-size: 17px;padding: 5px 0px;background: #fff">
                          <input type="text" value="`+quantity+`" name="product[`+index+`][quantity]" class="form-control" readonly>
                         </div>`;
            $('#adds').append(html2);

            $('.modal').modal('hide');

             var pre = $('#total').text();

             var prev = parseInt(pre);

             console.log(prev);

             var to = res.data.price * quantity;

             prev = prev + to;

             document.getElementById('index').value = index;

             $('#total').html(prev);
             $('#totall').val(prev);

        }
    });
  };
</script>
@endsection

@section('modal')
    <div class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Product Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Modal body text goes here.</p>
          </div>
          <div class="modal-footer">
            <button type="button" onclick="add_prod()" class="btn btn-primary">Add To Cart</button>
          </div>
        </div>
      </div>
    </div>
@endsection