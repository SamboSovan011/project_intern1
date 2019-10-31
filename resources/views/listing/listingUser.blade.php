@extends('dashboard.app')
@section('title', 'Potted Pan - Users Listing')
@section('content')
<style>
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
        User Listing
        <small>Show all types of users</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User Listing</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- /.box -->

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">User Table Listing</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example3" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Emails</th>
                                <th>Username</th>
                                <th>Phone Number</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>
                                    {{$user->id}}
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>{{$user->fname}}&nbsp;{{$user->lname}}</td>
                                <td>{{$user->phone}}</td>
                                <td>
                                    @if($user->is_admin == 1)
                                    <span class="label label-success">Admin</span>
                                    @elseif($user->is_admin == -1)
                                    <span class="label label-danger">Block</span>
                                    @elseif($user->is_admin == 2)
                                    <span class="label bg-orange-active">Staff</span>
                                    @else
                                    <span class="label bg-aqua-active">Customer</span>
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
                                            <li>
                                                <a href="{{route('add_admin', ['id' => $user->id])}}"><span
                                                        class="text-green glyphicon glyphicon-ok">Add_Admin</span></a>
                                                @if($user->is_admin == 0)
                                                <a href="{{route('add_subadmin', ['id' => $user->id])}}"><span
                                                        class="text-yellow glyphicon glyphicon-ok">Add_Staff</span></a>
                                                @else
                                                <a href="{{route('add_user', ['id' => $user->id])}}"><span
                                                        class="text-aqua glyphicon glyphicon-ok">Add_User</span></a>
                                                @endif
                                            </li>
                                            <li><a href="{{route('block_user', ['id' => $user->id])}}"><span
                                                        class="text-red glyphicon glyphicon-remove">Block</span></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="modal" data-target="#editForm">
                                                    <span id="{{$user->id}}"
                                                        class="text-blue fa fa-fw fa-edit edit">Edit</span>

                                                </a>
                                            </li>
                                            <li>
                                                <a data-toggle="modal" data-target="#myModal">
                                                    <span data-url="{{route('delete_user', ['id' => $user->id])}}" class="text-red glyphicon glyphicon-trash delete-btn">Delete</span>
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
                                <th>ID</th>
                                <th>User Emails</th>
                                <th>Username</th>
                                <th>Phone Number</th>
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
                    <h4 class="modal-title">Edit User</h4>
                </div>
                <form id="editUserForm" method="POST" action="" enctype="multipart/form-data">
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
                                <label>User Email</label>
                                <input name="user-email" type="text" class="form-control" id="userEmail"
                                    placeholder="User Email">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input name="firstname" type="text" class="form-control" id="firstName"
                                    placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input name="lastname" type="text" class="form-control" id="lastName"
                                    placeholder="Last Name">
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input name="phone" type="text" class="form-control" id="phoneNum"
                                    placeholder="Phone Number">
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
        $('#example3').DataTable({
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
            url: "/admin/dashboard/getUserData/" + id,
            type: "GET",
            dataType: "json",
            success: function (html) {
                $('#editUserForm').attr('action', '/admin/dashboard/editUser/' + id);
                $('#userEmail').val(html.data.email);
                $('#firstName').val(html.data.fname);
                $('#lastName').val(html.data.lname);
                $('#phoneNum').val(html.data.phone);
            }
        })

    });

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
