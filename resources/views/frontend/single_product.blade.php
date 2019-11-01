@extends('layouts.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@section('title', 'Potted Pan - Selling Kitchen Utensils')
@section('content')

<style>
    nav>.nav.nav-tabs {

        border: none;
        color: #fff;
        background: #272e38;
        border-radius: 0;

    }

    nav>div a.nav-item.nav-link,
    nav>div a.nav-item.nav-link.active {
        border: none;
        padding: 18px 25px;
        color: #fff;
        background: #272e38;
        border-radius: 0;
    }

    nav>div a.nav-item.nav-link.active:after {
        content: "";
        position: relative;
        bottom: -60px;
        left: -10%;
        border: 15px solid transparent;
        border-top-color: #e74c3c;
    }

    .tab-content {
        background: #fdfdfd;
        line-height: 25px;
        border: 1px solid #ddd;
        border-top: 5px solid #e74c3c;
        border-bottom: 5px solid #e74c3c;
        padding: 30px 25px;
        width: 71.5rem;
    }

    nav>div a.nav-item.nav-link:hover,
    nav>div a.nav-item.nav-link:focus {
        border: none;
        background: #e74c3c;
        color: #fff;
        border-radius: 0;
        transition: background 0.20s linear;
    }

    .rating {
        float: left;
    }

    /* :not(:checked) is a filter, so that browsers that don’t support :checked don’t
      follow these rules. Every browser that supports :checked also supports :not(), so
      it doesn’t make the test unnecessarily selective */
    .rating:not(:checked)>input {
        position: absolute;
        clip: rect(0, 0, 0, 0);
    }

    .rating:not(:checked)>label {
        float: right;
        width: 1em;
        /* padding:0 .1em; */
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 300%;
        /* line-height:1.2; */
        color: #ddd;
    }

    .rating:not(:checked)>label:before {
        content: '★ ';
    }

    .rating>input:checked~label {
        color: dodgerblue;

    }

    .rating:not(:checked)>label:hover,
    .rating:not(:checked)>label:hover~label {
        color: dodgerblue;

    }

    .rating>input:checked+label:hover,
    .rating>input:checked+label:hover~label,
    .rating>input:checked~label:hover,
    .rating>input:checked~label:hover~label,
    .rating>label:hover~input:checked~label {
        color: dodgerblue;

    }

    .rating>label:active {
        position: relative;
        top: 2px;
        left: 2px;
    }

</style>

<!--Main layout-->
<main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">

        <!--Grid row-->
        <div class="row wow fadeIn">

            <!--Grid column-->
            <div class="col-md-6 mb-4">

                <img src="{{asset('storage/'. $product->image)}}" class="img-fluid" alt="">

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-6 mb-4">

                <!--Content-->
                <div class="p-4">

                    <div class="mb-3">
                        <a href="">
                            <span class="badge purple mr-1">{{$product->categories->title}}</span>
                        </a>
                        {{-- <a href="">
                            <span class="badge blue mr-1">New</span>
                        </a> --}}
                        {{-- <a href="">
                            <span class="badge red mr-1">Bestseller</span>
                        </a> --}}
                    </div>
                    <p class="lead font-weight-bold">{{$product->name}}</p>
                    <p class="lead">
                        {{-- <span class="mr-1">
                <del>$200</del>
              </span> --}}
                        <span>${{$product->price}}</span>
                    </p>

                    <p class="lead font-weight-bold">Description</p>

                    <div class="pb-2">
                        {!!$product->description!!}
                    </div>


                    <form class="d-flex justify-content-left" action="{{route('shopping.add')}}" method="post">
                        @csrf
                        <!-- Default input -->
                        <input type="number" value="1" aria-label="Search" class="form-control" style="width: 100px"
                            name="qty">
                        <input type="hidden" name="pdt_id" value="{{$product->id}}">
                        <button class="btn btn-primary btn-md my-0 p" type="submit">Add to cart
                            <i class="fas fa-shopping-cart ml-1"></i>
                        </button>

                    </form>

                </div>
                <!--Content-->

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

        <hr>

        <!--Grid row-->
        <div class="row d-flex justify-content-center wow fadeIn">

            <!--Grid column-->
            <div class="col-md-6 text-center">

                <h4 class="my-4 h4">Additional information</h4>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus suscipit modi sapiente illo soluta
                    odit
                    voluptates,
                    quibusdam officia. Neque quibusdam quas a quis porro? Molestias illo neque eum in laborum.</p>

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

        {{-- <!--Grid row-->
        <div class="row wow fadeIn">

            <!--Grid column-->
            <div class="col-lg-4 col-md-12 mb-4">

                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/11.jpg" class="img-fluid"
                    alt="">

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-4 col-md-6 mb-4">

                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/12.jpg" class="img-fluid"
                    alt="">

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-4 col-md-6 mb-4">

                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/13.jpg" class="img-fluid"
                    alt="">

            </div>
            <!--Grid column--> --}}

        </div>
        <!--Grid row-->

    </div>
</main>
<!--Main layout-->

{{-- Review --}}
<section>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 ">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-reviews"
                            role="tab" aria-controls="nav-reviews" aria-selected="true">Reviews</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-write" role="tab"
                            aria-controls="nav-write" aria-selected="false">Write A Review</a>
                    </div>
                </nav>
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    @if (Auth::user())
                    @if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                    <div class="tab-pane fade show active" id="nav-reviews" role="tabpanel"
                        aria-labelledby="nav-home-tab">
                        @foreach ($productItemsAdmin as $item)
                        @foreach ($item->reviews as $review)
                        @php
                        $user = $review->users;
                        $rating = number_format($review->rating);
                        @endphp
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1 mr-5">
                                        <img src="https://image.ibb.co/jw55Ex/def_face.jpg"
                                            class="img img-rounded img-fluid" />
                                        <p style="font-size:12px" class="pt-2 text-secondary text-center">
                                            {{$review->updated_at->diffForHumans()}}
                                        </p>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                            <a class="float-left"
                                                href="https://maniruzzaman-akash.blogspot.com/p/contact.html"><strong>{{$user->fname}}&nbsp;{{$user->lname}}</strong></a>
                                            <span class="float-right">
                                                @if($review->is_approved == 2)
                                                <span class="badge badge-success">Approved</span>
                                                @elseif($review->is_approved == 1)
                                                <span class="badge badge-warning">Pending</span>
                                                @else
                                                <span class="badge badge-danger">Block</span>
                                                @endif
                                            </span>
                                            <br>
                                            @for ($i = 0; $i < 5 - $rating; $i++) <span class="float-right"><i
                                                    class="text-warning far fa-star"></i></span>
                                                @endfor
                                                @for ($i = 0; $i < $rating; $i++) <span class="float-right"><i
                                                        class="text-warning fa fa-star"></i></span>
                                                    @endfor


                                        </p>
                                        <div class="clearfix"></div>
                                        <p>{{$review->comment}}
                                        </p>

                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                        @endforeach


                    </div>
                    @else
                    <div class="tab-pane fade show active" id="nav-reviews" role="tabpanel"
                        aria-labelledby="nav-home-tab">
                        @foreach ($productItemsUser as $item)
                        @foreach ($item->reviews as $review)
                        @php
                        $user = $review->users;
                        $rating = number_format($review->rating);
                        @endphp
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1 mr-5">
                                        <img src="https://image.ibb.co/jw55Ex/def_face.jpg"
                                            class="img img-rounded img-fluid" />
                                        <p style="font-size:12px" class="pt-2 text-secondary text-center">
                                            {{$review->updated_at->diffForHumans()}}
                                        </p>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                            <a class="float-left"
                                                href="https://maniruzzaman-akash.blogspot.com/p/contact.html"><strong>{{$user->fname}}&nbsp;{{$user->lname}}</strong></a>

                                            @for ($i = 0; $i < 5 - $rating; $i++) <span class="float-right"><i
                                                    class="text-warning far fa-star"></i></span>
                                                @endfor
                                                @for ($i = 0; $i < $rating; $i++) <span class="float-right"><i
                                                        class="text-warning fa fa-star"></i></span>
                                                    @endfor


                                        </p>
                                        <div class="clearfix"></div>
                                        <p>{{$review->comment}}
                                        </p>

                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                        @endforeach


                    </div>
                    @endif
                    @else
                    <div class="tab-pane fade show active" id="nav-reviews" role="tabpanel"
                        aria-labelledby="nav-home-tab">
                        @foreach ($productItemsUser as $item)
                        @foreach ($item->reviews as $review)
                        @php
                        $user = $review->users;
                        $rating = number_format($review->rating);
                        @endphp
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1 mr-5">
                                        <img src="https://image.ibb.co/jw55Ex/def_face.jpg"
                                            class="img img-rounded img-fluid" />
                                        <p style="font-size:12px" class="pt-2 text-secondary text-center">
                                            {{$review->updated_at->diffForHumans()}}
                                        </p>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                            <a class="float-left"
                                                href="https://maniruzzaman-akash.blogspot.com/p/contact.html"><strong>{{$user->fname}}&nbsp;{{$user->lname}}</strong></a>

                                            @for ($i = 0; $i < 5 - $rating; $i++) <span class="float-right"><i
                                                    class="text-warning far fa-star"></i></span>
                                                @endfor
                                                @for ($i = 0; $i < $rating; $i++) <span class="float-right"><i
                                                        class="text-warning fa fa-star"></i></span>
                                                    @endfor


                                        </p>
                                        <div class="clearfix"></div>
                                        <p>{{$review->comment}}
                                        </p>

                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                        @endforeach


                    </div>
                    @endif





                    <div class="tab-pane fade" id="nav-write" role="tabpanel" aria-labelledby="nav-profile-tab">



                        <form accept-charset="UTF-8" action="{{route('reviews')}}" method="post" enctype="multipart/form-data
                        ">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <textarea class="form-control animated" cols="500" id="new-review" name="comment"
                                placeholder="Enter your review here..." rows="5" required></textarea>

                            <div class="text-right">
                                <div class="container">
                                    <div class="rating">
                                        <input type="radio" id="star5" name="rating" value="5" /><label class="py-3"
                                            for="star5" title="Meh">5 stars</label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label class="py-3"
                                            for="star4" title="Kinda bad">4 stars</label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label class="py-3"
                                            for="star3" title="Kinda bad">3 stars</label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label class="py-3"
                                            for="star2" title="Sucks big tim">2 stars</label>
                                        <input type="radio" id="star1" name="rating" value="1" checked /><label
                                            class="py-3" for="star1" title="Sucks big time">1 star</label>
                                    </div>
                                </div>

                                <button id="reviewSave" class="btn btn-success btn-md" type="submit">Save</button>
                            </div>
                        </form>



                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>

</section>





<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>


@endsection
