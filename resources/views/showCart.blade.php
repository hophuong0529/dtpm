<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Cart</title>

    <!-- Icons font CSS-->
    <link href="{{url('public/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <link href="{{url('public/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="{{url('public/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{url('public/vendor/datepicker/daterangepicker.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <a href="{{ url('showProduct') }}">
        <img src="{{url('public/images/icons/icons8-left-arrow-50.png')}}" style="padding-left: 50px;">
    </a>
    @if(session('cart'))
    <?php 
        $products = DB::table('sanpham as a')->join('chitietsanpham as b','a.MaSP','b.MaSP')->whereIn('a.MaSP',array_keys(session('cart')))->get();
    ?>
    <?php $tongTien = 0; ?>			
    <h1><center>My Cart</center></h1>
        <div style="padding-top: 50px; padding-left: 40px; padding-right: 40px; text-align: center;">
            <form method="post" action="{{url('cart/update')}}" id= "frm">
                @csrf
                <div class="cart row" style="font-weight: bold;color: #ba1826;padding-bottom: 10px;">
                    <div class="col-sm-1">Product Id</div>
                    <div class="col-md-4">Product Name</div>	
                    <div class="col-md-1">Quantity</div>
                    <div class="col-md-2">Product Price</div>
                    <div class="col-md-2">Total</div>
                    <div class="col-md-2"></div>	
                </div>
                <hr>
                @foreach($products as $product)
                <div class="cart item row">
                    <div class="col-md-1 text-cart">
                        {{ $product->MaSP }}
                    </div>
                    <div class="col-md-4 text-cart">
                        {{ $product->TenSP }}
                    </div>
                    <div class="col-md-1 text-cart">
                        <input class="form-control form-control-sm" min="1" max="{{ $product->SoLuong }}" type="number" name="{{ $product->MaSP }}" value='{{ session("cart.$product->MaSP") }}'>
                    </div>
                    <div class="col-md-2 text-cart">
                        {{ number_format($product->DonGiaBan,0,',','.') }} VNĐ
                    </div>
                    <div class="col-md-2 text-cart">{{ number_format($product->DonGiaBan*session("cart.$product->MaSP"),0,',','.') }} VNĐ</div>
                    <?php 
                        $tongTien = $tongTien + $product -> DonGiaBan*session("cart.$product->MaSP"); 
                        session(['total' => $tongTien]);
                    ?>
                    <div class="col-md-2 text-cart"><a onclick="return confirm('Are you sure delete it?');" href="{{url('cart/delete/'.$product->MaSP)}}" class="btn btn-danger" style="width: 100px;">Delete</a>
                    </div>
                </div>
                <hr>
                @endforeach
                <div class="cart row" style="font-weight: bold;">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2" style="line-height: 55px;">Total bill :</div>
                    <div class="col-md-2" style="color: red; line-height: 50px; font-size: 18px;">{{ number_format($tongTien,0,',','.') }} ₫</div>
                </div>
            </form>
            <hr>
            <div>
                <a onclick="return confirm('Are you sure delete all?');" class="btn btn-danger" href="{{ url('cart/deleteall') }}" style="width: 150px;">Delete all</a>
                &nbsp;
                <input type="submit" value="Update" form="frm" class="btn btn-success" style="width: 150px;">
                &nbsp;
                <a href="{{ url('createBill') }}" class="btn btn-primary" style="width: 150px;">Create bill</a></div>
            </div>
            @else
            <div style="text-align: center;" class="alert alert-warning">Cart is Empty!</div>
        </div>
    @endif
</body>