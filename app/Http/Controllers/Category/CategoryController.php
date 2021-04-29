<?php

namespace App\Http\Controllers\Category;

use App\Book;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Book\BookResource;
use App\Http\Resources\Category\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'message' => 'successfully get categories',
            'status' => true,
            'data' => CategoryResource::collection($categories)
        ]);
    }

    public function get($id)
    {
        $category = Category::where('id', $id)->first();   
        $books = Book::where('category_id', $category->id)->get();
        return response()->json([
            'message' => 'successfully get book by category',
            'status' => true, 
            'data' => BookResource::collection($books)
        ]);

    }
}
