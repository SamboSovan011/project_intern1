@extends('dashboard.app')
@section('title', 'Potted Pan - Slide Adder')
@section('content')
<style>
    #form {
        padding: 3rem;
    }
</style>
<section class="content-header">
    <h1> Edit Products
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('products.index')}}">Product</a></li>
        <li class="active">Edit Product</li>
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
        <form role="form" method="POST" action="{{route('products.update', $products->id)}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <div class="row">
                    @foreach($products as $product)
                        <div class="col-xs-6">
                            <label for="name">Name</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Product Name"
                                required value="{{$products->name}}">
                        </div>

                        <div class="col-xs-6">
                            <label for="name">Price</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input name="price" type="text" class="form-control" id="price" placeholder="Price "
                                    required value="{{$product->price}}">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-4">
                            <label for="product_code">Product Code</label>
                            <input name="SKU" type="text" class="form-control" id="sku" placeholder="SKU" value="{{$product->SKU}}" required>
                        </div>

                        <div class="col-xs-4">
                            <label for="product_stock">Stock</label>
                            <input name="stock" type="text" class="form-control" id="sku" placeholder="Stock" required value="{{$product->stock}}">
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
                    <textarea class="form-control" name="description" id="desc" cols="30" rows="10" value="{{$product->description}}"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" required>

                    <p class="help-block">Images of the product</p>
                </div>
                @endforeach
            </div>


            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</section>

@endsection