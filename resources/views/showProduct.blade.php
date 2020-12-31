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
    <title>Product</title>

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
    <div class="row" style="margin: 30px 30px 30px 150px;">
        <div class="col-md-10">
            <h1 style="text-align: center;">List of products</h1>
        </div>
        <div class="col-md-2">
            <a href="{{url('showCart')}}" class="btn btn-success" style="width: 150px;"><i class="fa fa-bars"></i> Items of bill ()</a>
        </div>
    </div>
    <table class="table" style="text-align: center;">
        <thead>
            <tr>
                <th width="10%">Product ID</th>
                <th width="30%">Product Name</th>
                <th width="15%">Quantity</th>
                <th width="20%">Product Price</th>
                <th width="25%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr> 
                <td width="20%">{{ $product->MaSP }}</td>
                <td width="25%">{{ $product->TenSP }}</td>
                <td width="20%">{{ $product->SoLuong }}</td>
                <td width="15%">{{ number_format($product->DonGiaBan,0,',','.') }}</td>
                <td style="text-align: initial;">
				    <a onclick="return confirm('Thêm -- {{ $product->TenSP }} -- vào hóa đơn?')" style="padding-right: 40px; text-decoration: none;" class="fa fa-plus" href="{{ url('cart/add/'.$product->MaSP) }}"></a>
			    </td>
            </tr>
            @endforeach 
        </tbody>
    </table>

</body>