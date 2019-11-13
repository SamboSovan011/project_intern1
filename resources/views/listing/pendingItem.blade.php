@extends('dashboard.app')
@section('title', 'Potted Pan - Pending')
@section('content')
<style>
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
        Pending
        <small>All pending data is here!</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href=""><i class="fa fa-dashboard"></i>Admin Tool</a></li>
        <li class="active">Pending</li>
    </ol>
</section>


<div class="context">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#slideTab" data-toggle="tab">Slides</a></li>
            <li><a href="#cateTab" data-toggle="tab">Categories</a></li>
            <li><a href="#ProTab" data-toggle="tab">Products</a></li>
            <li><a href="#reviewTab" data-toggle="tab">Reviews</a></li>
            <li><a href="#orderTab" data-toggle="tab">Product Orders</a></li>
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="slideTab">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Banner Slides</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="dataTableSlide" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Slide Images</th>
                                    <th>User Emails</th>
                                    <th>Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($slides as $slide)
                                <tr>
                                    <td>
                                        <img src="{{asset($slide->img_path)}}" width="80px" height="70px"
                                            alt="img_slide">
                                    </td>
                                    <td>
                                        {{$slide->user_email}}
                                    </td>
                                    <td>{{$slide->title}}</td>
                                    <td>

                                        <a class="btn btn-success btn-sm"
                                            href="{{route('approveSlide', ['id' => $slide->id])}}"><span
                                                class="glyphicon glyphicon-ok">Approved</span></a>

                                    </td>
                                    <td>
                                        <a class="btn btn-danger btn-sm"
                                            href="{{route('blockSlide', ['id' => $slide->id])}}"><span
                                                class="glyphicon glyphicon-remove">Block</span></a>


                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Slide Images</th>
                                    <th>User Emails</th>
                                    <th>Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="cateTab">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Categories</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="dataTableCate" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>User Emails</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cates as $cate)
                                <tr>
                                    <td>
                                        {{$cate->title}}
                                    </td>
                                    <td>
                                        {{$cate->user_email}}
                                    </td>
                                    <td>
                                        <a class="btn btn-success btn-sm"
                                            href="{{route('approveCategory', ['id' => $cate->id])}}"><span
                                                class="glyphicon glyphicon-ok">Approved</span></a>

                                    </td>
                                    <td>
                                        <a class="btn btn-danger btn-sm"
                                            href="{{route('blockCategory', ['id' => $cate->id])}}"><span
                                                class="glyphicon glyphicon-remove">Block</span></a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Category</th>
                                    <th>User Emails</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="ProTab">


                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Products</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Product Images</th>
                                    <th>User Emails</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>SKU</th>
                                    <th>Stock</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $products)
                                <tr>
                                    <td>
                                        <a href="{{route('single-products.show', $products->id)}}" title="View Product">
                                            <img src="{{asset('storage/'. $products->image)}}" width="80px"
                                                height="70px" alt="img_slide">
                                        </a>

                                    </td>
                                    <td>
                                        {{$products->email}}
                                    </td>
                                    <td>{{$products->name}}</td>
                                    <td>{{str_limit($products->description)}}</td>

                                    <td>{{$products->price}}</td>
                                    <td>{{$products->SKU}}</td>
                                    <td>{{$products->stock}}</td>
                                    <td></td>
                                    <td>
                                        @if($products->is_approved == 2)
                                        <span class="label label-success">Approved</span>
                                        @elseif($products->is_approved == 1)
                                        <span class="label label-warning">Pending</span>
                                        @else
                                        <span class="label label-danger">Block</span>
                                        @endif
                                    </td>


                                    {{-- @if(!$products->trashed())
                                    <td>
                                        <a href="{{route('products.edit', $products->id)}}"
                                    class="btn btn-primary .btn-sm">Edit</a>
                                    </td>
                                    @else
                                    <td>
                                        <form action="{{route('products.restore', $products->id)}}" method='POST'>
                                            @csrf
                                            @method('PUT')
                                            <button type='submit' class="btn btn-success btn-sm">Restore</button>
                                        </form>
                                    </td>

                                    @endif --}}
                                    {{-- @if($slide->is_approved == 2)
                                    <span class="label label-success">Approved</span>
                                    @elseif($slide->is_approved == 1)
                                    <span class="label label-warning">Pending</span>
                                    @else
                                    <span class="label label-danger">Block</span>
                                    @endif --}}
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown">
                                                <span>Action</span>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                {{-- @if (Auth::user()->is_admin == 1)
                                                <li><a href="{{route('approveSlide', ['id' => $slide->id])}}"><span
                                                    class="text-green glyphicon glyphicon-ok">Approved</span></a>
                                                </li>
                                                <li><a href="{{route('blockSlide', ['id' => $slide->id])}}"><span
                                                            class="text-yellow glyphicon glyphicon-remove">Block</span></a>
                                                </li>
                                                @endif --}}
                                                @if (Auth::user()->is_admin == 1)
                                                <li><a href="{{route('products.approved', ['id' => $products->id])}}"><span
                                                            class="text-green glyphicon glyphicon-ok">Approved</span></a>
                                                </li>
                                                <li><a href="{{route('products.block', ['id' => $products->id])}}"><span
                                                            class="text-yellow glyphicon glyphicon-remove">Block</span></a>
                                                </li>
                                                @endif

                                                <li>
                                                    <a href="{{route('products.edit', $products->id)}}">
                                                        <span class="text-blue fa fa-fw fa-edit edit">Edit</span>
                                                    </a>

                                                    </a>
                                                </li>
                                                <li>
                                                    {{-- <form action="{{route('products.destroy', $products->id)}}"
                                                    method='POST'>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type='submit'
                                                        class="btn btn-danger btn-sm">{{$products->trashed() ? 'Delete' :'Trash'}}</button>
                                                    </form> --}}
                                                    <a data-toggle="modal" data-target="#myModal">
                                                        <span data-url="{{route('products.destroy', $products->id)}}"
                                                            class="text-red glyphicon glyphicon-trash delete-btn">Delete</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Product Images</th>
                                    <th>User Emails</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>SKU</th>
                                    <th>Stock</th>
                                    <th>Category</th>
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
            <!-- /.tab-pane -->
            <div class="tab-pane" id="reviewTab">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Reviews</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="dataTableSlide" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Information</th>
                                    <th>Comment</th>
                                    <th>User Email</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @if (is_array($productItems) || is_object($productItems)) --}}
                                @foreach ($productItems as $proitem)
                                {{-- @if (is_array($proitem->review) || is_object($proitem->review)) --}}
                                @foreach ($proitem->reviews as $review)
                                @php
                                $user = $review->users;
                                $rating = number_format($review->rating);
                                @endphp
                                <tr>
                                    <td>
                                        <img src="{{asset('storage/'. $proitem->image)}}" width="80px" height="70px"
                                            alt="img_slide">
                                    </td>
                                    <td>
                                        {{$proitem->name}} <span
                                            class="pull-right">{{$review->updated_at->diffForHumans()}}</span><br>
                                        @for ($i = 0; $i < $rating; $i++) <span class="float-right"><i
                                                class="text-yellow fa fa-star"></i></span>
                                            @endfor
                                            @for ($i = 0; $i < 5 - $rating; $i++) <span class="float-right"><i
                                                    class="text-yellow fa fa-star-o"></i></span>
                                                @endfor
                                                <br>
                                                {{$review->rating}} / 5 stars
                                    </td>

                                    <td>{{str_limit($review->comment, 20)}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>

                                        @if($review->is_approved == 2)
                                        <span class="label label-success">Approved</span>
                                        @elseif($review->is_approved == 1)
                                        <span class="label label-warning">Pending</span>
                                        @else
                                        <span class="label label-danger">Block</span>
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
                                                <li><a href="{{route('approveReview', ['id' => $review->id])}}"><span
                                                            class="text-green glyphicon glyphicon-ok">Approved</span></a>
                                                </li>
                                                <li><a href="{{route('blockReview', ['id' => $review->id])}}"><span
                                                            class="text-yellow glyphicon glyphicon-remove">Block</span></a>
                                                </li>
                                                @endif

                                                <li>
                                                    <a href="{{route('single-products.show', $proitem->id)}}"
                                                        title="View Product">
                                                        <span class="text-blue fa fa-fw fa-edit edit">View</span>
                                                    </a>


                                                </li>
                                                <li>
                                                    <a data-toggle="modal" data-target="#myModal">
                                                        <span
                                                            data-url="{{route('deleteReview', ['id' => $review->id])}}"
                                                            class="text-red glyphicon glyphicon-trash delete-btn">Delete</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                {{-- @endif --}}
                                @endforeach
                                {{-- @endif --}}

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Information</th>
                                    <th>Comment</th>
                                    <th>User Email</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="tab-pane" id="orderTab">
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
                                @foreach ($orders as $order)
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

                                                <li>
                                                    <a data-toggle="modal" data-target="#checkoutModal" href=""
                                                        title="View Product">
                                                        <span class="text-blue fa fa-fw fa-edit view"
                                                            data-url="{{route('acceptCheckout', ['token' => $order->_token])}}"
                                                            data-token="{{$order->_token}}"
                                                            data-subtotal="{{$subtotal}}"
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
            </div>
        </div>
        <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
</div>
<!-- /.col -->
{{-- @foreach ($order as $order)
 Product id = {{$order->users->email}}
<br>
User Id = {{$user->users->first()->pivot->user_id}}
<br>
@endforeach --}}

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

                <button type="submit" class="btn btn-success accept-btn">Accept</button>


            </div>
            </form>





        </div>
    </div>
</div>
<script>
    $(function () {
        $('#dataTableSlide, #dataTableCate, #example1, #dataTableOrder').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'info': true,
            'autoWidth': false,
            'ordering': true,

        })

    })

    @if(Session::has('success'))
    toastr.success("{{Session::get('success')}}");
    @elseif(Session::has('error'))
    toastr.error("{{Session::get('error')}}")
    @endif


    $(document).on('click', '.delete-btn', function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        $('#delete-item').attr('href', url);
    });

    $(function () {


//Date picker
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


</script>
<script>
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

@endsection
