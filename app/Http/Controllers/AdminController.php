<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() 
    {
        return view('index');   
    }

    public function register() 
    {
        return view('register');   
    }

    public function postRegister(Request $request) 
    {
        $name = $request->input('name');
        $birthday = $request->input('birthday');
        $phone = $request->input('phone');
        $gender = $request->input('gender');
        $address = $request->input('address');
        $job = $request->input('job');

        DB::table('nhanvien')->insert([
            'TenNV' => $name,
            'GioiTinh' => $gender,
            'NgaySinh' => $birthday,
            'DiaChi' => $address,
            'DienThoai'=>$phone,
            'MaCV' => $job
        ]);

        echo "<script>alert('Staff registration successfully.'); location='.'</script>";
    }
    
    public function createBill()
    {
        $staffs = DB::table('nhanvien as a')->join('chucvu as b','a.MaCV','b.MaCV')->get();
        $this->data['staffs'] = $staffs ?? [];
        return view('createBill', $this->data); 
    }

    public function showProduct()
    {
        $products = DB::table('sanpham as a')->join('chitietsanpham as b','a.MaSP','b.MaSP')->get();
        $this->data['products'] = $products ?? [];
        return view('showProduct', $this->data);
    }

    public function addProduct($id)
    {
        if(session("cart.$id")) {
            session(["cart.$id"=>session("cart.$id")+1]);
        } else {
            session(["cart.$id"=>1]);	
        }
        return redirect('showProduct');
    }   
    
    public function showCart()
    {
        return view('showCart');
    }

    public function cart($action=null,$id=null,Request $request){
		switch ($action) {
			case 'update':
			foreach (array_keys(session('cart')) as $productId) {
				session(["cart.$productId"=>$request->input($productId)]);
            }
			return redirect("showCart");
			break;

			case 'add':
			if(session("cart.$id")){
				session(["cart.$id"=>session("cart.$id")+1]);
			}else{
				session(["cart.$id"=>1]);	
			}
			return redirect('showProduct');
			break;

			case 'delete':
			session()->forget("cart.$id");
			return redirect('showCart');
			break;

			case 'deleteall':
			session()->forget('cart');
			return redirect('showCart');
			break;

			default:
			return view('showCart',$this->data);
			break;	
        }
    }
    
    public function saveBill(Request $request)
    {
        $phone = $request->input('phone');
        $name = $request->input('name');
        $email = $request->input('email');
        $address = $request->input('address');
        $staffId = $request->input('staff');

		DB::table('khachhang')->insert([
            'TenKH' => $name,
            'DiaChi' => $address,
            'DienThoai'=>$phone,
            'Email' => $email
        ]);

        $customer = DB::table('khachhang')->orderBy('MaKH','desc')->first();
		$customerId = $customer->MaKH;

        DB::table('hoadonban')->insert([
			'MaNV' => $staffId,
			'MaKH' => $customerId,
			'NgayBan'=>now()
        ]);
        
		$order = DB::table('hoadonban')->orderBy('SoHDB','desc')->first();
        $orderId = $order->SoHDB;
        $status = $request->input('status');
		foreach (array_keys(session('cart')) as $productId):
			$quantity = session("cart.$productId");
			$product =  DB::table('sanpham')->where('MaSP',$productId)->first();
			$quantity_product = $product->SoLuong;
            $subtotal = $product->DonGiaBan*session("cart.$product->MaSP");
			$price = $product->DonGiaBan;
			DB::table('chitiethdb')->insert([
				'SoHDB' => $orderId,
				'MaSP' => $productId,
				'SoLuong' => $quantity,
                'DonGia' => $price,
                'ThanhTien' => $subtotal,
                'TrangThai' => $status
			]);
		endforeach;
		session()->forget("cart");
		echo "<script>alert('Save bill successfully.'); location = '.'</script>";
	}
}
