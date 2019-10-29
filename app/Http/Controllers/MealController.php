<?php

namespace App\Http\Controllers;

use App\Http\Resources\MealResource;
use App\Meal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MealController extends Controller
{
    public function index(Request $request)
    {
        if ((!$request->filled('lang'))) {
            return response()->json([
                'message' => 'Bad Request'], 400);
        };
        App::setLocale($request->query('lang'));

        $meals = Meal::query();

        if ($request->filled('category')) {
            $meals->whereIn('categoryId', $this->categoryFilter($request));
        }

        if ($request->filled('tags')) {
            $tags = array_map('intval', explode(',', $request->query('tags')));
            foreach ($tags as $tag) {
                $meals->whereHas('tags', function ($q) use ($tag) {
                    $q->where('id', $tag);
                });
            }
        }

        if ($request->filled('with')) {
            $with = array_map('strval', explode(',', $request->query('with')));
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

        if ($request->filled('diff_time') & $request->query('diff_time') > 0) {
            $diff_time = Carbon::createFromTimestamp($request->query('diff_time'));
            $timeColumns = ['created_at', 'updated_at', 'deleted_at'];
            foreach ($timeColumns as $column) {
                $meals->orWhere($column, '>=', $diff_time);
            }
            $meals->withTrashed();
        }

        return MealResource::collection($meals->simplePaginate($request->query('perPage')));
    }

    public function categoryFilter(Request $request)
    {
        if (strtolower($request->query('category')) == 'null') {
            return null;
        } elseif (strtolower($request->query('category')) == '!null') {
            return !null;
        } else {
            return array_map('intval', explode(',', $request->query('category')));
        }
    }
}
