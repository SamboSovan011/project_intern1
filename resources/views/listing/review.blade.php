@extends('frontend.userMasterPage')
@section('title', 'Potted Pan - My Reviews')
@section('routeMap')
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="category.html">Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Reviews</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection
@section('context')
<style>
    .review-content {
        margin: 0 0 3rem 0;
    }

    .review-comment {
        margin: 1.5rem 0;
        font-size: 1.5rem !important;
        font-style: italic;
    }

    .card-title {
        color: #1cbbb4;
    }


    .pro-info {
        margin: 2rem 0 0 0;
    }

    .btn-edit {
        background: #1cbbb4;
        color: #fff;
        border: none;
        text-decoration: none;
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
@foreach ($productItems as $item)
@foreach ($item->reviews as $review)
<div class="card review-content">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h5 class="card-title">{{$item->name}}</h5>
                <img src="{{asset('storage/'.$item->image)}}" alt="product-img" width="200" height="150">
            </div>
            <div class="col-md-8 ">


                <div class="float-right">
                    @if ($review->is_approved == 2)
                    <span class="badge badge-success">Approved</span>
                    @elseif($review->is_approved == 1)
                    <span class="badge badge-warning">Pending</span>
                    @else
                    <span class="badge badge-danger">Block</span>
                    @endif
                    <br><br>
                    @php
                    $rating = number_format($review->rating);
                    @endphp
                    <span>
                        @for ($i = 0; $i < 5 - $rating; $i++) <span class="float-right"><i
                                class="text-warning far fa-star"></i></span>
                    @endfor
                    @for ($i = 0; $i < $rating; $i++) <span class="float-right"><i
                            class="text-warning fa fa-star"></i></span>
                        @endfor
                        </span>
                        <br>
                        <span>
                            {{$review->rating}} / 5 stars
                        </span>
                        <br>
                        {{$review->updated_at->diffForHumans()}}
                </div>
                <div class="pro-info">
                    Product Name: <span>{{$item->name}}</span><br>
                    Product Description: <span>{{$item->description}}</span><br>
                    Price: <span>{{$item->price}}</span><br>
                    SKU: <span>{{$item->SKU}}</span><br>
                    Stock: <span>{{$item->stock}}</span><br>
                    Date Posted: <span>{{$item->updated_at}}</span><br>
                </div>



            </div>
        </div>
        <p class="my-3" style="color:#1cbbb4">
            Comment:
        </p>

        <p class="card-text review-comment text-center">"{{$review->comment}}"</p>

        <a href="{{route('single-products.show', $item->id)}}" class="btn btn-primary">View Post</a>
        <span class="float-right">
            <button id="{{$review->id}}" data-url="{{route('editreview', ['id' => $review->id])}}" type="button"
                class="btn btn-edit review-edit" data-target="#reviewModal" data-toggle="modal">Edit Review</button>
        </span>
    </div>
</div>

@endforeach

@endforeach

<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Change Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="review-form" method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input id="review-comment" type="text" name="comment" class="form-control"
                            placeholder="Enter new comment here" value="">
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
                                    <input type="radio" id="star1" name="rating" value="1" checked /><label class="py-3"
                                        for="star1" title="Sucks big time">1 star</label>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary pass-btn">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(document).on('click', '.review-edit', function(e){
            var id = $(this).attr('id');
            var _token = $('input[name="_token"]').val();
            var url =  $(".review-edit").data('url');

            $.ajax({
                url: "/user/getComment/"+id,
                type: "GET",
                data:{id:id, _token:_token},
                success:function(html){

                $('#review-comment').val(html.data.comment);
                $('#review-form').attr('action', url);

                }
            })
        });

    })
</script>

@endsection
