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
        Post Product
        <small>Add Product
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('post.index')}}">Product</a></li>
        <li class="active">Post New Product</li>
    </ol>
</section>

<section id="form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Post Product</h3>
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
        <form role="form" method="POST" action="{{route('post.store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-6">
                            <label for="name">Name</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Product Name"
                                required>
                        </div>

                        <div class="col-xs-6">
                            <label for="name">Price</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input name="price" type="text" class="form-control" id="price" placeholder="Price "
                                    required>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-4">
                            <label for="product_code">Product Code</label>
                            <input name="sku" type="text" class="form-control" id="sku" placeholder="SKU" required>
                        </div>

                        <div class="col-xs-4">
                            <label for="product_stock">Stock</label>
                            <input name="stock" type="text" class="form-control" id="sku" placeholder="Stock" required>
                        </div>


                        <div class="col-xs-4">
                            <label for="category">Category</label>
                            <select class="form-control">
                                @foreach($categories as $category)
                                <option>{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                </div>


                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="desc" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" required>

                    <p class="help-block">Images of the product</p>
                </div>
            </div>


            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Post</button>
            </div>
        </form>
    </div>
</section>

@endsection
