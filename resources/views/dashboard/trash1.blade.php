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
        <li><a href=""><i class="fa fa-dashboard"></i>Unclaim Tool</a></li>
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

                                        <form action="{{route('slide.restore', $slide->id)}}" method='POST'>
                                            @csrf
                                            @method('PUT')
                                            <button type='submit' class="btn btn-success btn-sm">Restore</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{route('deleteSlide', $slide->id)}}">
                                            <button type='button' class="btn btn-danger btn-sm">Delete</button>
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
                                        <form action="{{route('cate.restore', $cate->id)}}" method='POST'>
                                            @csrf
                                            @method('PUT')
                                            <button type='submit' class="btn btn-success btn-sm">Restore</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{route('deleteCategory', $cate->id)}}">
                                            <button type='button' class="btn btn-danger btn-sm">Delete</button>
                                        </a>
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
                                            <button type='submit' class="btn btn-danger btn-sm">Delete</button>
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
