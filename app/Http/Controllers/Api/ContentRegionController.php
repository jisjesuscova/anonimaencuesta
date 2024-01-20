<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\ContentRegion;

class ContentRegionController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $content_regions = CategoryRegion::where('content_id', $request->id)->get();

        return response()->json([
            'success' => true,
            'data' => $content_regions
        ], 200);
    }
}
