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

<section>
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
</section>
<div class="context">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab">Slides</a></li>
            <li><a href="#timeline" data-toggle="tab">Categories</a></li>
            <li><a href="#settings" data-toggle="tab">Products</a></li>
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="activity">
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
                                    <th>Status</th>
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
                                    <td>{{$slide->description}}</td>
                                    <td>

                                        <form action="{{route('slide.restore', $slide->id)}}" method='POST'>
                                            @csrf
                                            @method('PUT')
                                            <button type='submit' class="btn btn-success btn-sm">Restore</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{route('deleteSlide', $slide->id)}}">
                                            <button type='submit' class="btn btn-danger btn-sm">Trash</button>
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
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="timeline">
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
                                    <th>Status</th>
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
                                    <td>{{$cate->description}}</td>
                                    <td>
                                        @if($cate->is_approved == 2)
                                        <span class="label label-success">Approved</span>
                                        @elseif($cate->is_approved == 1)
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
                                                <li><a href="{{route('approveCategory', ['id' => $cate->id])}}"><span
                                                            class="text-green glyphicon glyphicon-ok">Approved</span></a>
                                                </li>
                                                <li><a href="{{route('blockCategory', ['id' => $cate->id])}}"><span
                                                            class="text-yellow glyphicon glyphicon-remove">Block</span></a>
                                                </li>
                                                @endif

                                                <li>
                                                    <a href="#" data-toggle="modal" data-target="#editForm">
                                                        <span id="{{$cate->id}}"
                                                            class="text-blue fa fa-fw fa-edit edit">Edit</span>

                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('deleteCategory', ['id' => $cate->id])}}">
                                                        <span class="text-red glyphicon glyphicon-trash">Delete</span>
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
                                    <th>Category Images</th>
                                    <th>User Emails</th>
                                    <th>Title</th>
                                    <th>Description</th>
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

            <div class="tab-pane" id="timeline">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- /.box -->

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Banner Slides</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Images</th>
                                                <th>User Emails</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($trash as $trashed)
                                            <tr>
                                                <td>
                                                    <img src="{{asset('storage/'. $trashed->image)}}" width="80px"
                                                        height="70px" alt="img_slide">
                                                </td>
                                                <td>
                                                    {{$trashed->email}}
                                                </td>
                                                <td>{{$trashed->name}}</td>
                                                <td>{{$trashed->description}}</td>

                                                <td>
                                                    <form action="{{route('products.destroy', $trashed->id)}}"
                                                        method='POST'>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type='submit'
                                                            class="btn btn-danger btn-sm">Trash</button>
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
                                                <th>Kimhor</th>
                                                <th>Status</th>
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





                    <!-- /.modal -->
                </section>
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





</script>
@endsection
