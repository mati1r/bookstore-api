<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "publisher"=> $this->publisher,
            "title"=> $this->title,
            "price"=> $this->price,
            "publish_year"=> $this->publish_year,
            "picture"=> $this->picture,
            "authors"=> AuthorResource::collection($this->whenLoaded('authors')),
            "genres"=> GenreResource::collection($this->whenLoaded('genres')),
        ];
    }
}
