<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response($products, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $tempString = explode('-', $slug);
        $id = $tempString[count($tempString) - 1];

        $result = Product::where('id', $id)->get();

        if (count($result) == 0) {
            abort(404, 'Products not found');
        }

        return response($result, 200);
    }

    /**
     * Search product by key
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function searchByName($key)
    {
        if(is_array($key) || is_object($key) || is_null($key) || $key == ' ') {
            return 'Param invalid';
        }
        $result = Product::where('name', 'like', '%' . $key . '%')->get();

        if (count($result) == 0) {
            abort(404, 'Products not found');
        }

        return response($result, 200);
    }

    /**
     * Get product by categories
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function getByCategory($id)
    {
        // $result = Product::where('category', '=', $id)->get();

        $id = base64_decode($id);
        $id = substr($id, 3);
        // dd($id);
        $result = Product::with('Category')->where('category', $id)->get();

        if (count($result) == 0) {
            abort(404, 'Products not found');
        }

        return response($result, 200);
    }

    /**
     * Rating products
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function ratingProducts(Request $request, $id)
    {
        $request->validate([
            'value' => 'required|integer|min:0|max:5'
        ]);

        $product = Product::findOrFail($id);
        $oldRate = $product->rating_value;
        $oldRateTimes = $product->rating_times;
        $newRate = $request['value'];

        $newRate = round((($oldRateTimes * $oldRate) + $newRate) / ($oldRateTimes + 1), 2);

        $product->rating_value = $newRate;
        $product->rating_times = $oldRateTimes + 1;
        $product->save();

        return response('Rating successfully', 200);
    }

    /**
     * Filter products by price
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function filterProductByPrice(Request $request)
    {
        $request->validate([
            'start' => 'required|integer|min:0|',
            'end' => 'required|integer|gte:start'
        ]);

        $result = Product::where([['price', '>=', $request['start']], ['price', '<=', $request['end']]])->get();

        if (count($result) == 0) {
            abort(404, 'No products match condition');
        }

        return response($result, 200);
    }

    /**
     * Filter products by rating_value
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function filterProductByRatingValue(Request $request)
    {
        $request->validate([
            'start' => 'required|integer|min:0|max:5',
            'end' => 'required|integer|min:0|max:5|gte:start'
        ]);

        $result = Product::where([['rating_value', '>=', $request['start']], ['rating_value', '<=', $request['end']]])->get();

        if (count($result) == 0) {
            abort(404, 'No products match condition');
        }

        return response($result, 200);
    }
}
