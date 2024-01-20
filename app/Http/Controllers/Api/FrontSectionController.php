<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sections = Section::select('sections.*')
                ->where(function ($query) use ($request) {
                    $query->where('georeferencing_type_id', 2)
                        ->orWhere(function ($query) use ($request) {
                            $query->where('georeferencing_type_id', 1)
                                    ->whereExists(function ($subquery) use ($request) {
                                        $subquery->select(DB::raw(1))
                                                ->from('section_regions')
                                                ->whereColumn('section_regions.section_id', 'sections.id')
                                                ->where('section_regions.region_id', $request->region_id)
                                                ->whereExists(function ($subsubquery) use ($request) {
                                                    $subsubquery->select(DB::raw(1))
                                                                ->from('section_communes')
                                                                ->whereColumn('section_communes.section_id', 'sections.id')
                                                                ->where('section_communes.commune_id', $request->commune_id);
                                                });
                                    });
                        });
                })
                ->where('sections.status_id', 1)
                ->orderBy('sections.position', 'ASC')
                ->get();

        return response()->json([
            'success' => true,
            'data' => $sections
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;

        $section = Section::find($id);

        return response()->json([
            'success' => true,
            'data' => $section
        ], 200);
    }
}
