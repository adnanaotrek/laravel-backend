<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    // create category 

    public function store(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $category = Category::create($validatedData);

            return response()->json(['message' => 'Category created successfully', 'category' => $category]);
        }

    


    // get all category 

    public function getAllCategory(Request $request)
        {

            $category = Category::all();

            $status = $category->isEmpty() ? 404 : 200;
            $message = $category->isEmpty() ? "No category found" : "Category get successfully";

            return response()->json([
                "status" => $status,
                "message" => $message,
                "data" => $category
            ], $status);
        }


    

    // Get a single category by ID

    public function getSingelCategory($id)
        {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'Category not found'], 404);
            }

            return response()->json($category);
        }


    //update product

    public function updateCategory($id, Request $request)
        {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'category not found'], 404);
            }

            $validatedData = $request->validate([
                'name' => 'sometimes|string|max:255',
                'price' => 'sometimes|integer',
            ]);

            // Update the existing cate$category instance
            $category->update($validatedData);

            return response()->json([
                'message' => 'Category updated successfully',
                'category' => $category
            ]);
        }




    // delete product 

    public function deleteCategory($id)
        {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'Category not found'], 404);
            }

            $category->delete();

            return response()->json(['message' => 'Category deleted successfully'], 200);
        }

}