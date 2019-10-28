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
                                    <th>Description</th>
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
                                    <td>{{str_limit($slide->description, 20)}}</td>
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
                                    <th>Description</th>
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
                                    <th>Category Images</th>
                                    <th>User Emails</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cates as $cate)
                                <tr>
                                    <td>
                                        <img src="{{asset($cate->img_path)}}" width="80px" height="70px"
                                            alt="img_slide">
                                    </td>
                                    <td>
                                        {{$cate->user_email}}
                                    </td>
                                    <td>{{$cate->title}}</td>
                                    <td>{{str_limit($cate->description, 20)}}</td>
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
                                    <th>Category Images</th>
                                    <th>User Emails</th>
                                    <th>Title</th>
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
                                {{-- @foreach ($products as $product)
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
                                        <button type='submit' class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                                </tr>
                                @endforeach --}}

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
                        <h3 class="box-title">Banner Slides</h3>
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
                                        {{$proitem->name}} <span class="pull-right">{{$review->updated_at->diffForHumans()}}</span><br>
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
                                                        <span
                                                            class="text-blue fa fa-fw fa-edit edit">View</span>
                                                    </a>


                                                </li>
                                                <li>
                                                    <a data-toggle="modal" data-target="#myModal">
                                                        <span data-url="{{route('deleteSlide', ['id' => $review->id])}}"
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
        </div>
        <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
</div>
<!-- /.col -->
<script>
    $(function () {
    $('#dataTableSlide, #dataTableCate, #example1').DataTable({
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






</script>
@endsection
