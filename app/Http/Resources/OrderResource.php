<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "user_id"=> $this->user_id,
            "payment_id"=> $this->payment_id,
            "order_date"=> $this->order_date,
            "state"=> $this->state,
            "city"=> $this->city,
            "street"=> $this->street,
            "building_number"=> $this->building_number,
            "apartment_number"=> $this->apartment_number,
            "zip_code"=> $this->zip_code,
            "total_price"=> $this->total_price,
            "payment"=> $this->payments,
            "user"=> $this->users,
            "books"=> BookResource::collection($this->whenLoaded('books')),
        ];
    }
}
