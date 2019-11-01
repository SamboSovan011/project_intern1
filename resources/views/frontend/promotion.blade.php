@extends('layouts.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@section('title', 'Potted Pan - Selling Kitchen Utensils')
@section('content')
<style>
    .d-block {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
        max-width: 100%;
    }

    .card-img-top {
        /* height: 212.26px !important;
        margin-right:-20px;
        margin-left:-20px !important; */
        width: 100% !important;
        height: 190px;
        object-fit: cover;
    }

    .card {
        border: none;
    }

    .card:hover {

        -webkit-box-shadow: -1px 9px 40px -12px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: -1px 9px 40px -12px rgba(0, 0, 0, 0.75);
        box-shadow: -1px 9px 40px -12px rgba(0, 0, 0, 0.75);
    }

    .carousel-item {
        height: 500px;
        padding: 0;
    }

    .carousel-item img {
        width: 100%;
        height: 100% !important;
        object-fit: cover;
    }





    .pagination {
        margin-top: 20px;
    }

</style>
<div class="container">
    <div class="row">
        <div class="col pt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="category.html">Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sub-category</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-3">
            <div class="card bg-light mb-3">
                <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Categories
                </div>
                <ul class="list-group category_block">
                    @foreach($cates as $category)
                    <li class="list-group-item"><a href="#">{{$category->title}}</a></li>
                    @endforeach
                </ul>
            </div>

        </div>
        <div class="col">
            <div class="row">
                @foreach($productPro as $product)
                <div class="col-12 col-md-5 col-lg-4">
                    <div class="card mb-3">
                        <a href="{{route('single-products.show', $product->id)}}" title="View Product">
                            <img class="card-img-top" src="{{asset('storage/'. $product->image)}}" alt="Card image cap">
                        </a>

                        <div class="card-body">
                            <h4 class="card-title"><a href="{{route('single-products.show', $product->id)}}"
                                    title="View Product">{{$product->name}}</a></h4>
                            <p class="card-text">{{str_limit(strip_tags($product->description, 100))}}</p>
                            <h4 class="font-weight-bold blue-text d-flex justify-content-center">

                                  </h4>
                                  <div class="d-inline d-flex justify-content-center">
                                    <a href="#" class="btn btn-success btn-sm d-inline ">Add to cart</a>
                                    <div class="btn btn-danger btn-sm d-inline" style="font-size: 14px">{{$product->price}}$</div>
                                    </div>

                        </div>

                    </div>
                </div>

                @endforeach

                <div class="col-12 d-flex justify-content-end">

                    {{$productPro->links()}}
                </div>


            </div>
        </div>

    </div>
</div>



<script>
    $(document).ready(function () {
        var idI = $('.slide-list').attr('id');
        var i = $('#' + idI).attr('data-slide-to');
        var idM = $('.carousel-item').attr('id');
        var j = $('#' + idM).attr('data-img');
        if (i == '0' && j == '0') {
            $('#' + idI).addClass('active');
            $('#' + idM).addClass('active');
        }

    })

</script>
@endsection
