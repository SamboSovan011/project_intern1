@extends('dashboard.app')
@section('title', 'Potted Pan - Slides')
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
        Banner Slide
        <small>Add banner to the slide</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Banner Slide</li>
    </ol>
</section>
<section id="button-row">
    <div class="button">
        <a href="{{route('post.create')}}">
            <button class="btn btn-info">
                POST NEW PRODUCT
            </button></a>

    </div>
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
<!-- Main content -->
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($post as $posts)
                            <tr>
                                <td>
                                    <img src="{{asset($posts->image)}}" width="80px" height="70px" alt="img_slide">
                                </td>
                                <td>
                                    {{$posts->email}}
                                </td>
                                <td>{{$posts->name}}</td>
                                <td>{{$posts->description}}</td>

                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown">
                                            <span>Action</span>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">

                                            <li>
                                                <a href="#" data-toggle="modal" data-target="#editForm">
                                                    <span id="{{$posts->id}}"
                                                        class="text-blue fa fa-fw fa-edit edit">Edit</span>

                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('post.destroy', ['id' => $posts->id])}}">
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
                                <th>Product Images</th>
                                <th>User Emails</th>
                                <th>name</th>
                                <th>Kimhor</th>
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




    {{-- modal --}}
    <div class="modal fade" id="editForm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Slide</h4>
                </div>
                <form id="editSlideForm" method="POST" action="" enctype="multipart/form-data">
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
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label for="name">Name</label>
                                        <input name="name" type="text" class="form-control" id="name"
                                            placeholder="Product Name" required>
                                    </div>

                                    <div class="col-xs-6">
                                        <label for="name">Price</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input name="price" type="text" class="form-control" id="price"
                                                placeholder="Price " required>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <label for="product_code">Product Code</label>
                                        <input name="sku" type="text" class="form-control" id="sku" placeholder="SKU"
                                            required>
                                    </div>

                                    <div class="col-xs-4">
                                        <label for="product_stock">Stock</label>
                                        <input name="stock" type="text" class="form-control" id="stock"
                                            placeholder="Stock" required>
                                    </div>


                                    <div class="col-xs-4">
                                        <label for="category">Category</label>
                                        <select class="form-control">
                                            {{-- @foreach($categories as $category)
                                            <option>{{$category->title}}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>


                                </div>
                            </div>


                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" cols="30"
                                    rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" required>

                                <p class="help-block">Images of the product</p>
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
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'info': true,
            'autoWidth': false,
            'ordering': true,

        })

    })



    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');

        $.ajax({
            url: "/admin/dashboard/editpost/" + id,
            type: "GET",
            dataType: "json",
            success: function (html) {
                $('#editSlideForm').attr("action", "/admin/dashboard/updatepost/" + id)
                $('#name').val(html.data.name);
                $('#description').val(html.data.description);
                $('#store_img').attr("src", "/" + html.data.img_path);
                $('#price').val(html.data.price);
                $('#stock').val(html.data.stock);
                $('#sku').val(html.data.sku);
            }
        })

    });

</script>



@endsection
