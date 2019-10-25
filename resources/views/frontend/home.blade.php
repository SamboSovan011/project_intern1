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

    .bloc_left_price {
        color: #c01508;
        text-align: center;
        font-weight: bold;
        font-size: 150%;
    }

    .category_block li:hover {
        background-color: #007bff;
    }

    .category_block li:hover a {
        color: #ffffff;
    }

    .category_block li a {
        color: #343a40;
    }

    .add_to_cart_block .price {
        color: #c01508;
        text-align: center;
        font-weight: bold;
        font-size: 200%;
        margin-bottom: 0;
    }

    .add_to_cart_block .price_discounted {
        color: #343a40;
        text-align: center;
        text-decoration: line-through;
        font-size: 140%;
    }

    .product_rassurance {
        padding: 10px;
        margin-top: 15px;
        background: #ffffff;
        border: 1px solid #6c757d;
        color: #6c757d;
    }

    .product_rassurance .list-inline {
        margin-bottom: 0;
        text-transform: uppercase;
        text-align: center;
    }

    .product_rassurance .list-inline li:hover {
        color: #343a40;
    }

    .reviews_product .fa-star {
        color: gold;
    }

    .pagination {
        margin-top: 20px;
    }

</style>
<section id="slide">
    <div id="CarouselContent" class="carousel slide" data-ride="carousel">
        @php
        $i = 0;
        $j = 0;
        @endphp

        <ol class="carousel-indicators">
            @foreach ($slides as $slide)
            <li id="{{$slide->id}}0" data-target="#CarouselContent" data-slide-to="{{$i}}" class="slide-list"></li>
            @php
            $i = $i+1
            @endphp
            @endforeach
        </ol>

        <div class="carousel-inner" role="listbox">
            @foreach ($slides as $slide)
            <div id="{{$slide->id}}" class="carousel-item" data-img="{{$j}}">
                <img class="d-block img-fluid" src="{{$slide->img_path}}" alt="banner image">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{$slide->title}}</h5>
                    <p>{{$slide->description}}</p>
                </div>
            </div>
            @php
            $j = $j+1
            @endphp

            @endforeach
        </div>
        <div class="carousel-control-prev" href="#CarouselContent" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="sr-only">Previous</span>
        </div>
        <div class="carousel-control-next" href="#CarouselContent" role="button" data-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="sr-only">Next</span>
        </div>


    </div>
</section>

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
                @foreach($products as $product)
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
                            <strong>{{$product->price}}$</strong>
                                  </h4>

                            <div class="row">
                                <div class="col ">
                                    <a href="#" class="btn btn-danger btn-block">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

                <div class="col-12">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
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




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>

<script type="text/javascript">
    (function ($, interval, kitchen) {

        var i = 0;
        var handle = setInterval(function () {

            $('#contentbody').css("background-image", "url('" + kitchen[i] + "')");

            i++;

            if (i >= kitchen.length) {
                i = 0;
            }
        }, interval);

    })(jQuery, 10000, [
        "{{asset('img/kitchen1.jpg')}}",
        "{{asset('img/kitchen2.jpg')}}",
        "{{asset('img/kitchen3.jpg')}}"
    ]);

</script>

@endsection
