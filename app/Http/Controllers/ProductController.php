<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    // create product 

    public function store(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|integer',
                'sku' => 'required|string|max:200',
                'quantity' => 'required|integer',
                'availability' => 'required|string:max:255',
            ]);

            $product = Product::create($validatedData);

            return response()->json(['message' => 'Product created successfully', 'product' => $product]);
        }



    // get all product

    public function index()
        {
            $products = Product::all();

            $status = $products->isEmpty() ? 404 : 200;
            $message = $products->isEmpty() ? "No products found" : "Products get successfully";

            return response()->json([
                "status" => $status,
                "message" => $message,
                "data" => $products
            ], $status);
        }
  

    // Get a single product by ID

    public function singleProduct($id)
        {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }

            return response()->json($product);
        }


    //update product

    public function updateProduct($id, Request $request)
        {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }

            $validatedData = $request->validate([
                'name' => 'sometimes|string|max:255',
                'price' => 'sometimes|integer',
            ]);

            // Update the existing product instance
            $product->update($validatedData);

            return response()->json([
                'message' => 'Product updated successfully',
                'product' => $product
            ]);
        }




    // delete product 

    public function deleteProduct($id)
        {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }

            $product->delete();

            return response()->json(['message' => 'Product deleted successfully'], 200);
        }



}