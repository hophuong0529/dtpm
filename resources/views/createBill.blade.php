<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creation Bill</title>
    <!-- Main css -->
    <link rel="stylesheet" href="{{url('public/css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    @if(session('cart'))
    <?php 
        $products = DB::table('sanpham as a')->join('chitietsanpham as b','a.MaSP','b.MaSP')->whereIn('a.MaSP',array_keys(session('cart')))->get();
    ?>
    <div class="main" style="background-color: #caddd9;">
        <div class="container" style="width: 1190px;">
            <form method="POST" class="appointment-form" id="appointment-form">
                @csrf
                <h2><center>Creation Bill</h2>
                <div class="form-group-1">
                    <h4 style="padding: 20px 20px 20px 0px;">Customer Infomation</h4>
                    <table>
                        <tr>
                            <td style="padding-right: 30px;"><input type="text" style="width: 300px;" name="phone" id="phone" placeholder="Phone Number" required /></td>
                            <td style="padding-right: 30px;"><input type="text" style="width: 300px;" name="name" id="name" placeholder="Your Name" required /></td>
                            <td><input type="email"  style="width: 403px;" name="email" id="email" placeholder="Email" /></td>
                        </tr>
                    </table>
                    <input type="text" name="address" id="address" placeholder="Address">
                </div>
                
                <div class="form-group-2" style="color: black; text-align: left;">
                    <h4 style="padding: 40px 20px 20px 0px;">Products Infomation</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="product-name" style="width: 50%;">Product Name</th>
                                <th class="product-total">Product Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr class="cart_item">
                                <td class="product-name">
                                {{ $product->TenSP }} <strong class="product-quantity">&times;&nbsp;{{ session("cart.$product->MaSP") }}</strong>
                                </td>
                                <td class="product-total">
                                {{ number_format($product->DonGiaBan*session("cart.$product->MaSP"),0,',','.') }} VNĐ
                                </td>
                            </tr>
                            @endforeach	
                        </tbody>
                        <tfoot>
                            <tr class="cart-subtotal">
                                <th>Subtotal</th>
                                <td><span>{{ number_format(session('total'),0,',','.') }} VNĐ</span></td>
                            </tr>
                            <tr class="shipping">
                                <th>Shipping Fee</th>
                                <td><span>Free</span></td>
                            </tr>
                            <!-- <tr class="discount">
                                <th>Discount</th>
                                <td>
                                    <select class="form-control" name="discount">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="5">5% - Product in 2019</option>
                                        <option value="10">10% - Product in 2018</option>
                                        <option value="">Not Discount</option>
                                    </select> 
                                </td>
                            </tr> -->
                            <tr class="status">
                                <th>Status</th>
                                <td>
                                    <select class="form-control" name="status">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Unpaid">Unpaid</option>
                                        <option value="Export">Export warehouse</option>
                                    </select>   
                                </td>
                            </tr>		
                            <tr class="order-total">
                                <th>Bill Total</th>
                                <td><strong><span></span>{{ number_format(session('total'),0,',','.') }} VNĐ</span></strong> </td>
                            </tr>
                        </tfoot>
                    </table>      
                </div>
                <div class="form-group">
                    <h4 style="padding: 40px 20px 20px 0px;">Staff Infomation</h4>
                    <select class="form-control" name="staff">
                        <option disabled="disabled" selected="selected">Choose option</option>
                        @foreach($staffs as $staff)
                        <option value="{{ $staff->MaNV }}">Name: {{ $staff->TenNV }} -- Job: {{ $staff->TenCV }}</option>
                        @endforeach      
                    </select>
                </div>  
                <div style="padding-top: 50px; text-align: center;">
                    <a onclick="return confirm('Are you sure cancel?');" class="btn btn-danger" href="{{ url('showCart') }}" style="width: 250px;">Back to cart</a>
                    &nbsp;
                    <input type="submit" value="Save Bill" class="btn btn-success" style="width: 250px;">
                </div>    
            </form>     
        </div>
    </div>
    <script src="{{url('public/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('public/js/main-b.js')}}"></script>
    @endif
</body>
</html>