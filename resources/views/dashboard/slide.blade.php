@extends('dashboard.app')
@section('title', 'Potted Pan - Slide Adder')
@section('content')
<style>
    #form {
        padding: 3rem;
    }
</style>
<section class="content-header">
    <h1>
        Banner Slide
        <small>Add banner to the slide</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('slidelisting')}}">Banner Slide</a></li>
        <li class="active">Post New Slide</li>
    </ol>
</section>

<section id="form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Slide For Banner</h3>
        </div>
        <section>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </section>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{route('postSlide')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input name="title" type="text" class="form-control" id="exampleInputEmail1"
                        placeholder="Slide Title" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <textarea class="form-control" name="desc" id="desc" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" name="image" id="exampleInputFile" required>

                    <p class="help-block">Example block-level help text here.</p>
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</section>

@endsection
