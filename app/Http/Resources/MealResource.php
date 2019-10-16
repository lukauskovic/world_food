<?php

namespace App\Http\Resources;

use App\Category;
use App\Ingredient;
use App\Meal;
use Illuminate\Http\Resources\Json\Resource;

class MealResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->deleted_at == null){
            $status = 'created';
        }else $status = 'deleted';

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $status,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'ingredients' => IngredientResource::collection($this->whenLoaded('ingredients'))
        ];
    }
}
