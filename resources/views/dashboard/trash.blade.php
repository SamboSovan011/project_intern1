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
        Trash
        <small>Delete and Backup Trash</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Trash</li>
    </ol>
</section>
<!-- <section id="button-row">
    <div class="button">
        <a href="{{route('products.create')}}">
            <button class="btn btn-info">
                POST NEW PRODUCT
            </button></a>

    </div>
</section>
<section> -->
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
                            @foreach ($trash as $trashed)
                            <tr>
                                <td>
                                    <img src="{{asset('storage/'. $trashed->image)}}" width="80px" height="70px" alt="img_slide">
                                </td>
                                <td>
                                    {{$trashed->email}}
                                </td>
                                <td>{{$trashed->name}}</td>
                                <td>{{$trashed->description}}</td>

                                <td>
                                    <form action="{{route('products.destroy', $trashed->id)}}" method='POST'>
                                        @csrf
                                        @method('DELETE')
                                        <button type='submit' class="btn btn-danger btn-sm">Trash</button>
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



@endsection