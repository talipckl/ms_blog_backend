<?php

namespace App\Http\Resources\Post;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'slug'=>$this->slug,
            'title'=>$this->title,
            'created_at'=>Carbon::parse( $this->created_at)->format('Y-m-d:H:i:s')
        ];
    }
}
