@extends('dashboard.app')
@section('title', 'Potted Pan - Categories')
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
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Category
        <small>Add new Categories</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Category</li>
    </ol>
</section>
<section id="button-row">
    <div class="button">
        <a href="{{route('newcategoryposting')}}">
            <button class="btn btn-info">
                POST NEW CATEGORY
            </button></a>

    </div>
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
                    <h3 class="box-title">Categories</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>User Emails</th>
                                <th>Prodcuct</th>
                                <th>Status</th>
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
                                <td class="text-bold">
                                    {{$cate->products->count()}}
                                </td>
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
                                                <a data-toggle="modal" data-target="#myModal">
                                                    <span data-url="{{route('deleteCategory', ['id' => $cate->id])}}" class="text-red glyphicon glyphicon-trash delete-btn">Delete</span>
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
                                <th>Category</th>
                                <th>User Emails</th>
                                <th>Prodcuct</th>
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
    <div class="modal fade" id="editForm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Category</h4>
                </div>
                <form id="editCateForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="box-body">

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif



                            <div class="form-group">
                                <label>Title</label>
                                <input name="title" type="text" class="form-control" id="cateTitle"
                                    placeholder="Cate title">
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</section>
<!-- /.content -->
@if (count($errors) > 0)
<script>
    $(document).ready(function () {
        $('#editForm').modal('show');
    });

</script>
@endif
<script>
    $(function () {
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'info': true,
            'autoWidth': false,
            'ordering': true,

        })

    })

    $(document).on('click', '.delete-btn', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('#delete-item').attr('href', url);
    });

    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');

        $.ajax({
            url: "/admin/dashboard/getCategory/" + id,
            type: "GET",
            dataType: "json",
            success: function (html) {
                $('#editCateForm').attr('action', '/admin/dashboard/editCategory/' + id);
                $('#cateTitle').val(html.data.title);
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
