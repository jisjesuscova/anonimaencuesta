<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contents = Content::select('contents.*')
        ->where(function ($query) use ($request) {
            $query->where('georeferencing_type_id', 2)
                ->orWhere(function ($query) use ($request) {
                    $query->where('georeferencing_type_id', 1)
                            ->whereExists(function ($subquery) use ($request) {
                                $subquery->select(DB::raw(1))
                                        ->from('content_regions')
                                        ->whereColumn('content_regions.content_id', 'contents.id')
                                        ->where('content_regions.region_id', $request->region_id)
                                        ->whereExists(function ($subsubquery) use ($request) {
                                            $subsubquery->select(DB::raw(1))
                                                        ->from('content_communes')
                                                        ->whereColumn('content_communes.content_id', 'contents.id')
                                                        ->where('content_communes.commune_id', $request->commune_id);
                                        });
                            });
                });
        })
        ->where('contents.section_id', $request->section_id)
        ->where('contents.category_id', $request->category_id)
        ->where('contents.status_id', 1)
        ->orderBy('contents.position', 'ASC')
        ->get();

        return response()->json([
            'success' => true,
            'data' => $contents
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;
        
        $content = Content::find($id);

        return response()->json([
            'success' => true,
            'data' => $content
        ], 200);
    }
}
