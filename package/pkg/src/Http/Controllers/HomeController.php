<?php

namespace Vinh\Pkg\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

use  Vinh\Pkg\Models\Cart;

use  Vinh\Pkg\Models\User;

use  Vinh\Pkg\Models\Order;

use Vinh\Pkg\Models\Product;






//Processing the data in the user's page
class HomeController extends Controller
{
    public function index()
    {
        // $product = Product::all(); //for displaying all products
        $product = Product::paginate(2);
       
        // Limit the number of products which be displayed on page
        return view('pkg::userpage', compact('product'));
    }

    //Checking the usertype for accessing admin's page or user's page
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
    
        if ($usertype == '1') {
            // $total_product = product::all()->count();
            // $total_order = order::all()->count();
            // $total_user = user::where('usertype', '=', '0')->count();
            // $order = order::all();
            // $total_revenue = 0;
            
            // foreach($order as $order) {
            //     $total_revenue += $order->price;
            // }
            
            // $total_delivered = order::where('delivery_status', '=', 'delivered')->count();
            // $total_processing = order::where('delivery_status', '=', 'processing')->count();

            
            return view('vinh.pkg.admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'total_processing'));
        } else {
            $product = Product::paginate(2);
            return view('pkg::userpage', compact('product'));
        }
    }

    public function product_details($id)
    {
        $product = product::find($id);
        return view('pkg::product_details', compact('product'));
    }

    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();

            $product = product::find($id);

            $cart = session()->get('cart');

            if ($product->discount_price != null) {
                $product->price = $product->discount_price * $request->quantity;
            } else {
                $product->price *= $request->quantity;
            }


            $cart[$id] = [
                "name" => $user->name,
                "email" => $user->email,
                "phone" => $user->phone,
                "address" => $user->address,
                "user_id" => $user->id,
                "product_title" => $product->title,
                "price" => $product->price,
                "product_id" => $product->id,
                "image" => $product->image,
                "quantity" => $request->quantity
            ];
            
            session()->put('cart', $cart);



            // $cart->name = $user->name;
            // $cart->email = $user->email;
            // $cart->phone = $user->phone;
            // $cart->address = $user->address;
            // $cart->user_id = $user->id;

            // $cart->product_title = $product->title;

            // if ($product->discount_price != null) {
            //     $cart->price = $product->discount_price * $request->quantity;
            // } else {
            //     $cart->price = $product->price * $request->quantity;
            // }


            // $cart->image = $product->image;
            // $cart->product_id = $product->id;

            //cart->quantity = $request->quantity;




            //$cart->save();

            return redirect()->back();


            // } else {
            //     return redirect('login');
            //}
        }
    }

    public function show_cart()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = cart::where('user_id', '=', $id)->get();
            return view('pkg::showcart', compact('cart'));
        } else {
            return redirect('login');
        }
    }

    public function remove_cart($id)
    {
        $cart = cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function cash_order()
    {
        $user = Auth::user();

        $userid = $user->id;

        $data = cart::where('user_id', '=', $userid)->get();


        foreach ($data as $data) {
            $order = new order;

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;

            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->Product_id;

            $order->payment_status = 'cash on delivery';

            $order->delivery_status = 'processing';

            $order->save();

            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }

        return redirect()->back();
    }

    public function show_order()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $order = order::where('user_id', '=', $userid)->get();
            return view('pkg::order', compact('order'));
        } else {
            return redirect('login');
        }
    }

    public function cancel_order($id)
    {
        $order = order::find($id);
        $order->delivery_status = 'delivery failed';

        $order->save();
        return redirect()->back();
    }
}
