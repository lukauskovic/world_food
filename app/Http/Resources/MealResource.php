<?php

namespace App\Http\Resources;

use App\Category;
use App\Ingredient;
use App\Meal;
use Carbon\Carbon;
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
        $status = 'created';
        if ($request->filled('diff_time')) {
            $diffTime = Carbon::createFromTimestamp($request->query('diff_time'));
            if ($this->deleted_at && $this->deleted_at >= $diffTime) {
                $status = 'deleted';
            } else if ($this->created_at != $this->updated_at && $this->updated_at >= $diffTime) {
                $status = 'updated';
            }
        }

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
