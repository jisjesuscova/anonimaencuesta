<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\ContentCommune;

class ContentCommuneController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $content_communes = ContentCommune::where('content_id', $request->id)->get();

        return response()->json([
            'success' => true,
            'data' => $content_communes
        ], 200);
    }
}
