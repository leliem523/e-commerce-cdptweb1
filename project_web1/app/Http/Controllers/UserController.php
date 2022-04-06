<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required|string',
            'version' => 'required|integer|min:0'
        ]);

        $user = User::findOrFail(Auth::id());

        if ($fields['version'] == $user->version) {
            $user->name = $fields['name'];
            $user->password = bcrypt($fields['password']);
            $user->version = $user->version + 1;
            $user->save();

            $response = [
                'user' => $user
            ];

            return response($response, 201);
        } else {
            return response(['message' => 'There is an error when updating, try again!'], 302);
        }
    }

    // GET ALL ITEM IN CART
    public function getItemInCart()
    {
        $user = User::findOrFail(Auth::id());

        // LAZY LOADING
        // return $user->products;
        // EAGER LOADING
        return $user->loadProductsWithTrash;
    }

    // Add Product to Cart
    public function addProductToCart(Request $request)
    {
        $fields = $request->validate([
            'id_product' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = User::findOrFail(Auth::id());
        $product = Product::findOrFail($fields['id_product']);
        $oldQuantity = 0;
        foreach ($user->loadProductsWithTrash as $pro) {
            if ($pro->id == $fields['id_product']) {
                $oldQuantity = $pro->pivot->quantity;
            }
        }

        $user->products()->syncWithoutDetaching([$product->id => ['quantity' => $oldQuantity + $fields['quantity']]]);

        return response('Add to cart successfully', 200);
    }

    // Update Product in Cart
    public function updateProductInCart(Request $request)
    {
        $fields = $request->validate([
            'id_product' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = User::findOrFail(Auth::id());
        $product = Product::findOrFail($fields['id_product']);

        $exist = false;
        foreach ($user->loadProductsWithTrash as $pro) {
            if ($pro->id == $fields['id_product'])
                $exist = true;
        }

        if ($exist) {
            $user->products()->syncWithoutDetaching([$product->id => ['quantity' => $fields['quantity']]]);
            return response('Update cart successfully!', 200);
        } else {
            return response('Item does not exist!', 401);
        }
    }

    // Remove Product from Cart
    // This is hard delete products function
    public function removeProductFromCart(Request $request)
    {
        $fields = $request->validate([
            'id_product' => 'required|integer',
        ]);

        $user = User::findOrFail(Auth::id());
        $product = Product::findOrFail($fields['id_product']);

        $exist = false;
        foreach ($user->loadProductsWithTrash as $pro) {
            if ($pro->id == $fields['id_product'])
                $exist = true;
        }

        if ($exist) {
            $user->loadProductsWithTrash()->detach($product);
            return response('Remove item from cart successfully!', 200);
        } else {
            return response('Item does not exist!', 401);
        }
    }

    // Soft Delete Product from Cart
    public function softDeleteProductFromCart(Request $request)
    {
        $fields = $request->validate([
            'id_product' => 'required|integer|min:1',
        ]);

        $user = User::findOrFail(Auth::id());
        $product = Product::findOrFail($fields['id_product']);

        $exist = false;
        foreach ($user->loadProductsWithTrash as $pro) {
            if ($pro->id == $fields['id_product'])
                $exist = true;
        }

        if ($exist) {
            $user->loadProductsWithTrash()->syncWithoutDetaching([$product->id => ['deleted_at' => Carbon::now()->toDateTimeString()]]);
            return response('Remove item from cart successfully! You can recover it', 200);
        } else {
            return response('Item does not exist!', 401);
        }
    }

    // Recover Soft Deleted Product in Cart
    public function recoverItemInCart(Request $request)
    {
        $fields = $request->validate([
            'id_product' => 'required|integer|min:1',
        ]);

        $user = User::findOrFail(Auth::id());
        $product = Product::findOrFail($fields['id_product']);

        $exist = false;
        foreach ($user->loadProductsWithTrash as $pro) {
            if ($pro->id == $fields['id_product'])
                $exist = true;
        }

        if ($exist) {
            $user->loadProductsWithTrash()->syncWithoutDetaching([$product->id => ['deleted_at' => null]]);
            return response('Recover Item Successfully', 200);
        } else {
            return response('Item does not exist!', 401);
        }
    }

    // Empty cart
    public function emptyCart()
    {
        $user = User::findOrFail(Auth::id());
        $user->loadProductsWithTrash()->sync([]);

        return response('Empty cart successfully!', 200);
    }
}
