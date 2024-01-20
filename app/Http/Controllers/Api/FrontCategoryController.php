<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::select('categories.*')
        ->where(function ($query) use ($request) {
            $query->where('georeferencing_type_id', 2)
                ->orWhere(function ($query) use ($request) {
                    $query->where('georeferencing_type_id', 1)
                            ->whereExists(function ($subquery) use ($request) {
                                $subquery->select(DB::raw(1))
                                        ->from('category_regions')
                                        ->whereColumn('category_regions.category_id', 'categories.id')
                                        ->where('category_regions.region_id', $request->region_id)
                                        ->whereExists(function ($subsubquery) use ($request) {
                                            $subsubquery->select(DB::raw(1))
                                                        ->from('category_communes')
                                                        ->whereColumn('category_communes.category_id', 'categories.id')
                                                        ->where('category_communes.commune_id', $request->commune_id);
                                        });
                            });
                });
        })
        ->where('categories.section_id', $request->id)
        ->where('categories.status_id', 1)
        ->orderBy('categories.position', 'ASC')
        ->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;

        $category = Category::find($id);

        return response()->json([
            'success' => true,
            'data' => $category
        ], 200);
    }
}
