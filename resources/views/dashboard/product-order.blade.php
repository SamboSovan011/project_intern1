@extends('dashboard.app')
@section('title', 'Potted Pan - Product Order')
@section('content')
<style>
    #button-row {
        padding: 1rem;
        display: flex;
        justify-content: flex-end;
        align-items: flex-end;
    }


    .example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
    }

    .example-modal .modal {
        background: transparent !important;
    }

    .context {
        padding: 7rem 2rem;
    }

    .box {
        border: none;
    }

    .grand {
        border: none;
        background: #fff;
    }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Product Order
        <small>Your product order that you accepted are here!</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product Order</li>
    </ol>
</section>

{{-- <section>
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        {{ session()->get('success') }}
</div>
@elseif(session()->has('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i> Fail!</h4>
    {{session()->get('error')}}
</div>
@endif
</section> --}}
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- /.box -->

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Product Orders</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="dataTableOrder" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Accept / Cancel By</th>
                                <th>Customer Email</th>
                                <th>Subtotal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $subtotal = 0;
                            $total = 0;
                            @endphp
                            {{-- @if (is_array($productItems) || is_object($productItems)) --}}
                            @foreach ($proOrders as $order)
                            {{-- @if (is_array($proitem->review) || is_object($proitem->review)) --}}

                            <tr>
                                <td>
                                    {{$order->_token}}
                                </td>
                                <td>
                                    {{$order->acceptBy}}
                                </td>
                                <td>
                                    {{$order->users->email}}
                                </td>
                                @php
                                $subtotal = array_sum($proLists->where('_token',
                                $order->_token)->pluck('subtotal')->toArray());
                                $total = array_sum($proLists->where('_token',
                                $order->_token)->pluck('total')->toArray());

                                @endphp

                                <td>{{$subtotal}}</td>
                                <td>{{$total}}</td>
                                <td>

                                    @if($order->status == 2)
                                    <span class="label label-success">Accept</span>
                                    @elseif($order->status == 1)
                                    <span class="label label-warning">Pending</span>
                                    @elseif($order->status == 3)
                                    <span class="label label-warning">Delievered</span>
                                    @elseif($order->status == 4)
                                    <span class="label label-warning">Can't Delievered</span>
                                    @else
                                    <span class="label label-danger">Cancel</span>
                                    @endif

                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown">
                                            <span>Action</span>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @if (Auth::user()->is_admin == 1)

                                            <li><a href="{{route('cancelCheckout', ['id' => $order->_token])}}"><span
                                                        class="text-yellow glyphicon glyphicon-remove">Cancel</span></a>
                                            </li>
                                            @endif
                                            <li><a href="{{route('Not-Deliever', ['id' => $order->_token])}}"><span
                                                        class="text-yellow glyphicon glyphicon-remove">Can't&nbsp;Deliever</span></a>
                                            </li>
                                            <li>
                                                <a data-toggle="modal" data-target="#checkoutModal" href=""
                                                    title="View Product">
                                                    <span class="text-blue fa fa-fw fa-edit view"
                                                        data-url="{{route('Deliever', ['token' => $order->_token])}}"
                                                        data-token="{{$order->_token}}" data-subtotal="{{$subtotal}}"
                                                        data-total="{{$total}}">View</span>
                                                </a>


                                            </li>
                                            <li>
                                                <a data-toggle="modal" data-target="#myModal">
                                                    <span
                                                        data-url="{{route('deleteCheckout', ['id' => $order->_token])}}"
                                                        class="text-red glyphicon glyphicon-trash delete-btn">Delete</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                            {{-- @endif --}}

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Order ID</th>
                                <th>Accept / Cancel By</th>
                                <th>Customer Email</th>
                                <th>Subtotal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete?</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Do you want to delete this item?
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <a id="delete-item" href="">
                        <button type="button" class="btn btn-danger">Delete</button>
                    </a>

                </div>

            </div>
        </div>
    </div>


    {{-- modal --}}
    <div class="modal" id="checkoutModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Product Order Detail</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="orderForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h2>Order Information:</h2>
                        <span>Accepted / Canceled By:
                            <input class="or-accept form-control" type="text" value="" readonly>
                        </span>
                        <br>
                        <span>Name:
                            <input class="or-name form-control" type="text" value="" readonly>
                        </span>
                        <br>
                        <span>Eamil 1:
                            <input class="or-email1 form-control" type="text" value="" readonly>
                        </span>
                        <br>
                        <span>Email 2:
                            <input class="or-email2 form-control" type="text" value="" readonly>
                        </span>
                        <br>
                        <span>Phone 1:
                            <input class="or-phone1 form-control" type="text" value="" readonly>
                        </span>
                        <br>
                        <span>Phone 2:
                            <input class="or-phone2 form-control" type="text" value="" readonly>
                        </span>
                        <br>
                        <span>Address 1:
                            <input class="or-address1 form-control" type="text" value="" readonly>
                        </span>
                        <br>
                        <span>Address 2:
                            <input class="or-address2 form-control" type="text" value="" readonly>
                        </span>
                        <br>
                        <span>Country:
                            <input class="or-country form-control" type="text" value="" readonly>
                        </span>
                        <br>
                        <span>City:
                            <input class="or-city form-control" type="text" value="" readonly>
                        </span>
                        <br>
                        <span>Ordered Date:
                            <input class="or-date form-control" type="text" value="" readonly>
                        </span>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Delivery Date:</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input name="deliverDate" type="text" class="form-control pull-right"
                                            id="deliverdate" required>

                                    </div>
                                    <span class="text-red" id="deliverErrorM" hidden>Delivery Date can't be before
                                        today</span>
                                </div>

                            </div>
                        </div>
                        <div>
                            <table id="tableOrder" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>SKU</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Subtotal</th>
                                        <th>Total</th>
                                    </tr>

                                </thead>
                                <tbody class="tableOrderListing">

                                </tbody>
                            </table>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <b>Shipping Price: $0</b>
                                <br>
                                <b>Grand Subtotal:
                                    $<input class="grand-sub grand" type="text" value="">
                                </b>
                                <br>
                                <b>Grand Total:
                                    $<input class="grand-total grand" type="text" value="">
                                </b>
                                <br>
                            </div>
                        </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-success accept-btn">Delieverd</button>


                </div>
                </form>





            </div>
        </div>
    </div>
    <!-- /.modal -->
</section>
<!-- /.content -->
{{-- @if (count($errors) > 0)
<script>
    $(document).ready(function () {
        $('#editForm').modal('show');
    });

</script>
@endif --}}
<script>
    $(function () {
        $('#dataTableOrder').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'info': true,
            'autoWidth': false,
            'ordering': true,

        })

    })

    $(document).on('click', '.delete-btn', function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        $('#delete-item').attr('href', url);
    });
    //Date Picker
    $(function () {

        $('#deliverdate').datepicker({
        autoclose: true
        })



        })


        $('#deliverdate').change(function(){

        var deliverDate = new Date($(this).val());
        var currentDate = new Date();


        if(deliverDate < currentDate){
            $('#deliverErrorM').attr('hidden', false);
            $('.accept-btn').attr('disabled', true);

        }else{
            $('#deliverErrorM').attr('hidden', true);
            $('.accept-btn').attr('disabled', false);

        }
        })





    $(document).on('click', '.view', function(e){
        e.preventDefault();
        var token = $(this).data('token');
        var subtotal = $(this).data('subtotal');
        var total = $(this).data('total');
        var url = $(this).data('url');
        // console.log(token);
        $.ajax({
            url: "/admin/dashboard/admin-tool/getcheckout/" + token,
            type: "GET",
            dataType: "json",
            contentType:'application/json',
            success:function(html){
            $('.or-accept').val(html.checkout.acceptBy);
            $('.or-name').val(html.checkout.fullname);
            $('.or-email1').val(html.checkout.email1);
            $('.or-email2').val(html.checkout.email2);
            $('.or-phone1').val(html.checkout.phone1);
            $('.or-phone2').val(html.checkout.phone2);
            $('.or-address1').val(html.checkout.address1);
            $('.or-address2').val(html.checkout.address2);
            $('.or-country').val(html.checkout.country);
            $('.or-city').val(html.checkout.city_province);
            $('.or-date').val(html.checkout.updated_at);
            $('#deliverdate').val(html.checkout.delivery_date);
            $('.grand-sub').val(subtotal);
            $('.grand-total').val(total);
            $('#orderForm').attr('action', url);
            $('.or-proname').remove();
            $('.or-sku').remove();
            $('.or-qty').remove();
            $('.or-price').remove();
            $('.or-subtotal').remove();
            $('.or-total').remove();

            $.each(html.proItem, function (key, val){
                $.each(val.products, function(key1, val1){
                    $('.tableOrderListing').append("<tr>"+
                        "<td class='or-proname'>"+val1.name+"</td>"+
                        "<td class='or-sku'>"+val1.SKU+"</td>"+
                        "<td class='or-qty'>"+val.qty+"</td>"+
                        "<td class='or-price'>"+val1.price+"</td>"+
                        "<td class='or-subtotal'>"+val.subtotal+"</td>"+
                        "<td class='or-total'>"+val.total+"</td>"+
                                +"</tr>"
                                )
                            })

                        })
                    },error:function(err){
                        console.log('Error loading data');
                     }
                });
            });

</script>

<script>
    @if(Session::has('success'))
    toastr.success("{{Session::get('success')}}");
    @elseif(Session::has('error'))
    toastr.error("{{Session::get('error')}}")
    @endif

</script>
@endsection
