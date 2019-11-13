@extends('dashboard.app')
@section('title', 'Potted Pan - Trash')
@section('content')
<style>
    .context {
        padding: 7rem 2rem;
    }

    .box {
        border: none;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Trash
        <small>All deleted data is here!</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href=""><i class="fa fa-dashboard"></i>Admin Tool</a></li>
        <li class="active">Trash</li>
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

                                        <form action="{{route('slide.restore', $slide->id)}}" method='POST'>
                                            @csrf
                                            @method('PUT')
                                            <button type='submit' class="btn btn-success btn-sm">Restore</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="">
                                            <button data-url="{{route('deleteSlide', $slide->id)}}" type='button' class="btn btn-danger btn-sm delete-btn">Delete</button>
                                        </a>

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
                                        <form action="{{route('cate.restore', $cate->id)}}" method='POST'>
                                            @csrf
                                            @method('PUT')
                                            <button type='submit' class="btn btn-success btn-sm">Restore</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="">
                                            <button data-url="{{route('deleteCategory', $cate->id)}}" type='button' class="btn btn-danger btn-sm delete-btn">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Category Images</th>
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
                                    <th>name</th>
                                    <th>Description</th>
                                    <th></th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <img src="{{asset('storage/'. $product->image)}}" width="80px" height="70px"
                                            alt="img_slide">
                                    </td>
                                    <td>
                                        {{$product->email}}
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{str_limit($product->description, 20)}}</td>
                                    <td>
                                        <form action="{{route('products.restore', $product->id)}}" method='POST'>
                                            @csrf
                                            @method('PUT')
                                            <button type='submit' class="btn btn-success btn-sm">Restore</button>
                                        </form>
                                    </td>

                                    <td>
                                        <form action="{{route('products.destroy', $product->id)}}" method='POST'>
                                            @csrf
                                            @method('DELETE')
                                            <button type='submit' class="btn btn-danger btn-sm delete-btn">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Product Images</th>
                                    <th>User Emails</th>
                                    <th>name</th>
                                    <th>Description</th>
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
                                        <form action="{{route('review.restore', $review->id)}}" method='POST'>
                                            @csrf
                                            @method('PUT')
                                            <button type='submit' class="btn btn-success btn-sm">Restore</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="">
                                            <button data-url="{{route('deleteReview', $review->id)}}" type='button' class="btn btn-danger btn-sm delete-btn">Delete</button>
                                        </a>
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
                                    <th>Deleted By</th>
                                    <th>Customer Email</th>
                                    <th>Subtotal</th>
                                    <th>Total</th>
                                    <th></th>
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
                                        $subtotal = array_sum($proLists->where('_token', $order->_token)->pluck('subtotal')->toArray());
                                        $total = array_sum($proLists->where('_token', $order->_token)->pluck('total')->toArray());

                                    @endphp

                                    <td>{{$subtotal}}</td>
                                    <td>{{$total}}</td>
                                    <td>
                                        <form action="{{route('invoice.restore', $order->_token)}}" method='POST'>
                                            @csrf
                                            @method('PUT')
                                            <button type='submit' class="btn btn-success btn-sm">Restore</button>
                                        </form>


                                    </td>
                                    <td>
                                        <a href="">
                                            <button data-url="{{route('deleteCheckout', $order->_token)}}" type='button' class="btn btn-danger btn-sm delete-btn">Delete</button>
                                        </a>
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
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.tab-content -->
</div>
<!-- /.nav-tabs-custom -->
</div>
<!-- /.col -->
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
                        <button  type="button" class="btn btn-danger">Delete</button>
                    </a>

                </div>

            </div>
        </div>
    </div>
<script>
    $(function () {
    $('#dataTableSlide, #dataTableCate, #example1, #dataTableOrder').DataTable({
        'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'info'        : true,
      'autoWidth'   : false,
      'ordering'    : true,

    })

  })

    @if(Session::has('success'))
    toastr.success("{{Session::get('success')}}");
    @elseif(Session::has('error'))
    toastr.error("{{Session::get('error')}}")
    @endif


    $(document).on('click', '.delete-btn', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('#delete-item').attr('href', url);
    });



</script>
@endsection
