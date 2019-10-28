@extends('dashboard.app')
@section('title', (isset($trash) ? 'Potted Pan - Trash':'Potted Pan - Product') )
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

        {{isset($trash) ? 'Trash':'Products'}}
        @if(!isset($trash))
        <small>Add Products</small>
        @endif
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> {{isset($trash) ? 'Trash' :'Products'}}</li>
    </ol>
</section>
@if(!isset($trash))
<section id="button-row">
    <div class="button">
        <a href="{{route('products.create')}}">
            <button class="btn btn-info">
                POST NEW PRODUCT
            </button></a>
    </div>
</section>
@endif

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
                                        <img src="{{asset('storage/'. $products->image)}}" width="80px" height="70px"
                                            alt="img_slide">
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
                                <td></td>


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
        <!-- /.col -->
    </div>
    <!-- /.row -->
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
                    <form style="display:inline" id="delete-form" action="" method='POST'>
                        @csrf
                        @method('DELETE')
                        <button type='submit' class="btn btn-danger">Trash</button>
                    </form>

                </div>

            </div>
        </div>
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

    $(document).on('click', '.delete-btn', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('#delete-form').attr('action', url);
    })

</script>



<script>
    @if(Session::has('success'))
    toastr.success("{{Session::get('success')}}");
    @elseif(Session::has('error'))
    toastr.error("{{Session::get('error')}}")
    @endif
</script>






@endsection
