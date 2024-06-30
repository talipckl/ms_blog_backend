<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'user'=>[
                'id'=>$this->user?->id,
                'name'=>$this->user?->name
            ],
            'category'=>[
                'id'=>$this->category?->id,
                'title'=>$this->category?->title,
            ],
            'slug'=>$this->slug,
            'title'=>$this->title,
            'content'=>$this->content,
        ];
    }
}
