<?php

namespace App\Http\Controllers;

use App\Http\Resources\MealResource;
use App\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MealController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($request->lang)) {
            return response()->json([
                'message' => 'Bad Request'], 400);
        };
        App::setLocale($request->lang);

        $meals = Meal::query();

        if (isset($request->category)) {
            $meals->whereIn('categoryId', $this->categoryFilter($request));
        }

        if (isset($request->tags)) {
            $tags = array_map('intval', explode(',', $request->tags));
            foreach ($tags as $tag) {
                $meals->whereHas('tags', function ($q) use ($tag) {
                    $q->where('id', $tag);
                });
            }
        }

        if (isset($request->with)) {
            $with = array_map('strval', explode(',', $request->with));
            if (in_array('tags', $with)) {
                $meals->with('tags');
            }
            if (in_array('ingredients', $with)) {
                $meals->with('ingredients');
            }
            if (in_array('category', $with)) {
                $meals->with('category');
            }
        }

        if (isset($request->diff_time) & $request->diff_time > 0) {
            $meals->withTrashed();
        }

        return MealResource::collection($meals->simplePaginate($request->perPage));
    }

    public function categoryFilter(Request $request)
    {
        if (strtolower($request->category) == 'null') {
            return null;
        } elseif (strtolower($request->category) == '!null') {
            return !null;
        } else {
            return array_map('intval', explode(',', $request->category));
        }
    }
}
