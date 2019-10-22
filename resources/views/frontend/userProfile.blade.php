@extends('layouts.app')
@section('title', 'Potted Pan - User Profile')
@section('content')
<style>
    .pro-user {
        background: #fff;
        padding: 0 3rem;
        margin: 3rem 0;
    }

    .pro-header {
        margin: 2rem 0 3rem 0;
    }

    .pro-footer {
        margin: 3rem 0;
        display: flex;
        justify-content: space-between;
    }

    .home-btn {
        background: #1cbbb4;
        color: #fff;
        border: none;
    }

    .home-btn:hover {
        background: #169590;
    }

    .edit-btn {
        background: #cccc00;
        color: #fff;
        border: none;
    }

    .save-btn {
        background: #cccc00;
        color: #fff;
        border: none;
        display: none;
    }

    .edit-btn:hover {
        background: #b3b300;
    }

    .username {
        color: #1cbbb4;
    }

    .button-link {
        margin: 3rem 0;
        display: flex;
        justify-content: flex-end;
    }

    .button-link-2 {
        display: flex;
        justify-content: flex-end;
    }

    .btn-change-pass {
        background: #1cbbb4;
        color: #fff;
        border: none;
        text-decoration: none;
    }

    .btn-change-pass:hover {
        background: #169590;
        text-decoration: none;
    }

    .btn-wish-list {
        background: #1cbbb4;
        padding: 3rem 8rem;
        color: #fff;
        font-size: 2rem;
        border: none;
    }

    footer {
        position: absolute !important;
    }
</style>
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
<div class="container">
    <div class="row">
        <div class="pro-user col-md-5">
            <h3 class="pro-header">
                <span class="username">{{Auth::user()->fname}}</span>&apos;s Profile
                <hr>
            </h3>

            <form method="POST" action="{{route('updateProfile', ['id' => Auth::user()->id])}}"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="userEmail" class="col-sm-4 col-form-label">Email:</label>
                    <div class="col-sm-8">
                        <input name="user-Email" type="email" readonly class="form-control-plaintext" id="userEmail"
                            value="{{Auth::user()->email}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="userFirstName" class="col-sm-4 col-form-label">First Name:</label>
                    <div class="col-sm-8">
                        <input name="user-firstname" type="text" readonly class="form-control-plaintext"
                            id="userFirstName" value="{{Auth::user()->fname}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="userLastName" class="col-sm-4 col-form-label">Last Name:</label>
                    <div class="col-sm-8">
                        <input name="user-lastname" type="text" readonly class="form-control-plaintext"
                            id="userLastName" value="{{Auth::user()->lname}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="userPhone" class="col-sm-4 col-form-label">Phone:</label>
                    <div class="col-sm-8">
                        <input name="user-phone" type="text" readonly class="form-control-plaintext" id="userPhone"
                            value="{{Auth::user()->phone}}">
                    </div>
                </div>
                <div class="pro-footer">
                    <a href="/"><button type="button" class="btn btn-secondary home-btn">Back Home</button></a>
                    <button type="button" class="btn btn-default edit-btn" id="editButton">Edit Profile</button>
                    <button type="submit" class="btn btn-default save-btn" id="saveButton">Save Change</button>
                </div>
            </form>
        </div>
        <div class="col-md-7">
            <div class="button-link">
                <button type="button" class="btn btn-default btn-change-pass" data-toggle="modal"
                    data-target="#changePassModal">Change Password</button>

            </div>
            <div class="button-link-2">
                <button type="button" class="btn btn-default btn-wish-list">Wish List</button>
            </div>

        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="changePassModal" tabindex="-1" role="dialog" aria-labelledby="changePassModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePassModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="password" name="current-pass" class="form-control" placeholder="Current Password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="new-pass" class="form-control" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="confirm-pass" class="form-control" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    $(document).on('click', '.edit-btn', function(e){
        e.preventDefault();
        $('#userEmail').attr('readonly', false);
        $('#userFirstName').attr('readonly', false);
        $('#userLastName').attr('readonly', false);
        $('#userPhone').attr('readonly', false);
        $('#userEmail').attr('class', 'form-control');
        $('#userFirstName').attr('class', 'form-control');
        $('#userLastName').attr('class', 'form-control');
        $('#userPhone').attr('class', 'form-control');
        $('.edit-btn').css('display', 'none');
        $('.save-btn').css('display', 'inline');
    });
</script>
@endsection
