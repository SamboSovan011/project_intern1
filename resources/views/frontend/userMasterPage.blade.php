@extends('layouts.app')
@section('title', 'Potted Pan - User Profile')
@section('content')
<style>
    .bloc_left_price {
        color: #c01508;
        text-align: center;
        font-weight: bold;
        font-size: 150%;
    }

    .category_block li:hover {
        background-color: #1cbbb4;
    }

    .category_block li:hover a {
        color: #ffffff;
        text-decoration: none;
    }

    .category_block li a {
        color: #343a40;
    }

    .bg-active {
        background: #1cbbb4;
    }

    .bg-active a {
        color: #fff !important;
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



    .breadcrumb-item a {
        color: #1cbbb4;
    }

    .breadcrumb-item a:hover {
        text-decoration: none;
    }

    .bg-category {
        background: #1cbbb4;
    }

    .card {
        /* margin-top: 7rem; */
    }

    .routeMap {
        margin-top: 2rem;
    }
</style>
<div class="container">
    <div class="row routeMap">
        @yield('routeMap')
    </div>
    <div class="row">
        <div class="col-12 col-sm-3">
            <div class="card bg-light mb-3">
                <div class="card-header bg-category text-white text-uppercase"><i class="fa fa-list"></i> Categories
                </div>
                <ul class="list-group category_block">
                    <li class="list-group-item {{ (request()->routeIs('userprofile')) ? 'bg-active' : '' }}"><a
                            href="userprofile">User Profile</a></li>
                    <li class="list-group-item"><a href="category.html">Wish List</a></li>
                    <li class="list-group-item"><a href="{{route('shopping.index')}}">Cart</a></li>
                    <li class="list-group-item {{ (request()->routeIs('myreviews')) ? 'bg-active' : '' }}"><a
                            href="{{route('myreviews')}}">My Reviews</a></li>
                </ul>
            </div>
        </div>
        <div class="col">
            @yield('context')
        </div>

    </div>
</div>
@endsection
