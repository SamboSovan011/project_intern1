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

<section>
    <div class="container text-center" style="padding-bottom:8rem;">
        <h3 class="my-5">Product Categories</h3>
        <div class="row d-flex justify-content-center">
            @foreach ($cates as $cate)
            <div class="col-md-4">
                <div class="card m-3">
                    <img class="card-img-top img-fluid" src="{{$cate->img_path}}" alt="kitchen-furniture">
                    <div class="card-body">
                        <h5 class="card-title">{{$cate->title}}</h5>
                        <hr>
                        <p class="card-text">{{$cate->description}}</p>
                    </div>
                </div>
            </div>
            @endforeach

            <script>
                $(document).ready(function(){

                $('.col-md-4').hover(
                    // trigger when mouse hover
                    function(){
                        $(this).animate({
                            marginTop: "-=1%",
                        },200);
                    },

                    // trigger when mouse out
                    function(){
                        $(this).animate({
                            marginTop: "0%"
                        },200);
                    }
                );
            });
            </script>
</section>
<script>
    $(document).ready(function(){
        var idI = $('.slide-list').attr('id');
        var i = $('#'+idI).attr('data-slide-to');
        var idM = $('.carousel-item').attr('id');
        var j = $('#'+idM).attr('data-img');
        if(i == '0' && j == '0'){
            $('#'+idI).addClass('active');
            $('#'+idM).addClass('active');
        }

    })
</script>




{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>

<script type="text/javascript">
    (function($, interval, kitchen) {

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
</script> --}}
@endsection
