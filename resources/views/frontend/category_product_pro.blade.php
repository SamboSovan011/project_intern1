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

    .price-not {
        color: #BDC3C7;
    }

    .price-after {
        color: #1cbbb4;
        font-weight: bold;
        font-size: 1.5rem;
        font-style: italic;
    }

    .time {
        font-size: .8rem;
        color: #D7DBDD;
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

                    <li class="breadcrumb-item "><a href="{{route('promotionProducts')}}">Promotion</a></li>
                    <li class="breadcrumb-item  "><a>{{$category->title}}</a></li>

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
                    <li class="list-group-item"><a
                            href="{{route('show.product-cats-pro', $category->id)}}">{{$category->title}}</a></li>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title"><a href="{{route('single-products.show', $product->id)}}"
                                            title="View Product">{{$product->name}}</a></h4>
                                </div>
                                <div class="col-md-6">
                                    @if (!empty($product->discount))
                                    <span class="float-right badge purple mr-1">Promotion</span>
                                    @endif
                                </div>


                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <span>{{$product->avg}}</span>
                                    @php
                                    $rating = number_format($product->avg_rating);
                                    @endphp
                                    @if (!empty($product->avg_rating))
                                    <span>
                                        @for ($i = 0; $i < $rating; $i++) <span class="float-left"><i
                                                class="text-warning fa fa-star"></i></span>
                                    @endfor
                                    @for ($i = 0; $i < 5- $rating; $i++) <span class="float-left"><i
                                            class="text-warning far fa-star"></i></span>
                                        @endfor
                                        </span>
                                        <br>
                                        <span>
                                            {{$product->avg_rating}} / 5 stars
                                        </span>
                                        @else
                                        <span>No review yet</span>
                                        @endif

                                        <br>
                                        <span class="time">{{$product->updated_at->diffForHumans()}}</span>
                                </div>
                                <div class="col-md-6">
                                    <div class="font-weight-bold blue-text float-right">
                                        @if (!empty($product->discount))
                                        <strike class="price-not">{{$product->price}}$</strike>
                                        <br>
                                        <span class="price-after">{{$product->priceAfterPro}}$</span>
                                        @else
                                        <br>
                                        <span class="price-after">{{$product->price}}$</span>

                                        @endif

                                    </div>

                                </div>
                            </div>



                        </div>
                        <div class=" mx-2 my-1 d-inline d-flex justify-content-center">
                            <a href="#" class="btn btn-success btn-block ">Add to cart</a>

                        </div>

                    </div>
                </div>

                @endforeach

                <div class="col-12 d-flex justify-content-end">

                    {{$products->links()}}
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
