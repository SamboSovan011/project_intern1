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
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $products)
                            <tr>
                                <td>
                                    <img src="{{asset('storage/'. $products->image)}}" width="80px" height="70px"
                                        alt="img_slide">
                                </td>
                                <td>
                                    {{$products->email}}
                                </td>
                                <td>{{$products->name}}</td>
                                <td>{{str_limit($products->description)}}</td>

                                @if(!$products->trashed())
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

                                @endif
                                <td>



                                    <form action="{{route('products.destroy', $products->id)}}" method='POST'>
                                        @csrf
                                        @method('DELETE')
                                        <button type='submit'
                                            class="btn btn-danger btn-sm">{{$products->trashed() ? 'Delete' :'Trash'}}</button>
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

</script>



<script>
@if(Session::has('success'))
    toastr.success("{{Session::get('success')}}");
@elseif(Session::has('error'))
    toastr.error("{{Session::get('error')}}")
@endif
</script>






@endsection
