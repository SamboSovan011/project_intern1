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

    /* .card:hover {

        -webkit-box-shadow: -1px 9px 40px -12px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: -1px 9px 40px -12px rgba(0, 0, 0, 0.75);
        box-shadow: -1px 9px 40px -12px rgba(0, 0, 0, 0.75);
    } */

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

    .gallery-wrap .img-big-wrap img {
        height: 450px;
        width: auto;
        display: inline-block;
        cursor: zoom-in;
    }


    .gallery-wrap .img-small-wrap .item-gallery {
        width: 60px;
        height: 60px;
        border: 1px solid #ddd;
        margin: 7px 2px;
        display: inline-block;
        overflow: hidden;
    }

    .gallery-wrap .img-small-wrap {
        text-align: center;
    }

    .gallery-wrap .img-small-wrap img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
        border-radius: 4px;
        cursor: zoom-in;
    }

</style>

<div class="container">

        <div class="col">
            <div class="card">
                <div class="row">
                    <aside class="col-sm-5">

                        <article class="gallery-wrap">
                            <div class="img-big-wrap">
                            <div> <img src="{{asset('storage/'. $pro->image)}}" class="img-fluid"></div>
                            </div> <!-- slider-product.// -->
                            {{-- <div class="img-small-wrap">
                                <div class="item-gallery"> <img src="https://s9.postimg.org/tupxkvfj3/image.jpg"> </div>
                                <div class="item-gallery"> <img src="https://s9.postimg.org/tupxkvfj3/image.jpg"> </div>
                                <div class="item-gallery"> <img src="https://s9.postimg.org/tupxkvfj3/image.jpg"> </div>
                                <div class="item-gallery"> <img src="https://s9.postimg.org/tupxkvfj3/image.jpg"> </div>
                            </div>  --}}
                            <!-- slider-nav.// -->
                        </article> <!-- gallery-wrap .end// -->
                    </aside>
                    <aside class="col-sm-7">
                        <article class="card-body p-5">
                        <h3 class="title mb-3">{{$pro->name}}</h3>

                            <p class="price-detail-wrap">
                                <span class="price h3 text-warning">
                                <span class="currency">US $</span><span class="num">{{$pro->price}}</span>
                                </span>
                            </p> <!-- price-detail-wrap .// -->
                            <dl class="item-property">
                                <dt>Description</dt>
                                <dd>
                               {{$pro->description}}
                                </dd>
                            </dl>
                            <dl class="param param-feature">
                                <dt>Model#</dt>
                                <dd>12345611</dd>
                            </dl> <!-- item-property-hor .// -->
                            <dl class="param param-feature">
                                <dt>Color</dt>
                                <dd>Black and white</dd>
                            </dl> <!-- item-property-hor .// -->
                            <dl class="param param-feature">
                                <dt>Delivery</dt>
                                <dd>Russia, USA, and Europe</dd>
                            </dl> <!-- item-property-hor .// -->

                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <dl class="param param-inline">
                                        <dt>Quantity: </dt>
                                        <dd>
                                            <select class="form-control form-control-sm" style="width:70px;">
                                                <option> 1 </option>
                                                <option> 2 </option>
                                                <option> 3 </option>
                                            </select>
                                        </dd>
                                    </dl> <!-- item-property .// -->
                                </div> <!-- col.// -->
                                <div class="col-sm-7">
                                    <dl class="param param-inline">
                                        <dt>Size: </dt>
                                        <dd>
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                    id="inlineRadio2" value="option2">
                                                <span class="form-check-label">SM</span>
                                            </label>
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                    id="inlineRadio2" value="option2">
                                                <span class="form-check-label">MD</span>
                                            </label>
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                    id="inlineRadio2" value="option2">
                                                <span class="form-check-label">XXL</span>
                                            </label>
                                        </dd>
                                    </dl> <!-- item-property .// -->
                                </div> <!-- col.// -->

                            </div> <!-- row.// -->
                            <hr>
                            <a href="#" class="btn btn-lg btn-primary text-uppercase"> Buy now </a>
                            <a href="#" class="btn btn-lg btn-outline-primary text-uppercase"> <i
                                    class="fas fa-shopping-cart"></i> Add to cart </a>
                        </article> <!-- card-body.// -->

                    </aside> <!-- col.// -->

                </div> <!-- row.// -->
            </div> <!-- card.// -->
        </div>
    </div>
</div>








<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>



@endsection
