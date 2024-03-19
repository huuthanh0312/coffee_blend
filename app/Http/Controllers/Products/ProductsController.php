<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\Cart;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product\Order;


class ProductsController extends Controller
{
    // info product controller
    public function singleProduct($id){
        $product = Product::find($id);

        $relatedProducts = Product::where('type', $product->type)
                            ->where('id' , '!=', $id)->take('4')
                            ->orderBy('id', 'desc')->get();

        $countCart = Cart::where('pro_id', $id)->where('user_id', Auth::user()->id)->count();
        return view('products.productsingle', compact('product', 'relatedProducts', 'countCart'));

    }

    // add cart controller
    public function addCart(Request $request, $id){
        $addCart  = Cart::Create([
            'pro_id' =>$request->pro_id,
            'name' =>$request->name,
            'image' =>$request->image,
            'price' =>$request->price,
            'user_id' =>Auth::user()->id,
        ]);

        return Redirect::route('product.single', $id)->with(['success' =>'Product Add To Cart Success']);

    }
    // show cart controller
    public function showCart(){
        $cartProduct  = Cart::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        $totalCart = Cart::where('user_id', Auth::user()->id)->sum('price');
     
        return view('products.cart', compact('cartProduct','totalCart'));

    }
        // delete cart controller
        public function deleteProductCart($id){
            $deleteProductCart = Cart::where('pro_id', $id)->where('user_id', Auth::user()->id);

            $deleteProductCart->delete();
            if($deleteProductCart ){
                return Redirect::route('cart', $id)->with(['delete' =>'Product Delete To Cart Success']);
            }
            return Redirect::route('product.single', $id)->with(['success' =>'Product Add To Cart Success']);
    
        }

        public function prepareCheckout(Request $request){
            $price = $request->price;
            $value = Session::put('price', $price);
            $newPrice = Session::get($value);

            if($newPrice > 0 ){
                return Redirect::route('checkout');
            }
            
    
        }

        //check out redirect routes
        public function Checkout(){
            
            return view('products.checkout');
            
    
        }
        // add cart controller
        public function storeCheckout(Request $request){
            $checkout  = Order::Create($request->all());
            echo "welcome to paypal ";
            //return Redirect::route('product.single', $id)->with(['success' =>'Product Add To Cart Success']);

        }
}
