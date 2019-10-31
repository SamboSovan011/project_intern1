@extends('dashboard.app')
@section('title', (isset($products) ? 'Potted Pan - Edit Product':'Potted Pan -Add Product'))
@section('content')
<style>
    #form {
        padding: 3rem;
    }
</style>
<section class="content-header">
    <h1>{{isset($products) ? 'Edit Product':'Post Product'}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('products.index')}}">Product</a></li>
        <li class="active">{{isset($products) ? 'Edit Product':'Post Product'}}</li>
    </ol>
</section>

<section id="form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{isset($products) ? 'Edit Product':'Post Product'}}</h3>
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
        <form role="form" method="POST"
            action="{{isset($products) ? route('products.update', $products->id): route('products.store')}}"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            @if(isset($products))
            @method('PUT')
            @endif
            <div class="box-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-6">
                            <label for="name">Name</label>
                            <input name="name" type="text" class="form-control" id="name" required
                                value=" {{isset($products)? $products->name : ''}} ">
                        </div>

                        <div class="col-xs-6">
                            <label for="name">Price</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input name="price" type="text" class="form-control" id="price" placeholder="Price "
                                    required value=" {{isset($products)? $products->price : ''}}">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-4">
                            <label for="product_code">Product Code</label>
                            <input name="SKU" type="text" class="form-control" id="sku" placeholder="SKU"
                                value=" {{isset($products)? $products->SKU : ''}}" required>
                        </div>

                        <div class="col-xs-4">
                            <label for="product_stock">Stock</label>
                            <input name="stock" type="text" class="form-control" id="sku" placeholder="Stock" required
                                value=" {{isset($products)? $products->stock : ''}}">
                        </div>


                        <div class="col-xs-4">
                            <label for="category">Category</label>
                            <select class="form-control" name="category">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" @if(isset($products)) @if($category->id ===
                                    $products->categories_id)
                                    selected
                                    @endif
                                    @endif

                                    >{{$category->title}}</option>

                                @endforeach
                            </select>
                        </div>


                    </div>
                </div>
                <div class="form-group">
                    <label>Discount(%):</label>
                    <input id="discount" name="discount" class="form-control" type="text"
                        placeholder="Percentage Discount">
                    <span class="text-red" id="discountErrorM" hidden>Please input correct Percentage! (0 -> 100)</span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Start Promotion Date:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input name="start-date" type="text" class="form-control pull-right" id="startdate">

                            </div>
                            <span class="text-red" id="startErrorM" hidden>Start Date can't be later than end
                                    date</span>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>End Promotion Date:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input name="end-date" type="text" class="form-control pull-right" id="enddate">

                            </div>
                            <span class="text-red" id="endErrorM" hidden>End Date can't be earlier than start
                                    date</span>
                        </div>

                    </div>
                </div>


                <div class="form-group">
                    <label for="description">Description</label>

                    <input id="desc" type="hidden" name="description"
                        value=" {{isset($products)? $products->description : ''}}" width="100%">
                    <trix-editor input="desc"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image">


                </div>

                <div class="form-group">
                    @if(isset($products))
                    <img src="{{asset('storage/'. $products->image)}}" style="width: 20%">
                    @endif
                </div>

            </div>


            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-save">{{isset($products) ? 'Update':'Post'}}</button>
            </div>
        </form>
    </div>
</section>
<script>
    addEventListener("trix-attachment-add", event => {
        const {
            attachment
        } = event
        setTimeout(() => {
            attachment.remove()
        }, 1000)
    })


    $(document).ready(function(){


        $('#discount').blur(function(e){
            e.preventDefault();
            var endDate = new Date($('#enddate').val());
            var startDate = new Date($('#startdate').val());
            var disc = $(this).val();
            var num_disc = parseFloat(disc);
            if(num_disc < 0 || num_disc > 100){
                $('#discountErrorM').attr('hidden', false);
                $('.btn-save').attr('disabled', true);
            }else{
                $('#discountErrorM').attr('hidden', true);
                if(startDate > endDate){
                    $('#startErrorM').attr('hidden', false);
                    $('#endErrorM').attr('hidden', false);
                    $('.btn-save').attr('disabled', true);
                }else{
                    $('#startErrorM').attr('hidden', true);
                    $('#endErrorM').attr('hidden', true);
                    $('.btn-save').attr('disabled', false);
                }
            }
        })

        $('#enddate, #startdate').change(function(){

            var endDate = new Date($('#enddate').val());
            var startDate = new Date($('#startdate').val());
            var disc = $('#discount').val();
            var num_disc = parseFloat(disc);

            if(startDate > endDate){
                $('#startErrorM').attr('hidden', false);
                $('#endErrorM').attr('hidden', false);
                $('.btn-save').attr('disabled', true);



            }else{
                $('#startErrorM').attr('hidden', true);
                $('#endErrorM').attr('hidden', true);
                // $('.btn-save').attr('disabled', false);
                if(num_disc < 0 || num_disc > 100){
                    $('#discountErrorM').attr('hidden', false);
                    $('.btn-save').attr('disabled', true);
                }else{
                    $('#discountErrorM').attr('hidden', true);
                    $('.btn-save').attr('disabled', false);
                }
            }
        })







    })


</script>
<script>
    $(function () {


      //Date picker
      $('#startdate').datepicker({
        autoclose: true
      })
      $('#enddate').datepicker({
        autoclose: true
      })


    })
</script>
@endsection
