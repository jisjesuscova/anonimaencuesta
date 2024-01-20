<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\CategoryRegion;

class CategoryRegionController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $category_regions = CategoryRegion::where('category_id', $request->id)->get();

        return response()->json([
            'success' => true,
            'data' => $category_regions
        ], 200);
    }
}
