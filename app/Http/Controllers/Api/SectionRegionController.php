<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\SectionRegion;

class SectionRegionController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $section_regions = SectionRegion::where('section_id', $request->id)->get();

        return response()->json([
            'success' => true,
            'data' => $section_regions
        ], 200);
    }
}
