@extends('layouts.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@section('title', 'Potted Pan - Selling Kitchen Utensils')
@section('content')

<style>
    footer {
        position: relative !important;
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
<div class="px-4 px-lg-0 pt-4">

    <div class="pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

                    <!-- Shopping cart table -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Product</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Price</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Quantity</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Remove</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(Cart::content() as $product)
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <img src="{{asset('storage/'. $product->model->image)}}" alt="" width="70"
                                                class="img-fluid rounded shadow-sm">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0"> <a href="#"
                                                        class="text-dark d-inline-block align-middle">{{$product->name}}</a>
                                                </h5><span
                                                    class="text-muted font-weight-normal font-italic d-block">Category:
                                                    Watches</span>
                                            </div>
                                        </div>
                                    </th>
                                    @if (!empty($product->priceAfterPro))
                                    <td class="border-0 align-middle">
                                        ${{$product->price}}&nbsp;
                                        <strong>${{$product->priceAfterPro}}</strong>
                                    </td>

                                    @else
                                    <td class="border-0 align-middle"><strong>${{$product->price}}</strong></td>
                                    @endif
                                    {{-- <td class="border-0 align-middle"><strong>${{$product->price}}</strong></td> --}}
                                    <td class="border-0 align-middle"><strong>{{$product->qty}}</strong></td>
                                    <td class="border-0 align-middle"><a
                                            href="{{route('shopping.delete' ,['id' =>$product->rowId] )}}"
                                            class="text-dark"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- End -->
                </div>
            </div>

            <div class="row py-5 p-4 bg-white rounded shadow-sm">
                <div class="col-lg-6">
                    <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Coupon code</div>
                    <div class="p-4">
                        <p class="font-italic mb-4">If you have a coupon code, please enter it in the box below</p>
                        <div class="input-group mb-4 border rounded-pill p-2">
                            <input type="text" placeholder="Apply coupon" aria-describedby="button-addon3"
                                class="form-control border-0">
                            <div class="input-group-append border-0">
                                <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i
                                        class="fa fa-gift mr-2"></i>Apply coupon</button>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions for seller
                    </div>
                    <div class="p-4">
                        <p class="font-italic mb-4">If you have some information for the seller you can leave them in
                            the box below</p>
                        <textarea name="" cols="30" rows="2" class="form-control"></textarea>
                    </div> --}}
                </div>
                <div class="col-lg-6">
                    <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
                    <div class="p-4">
                        <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you
                            have entered.</p>
                        <ul class="list-unstyled mb-4">
                            <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                    class="text-muted">Order Subtotal </strong><strong>${{Cart::subtotal()}}</strong>
                            </li>
                            <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                    class="text-muted">Shipping and handling</strong><strong>$00.00</strong></li>
                            <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                    class="text-muted">Tax</strong><strong>$0.00</strong></li>
                            <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                    class="text-muted">Total</strong>
                                <h5 class="font-weight-bold">${{Cart::total()}}</h5>
                            </li>
                        </ul><a href="{{route('checkout')}}" class="btn btn-dark rounded-pill py-2 btn-block">Procceed
                            to checkout</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection
