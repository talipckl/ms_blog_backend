<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::all();

            return CategoryResource::collection($categories);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Internal Error!',
                'sign_in_error' => $e->getMessage()
            ], 500);
        }
    }
}
