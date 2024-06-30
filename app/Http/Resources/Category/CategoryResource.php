<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category' => $this->category,
            'title' => $this->title,
            'cover' => $this->cover
            //"http://localhost/MS_PROJE/blog-app-api/storage/app/public/category/ca1.png"
        ];
    }
}
