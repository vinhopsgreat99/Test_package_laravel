<?php

namespace Vinh\Pkg\Http\Controllers;

use  Vinh\Pkg\Models\Cart;

use  Vinh\Pkg\Models\User;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Vinh\Pkg\Models\Category;

use Vinh\Pkg\Models\Product;

use Vinh\Pkg\Models\Order;


use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\FuncCall;

//Processing the data in the admin's page
class AdminController extends Controller
{
    public function view_category()
    {
        $data = category::all();
        return view('pkg::admin.category', compact('data'));
    }

    public function add_category(Request $request)
    {
        $data = new category;
        $data->category_name = $request->category;
        $data->save();

        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function delete_category($id)
    {
        $data = category::find($id);

        $data->delete();

        return redirect()->back()->with('message', 'Category Delete Successfully');
    }

    public function view_product()
    {
        $category = category::all();
        return view('vinh.pkg.admin.product', compact('category'));
    }

    public function add_product(Request $request)
    {
        $product = new product;

        $product->title = $request->title;

        $product->description = $request->description;

        $product->price = $request->price;

        $product->quantity = $request->quantity;

        $product->discount_price = $request->dis_price;

        $product->category = $request->category;

        $image = $request->image;

        if ($image) {

            $imagename = time() . '.' . $image->getClientOriginalExtension();

            $request->image->move('product', $imagename);

            $product->image = $imagename;
        }

        $product->save();

        return redirect()->back()->with('message', 'Product Added Successfully');
    }

    public function show_product()
    {
        $product = product::all();
        return view('admin.show_product', compact('product'));
    }

    public function delete_product($id)
    {
        $product = product::find($id);
        $product->delete();
        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }

    public function update_product($id)
    {
        $product = product::find($id);
        $category = category::all();
        return view('admin.update_product', compact('product', 'category'));
    }

    public function update_product_confirm(Request $request, $id)
    {
        $product = product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $image = $request->image;

        if ($image) {

            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image = $imagename;
        }

        $product->save();
        return redirect()->back();
    }

    public function order() {
        $order = order::all();
        return view('admin.order', compact('order'));
    }

    public function delivered($id) {
        $order = order::find($id);
        $order->delivery_status = "delivered";
        $order->payment_status = "paid";
        $order->save();
        return redirect()->back();
    }

    public function searchdata(Request $request) {
        $searchText = $request->search;

        $order = order::where('name', 'LIKE', "%$searchText%")->orWhere('product_title', 'LIKE', "%$searchText%")->get();

        return view('admin.order', compact('order'));
        
    }
}
