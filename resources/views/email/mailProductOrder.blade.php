<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        .bl{
           border-right: 1px solid black;
        }
        .bt{
           border-bottom: 1px solid black;
        }
    </style>
</head>

<body>
    <header class="container justify-content-center">
        <img src="{{$message->embed(asset('img/pp_logo.png'))}}" width="150px" height="50px">
    </header>
    <div class="container">
        <div>
            <h3>Hello, {{$reciever}}</h3>
            <p>Thank you for ordering. Your product(s) will be shipped to you by your address that you provide us and we
                will contact your via your email(s) or phone number.</p>
            <p>Please reply to this email if you have any question.</p>
        </div>
        <div>
            <div class="row bg-secondary">
                <div class="col-md-12">
                    Order Details
                </div>

            </div>
            <div class="row">
                <div class="col-md-6 border border-secondary">
                    Order Number: 125
                    <br>
                    Date Added: 20/11/2019
                    <br>
                    Payment Method: Visa Card
                    <br>
                    Shipping Method: Motorbike
                </div>
                <div class="col-md-6 border border-secondary">
                    Email 1: lucksolent@gmail.com
                    <br>
                    Email 2: lucksolent@gmail.com
                    <br>
                    Telephone 1: 018 608 2767
                    <br>
                    Telephone 2: 018 608 2767
                </div>
            </div>
            <div class="row bg-secondary">
                <div class="col-md-12">
                     Delivery Date
                </div>

            </div>
             <div class="row">
                <div class="col-md-12 border border-secondary">
                   Date
                </div>
            </div>
            <div class="row bg-secondary">
                <div class="col-md-6 bl">
                    Payment Address
                </div>
                <div class="col-md-6 border border-secondary">
                    Shipping Address
                </div>

            </div>
             <div class="row">
                <div class="col-md-6 border border-secondary">
                    Address
                </div>
                <div class="col-md-6 border border-secondary">
                    Address
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 border border-secondary">
                    Address
                </div>
                <div class="col-md-6 border border-secondary">
                    Address
                </div>
            </div>
            <div class="row bg-secondary">
                <div class="col-md-4 bl ">
                    Product Name
                </div>
                <div class="col-md-2 bl ">
                    SKU
                </div>
                <div class="col-md-2 bl ">
                    Qty
                </div>
                 <div class="col-md-2 bl">
                    Price
                </div>
                <div class="col-md-2">
                    Total
                </div>


            </div>
             <div class="row">
                <div class="col-md-4 border border-secondary">
                    Product Name
                </div>
                <div class="col-md-2 border border-secondary">
                    SKU
                </div>
                <div class="col-md-2 border border-secondary">
                    Qty
                </div>
                 <div class="col-md-2 border border-secondary">
                    Price
                </div>
                <div class="col-md-2 border border-secondary">
                    Total
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 border border-secondary">

                </div>
                 <div class="col-md-2 bt bg-secondary">
                    Shipping Price
                </div>
                <div class="col-md-2 border border-secondary">
                    Price
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 border border-secondary">

                </div>
                 <div class="col-md-2 bg-secondary">
                    Grand Total
                </div>
                <div class="col-md-2 border border-secondary">
                    Total
                </div>
            </div>

        </div><br>
        <section>
            Thanks, <br><br>
                Team Potted Pan
        </section>
    </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
