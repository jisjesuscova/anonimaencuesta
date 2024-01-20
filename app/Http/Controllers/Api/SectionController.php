<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\SectionRegion;
use App\Models\SectionCommune;
use App\Models\Region;
use App\Models\Commune;
use Illuminate\Support\Facades\File;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = $request->segment(3);

        if ($id == 'all') {
            $sections = Section::select('id', 'status_id', 'title', 'google_tag', 'position', 'color', 'start_date', 'end_date', 'georeferencing_type_id', 'icon_status_id', 'icon_type_id', 'icon', 'content_type_id', 'video_description', 'video_type_id', 'video_id', 'src_description', 'audio_src', 'text_description', 'pdf_description', 'pdf', 'iframe_description', 'iframe_url', 'phone', 'url_external_page', 'app_type_id', 'url_app', 'uri_app', 'url_desktop_app', 'url_not_installed_app', 'whatsapp_type_id', 'whatsapp_url')
             ->orderBy('position')
             ->get();
        } else {
            $sections = Section::select('id', 'status_id', 'title', 'google_tag', 'position', 'color', 'start_date', 'end_date', 'georeferencing_type_id', 'icon_status_id', 'icon_type_id', 'icon', 'content_type_id', 'video_description', 'video_type_id', 'video_id', 'src_description', 'audio_src', 'text_description', 'pdf_description', 'pdf', 'iframe_description', 'iframe_url', 'phone', 'url_external_page', 'app_type_id', 'url_app', 'uri_app', 'url_desktop_app', 'url_not_installed_app', 'whatsapp_type_id', 'whatsapp_url')
             ->orderBy('position')
             ->paginate(10);
        }

        return response()->json([
            'success' => true,
            'data' => $sections
        ], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function data()
    {
        $sections = Section::select('id', 'status_id', 'title', 'google_tag', 'position', 'color', 'start_date', 'end_date', 'georeferencing_type_id', 'icon_status_id', 'icon_type_id', 'icon', 'content_type_id', 'video_description', 'video_type_id', 'video_id', 'src_description', 'audio_src', 'text_description', 'pdf_description', 'pdf', 'iframe_description', 'iframe_url', 'phone', 'url_external_page', 'app_type_id', 'url_app', 'uri_app', 'url_desktop_app', 'url_not_installed_app', 'whatsapp_type_id', 'whatsapp_url')
             ->orderBy('position')
             ->get();

        return response()->json([
            'success' => true,
            'data' => $sections
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function move_down(Request $request)
    {
        $id = $request->segment(4);

        $section = Section::find($id);
        $new_up_position = $section->position;
        $new_up_position = $new_up_position + 1;
        $section->position = $new_up_position;
        $section->save();

        $section = Section::where('position', $new_up_position)->where('id', '!=', $id)->first();
        $new_down_position = $section->position;
        $new_down_position = $new_down_position - 1;
        $section->position = $new_down_position;
        $section->save();

        return response()->json([
            'success' => true,
            'data' => $section
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function move_up(Request $request)
    {
        $id = $request->segment(4);

        $section = Section::find($id);
        $new_up_position = $section->position;
        $new_up_position = $new_up_position - 1;
        $section->position = $new_up_position;
        $section->save();

        $section = Section::where('position', $new_up_position)->where('id', '!=', $id)->first();
        $new_down_position = $section->position;
        $new_down_position = $new_down_position + 1;
        $section->position = $new_down_position;
        $section->save();

        return response()->json([
            'success' => true,
            'data' => $section
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function copy(Request $request)
    {
        try {
            $section_to_copy = Section::find($request->id);

            $section_qty = Section::count();
            $section_qty = $section_qty + 1;

            if($section_to_copy->icon_type_id == 2) { 
                $icon = time().'_'.$section_to_copy->icon;
            } else {
                $icon = $section_to_copy->icon;
            }

            if($section_to_copy->content_type_id == 4) { 
                $pdf = time().'_'.$section_to_copy->pdf;
            } else {
                $pdf = $section_to_copy->pdf;
            }

            $section = Section::create([
                'status_id' => $section_to_copy->status_id,
                'title' => $section_to_copy->title,
                'google_tag' => $section_to_copy->google_tag,
                'position' => $section_qty,
                'color' => $section_to_copy->color,
                'start_date' => $section_to_copy->start_date,
                'end_date' => $section_to_copy->end_date,
                'georeferencing_type_id' => $section_to_copy->georeferencing_type_id,
                'icon_status_id' => $section_to_copy->icon_status_id,
                'icon_type_id' => $section_to_copy->icon_type_id,
                'icon' => $icon,
                'content_type_id' => $section_to_copy->content_type_id,
                'video_description' => $section_to_copy->video_description,
                'video_type_id' => $section_to_copy->video_type_id,
                'video_id' => $section_to_copy->video_id,
                'src_description' => $section_to_copy->src_description,
                'audio_src' => $section_to_copy->audio_src,
                'text_description' => $section_to_copy->text_description,
                'pdf_description' => $section_to_copy->pdf_description,
                'pdf' => $pdf,
                'iframe_description' => $section_to_copy->iframe_description,
                'iframe_url' => $section_to_copy->iframe_url,
                'phone' => $section_to_copy->phone,
                'url_external_page' => $section_to_copy->url_external_page,
                'app_type_id' => $section_to_copy->app_type_id,
                'url_app' => $section_to_copy->url_app,
                'uri_app' => $section_to_copy->uri_app,
                'url_desktop_app' => $section_to_copy->url_desktop_app,
                'url_not_installed_app' => $section_to_copy->url_not_installed_app,
                'whatsapp_type_id' => $section_to_copy->whatsapp_type_id,
                'whatsapp_url' => $section_to_copy->whatsapp_url,
            ]);

            if ($section) {
                if ($section_to_copy->georeferencing_type_id == 1) {
                    $section_regions_to_copy = SectionRegion::where('section_id', $section_to_copy->id)->get();
                    $section_regions_qty_to_copy = SectionRegion::where('section_id', $section_to_copy->id)->count();

                    if ($section_regions_qty_to_copy > 0) {
                        foreach ($section_regions_to_copy as $section_region_to_copy) {
                            $section_region = new SectionRegion();
                            $section_region->section_id = $section->id;
                            $section_region->region_id = $section_region_to_copy->region_id;
                            $section_region->save();

                        }
                    }

                    $section_communes_to_copy = SectionCommune::where('section_id', $section_to_copy->id)->get();
                    $section_communes_qty_to_copy = SectionCommune::where('section_id', $section_to_copy->id)->count();

                    if ($section_communes_qty_to_copy > 0) {
                        foreach ($section_communes_to_copy as $section_commune_to_copy) {
                            $section_commune = new SectionCommune();
                            $section_commune->section_id = $section->id;
                            $section_commune->commune_id = $section_commune_to_copy->commune_id;
                            $section_commune->save();
                        }
                    }
                }
                
                if($section_to_copy->icon_type_id == 2) { 
                    $original_image = 'public/' . $section_to_copy->icon;
                    $new_name_image = $icon;
                    $copy_path = 'public/' . $new_name_image;
                    File::copy(storage_path('app/' . $original_image), storage_path('app/' . $copy_path));
                }

                if($section_to_copy->content_type_id == 4) { 
                    $original_image = 'public/' . $section_to_copy->pdf;
                    $new_name_image = $pdf;
                    $copy_path = 'public/' . $new_name_image;
                    File::copy(storage_path('app/' . $original_image), storage_path('app/' . $copy_path));
                }

                return response()->json([
                    'success' => true,
                    'data' => $section
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'data' => 'No se pudo copiar la sección'
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if($request->hasFile('icon_image')) { 
                $icon = time().'_'.'icon.'.$request->icon_image->getClientOriginalExtension();
            } else {
                $html = $request->fa_icon;
                
                // Definir la expresión regular
                $pattern = '/class="(.*?)"/';

                // Realizar la búsqueda mediante la expresión regular
                preg_match($pattern, $html, $matches);

                $icon = $matches[1];
            }

            if($request->hasFile('pdf')) { 
                $pdf = time().'_'.'pdf.'.$request->pdf->getClientOriginalExtension();

                $pdf_description = $request->pdf_description;
            } else {
                $pdf = '';

                $pdf_description = '';
            }

            if ($request->content_type_id == '') {
                $content_type_id = 0;
            } else {
                $content_type_id = $request->content_type_id;
            }

            $section = Section::create([
                'status_id' => $request->status_id,
                'title' => $request->title,
                'google_tag' => $request->google_tag,
                'position' => $request->position,
                'color' => $request->color,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'georeferencing_type_id' => $request->georeferencing_type_id,
                'icon_status_id' => $request->icon_status_id,
                'icon_type_id' => $request->icon_type_id,
                'icon' => $icon,
                'content_type_id' => $content_type_id,
                'video_description' => $request->video_description,
                'video_type_id' => $request->video_type_id,
                'video_id' => $request->video_id,
                'src_description' => $request->src_description,
                'audio_src' => $request->audio_src,
                'text_description' => $request->text_description,
                'pdf_description' => $pdf_description,
                'pdf' => $pdf,
                'iframe_description' => $request->iframe_description,
                'iframe_url' => $request->iframe_url,
                'phone' => $request->phone,
                'url_external_page' => $request->url_external_page,
                'app_type_id' => $request->app_type_id,
                'url_app' => $request->url_app,
                'uri_app' => $request->uri_app,
                'url_desktop_app' => $request->url_desktop_app,
                'url_not_installed_app' => $request->url_not_installed_app,
                'whatsapp_type_id' => $request->whatsapp_type_id,
                'whatsapp_url' => $request->whatsapp_url,
            ]);

            if ($section) {
                if ($request->georeferencing_type_id == 1) {
                    $region_data = explode(',', $request->region_id);

                    if (count($region_data) > 0) {
                        for ($i=0; $i < count($region_data); $i++) { 
                            $section_region = new SectionRegion();
                            $section_region->section_id = $section->id;
                            $section_region->region_id = $region_data[$i];
                            $section_region->save();
                        }
                    } else {
                        $regions = Region::all();

                        foreach ($regions as $region) {
                            $section_region = new SectionRegion();
                            $section_region->section_id = $section->id;
                            $section_region->region_id = $region->id;
                            $section_region->save();
                        }
                    }
                    
                    $commune_data = explode(',', $request->commune_id);

                    if (count($commune_data)) {
                        for ($i=0; $i < count($commune_data); $i++) {
                            $section_commune = new SectionCommune();
                            $section_commune->section_id = $section->id;
                            $section_commune->commune_id = $commune_data[$i];
                            $section_commune->save();
                        }  
                    } else {
                        $communes = Commune::all();

                        foreach ($communes as $commune) {
                            $section_commune = new SectionCommune();
                            $section_commune->section_id = $section->id;
                            $section_commune->commune_id = $commune->id;
                            $section_commune->save();
                        }
                    }
                }
                
                if($request->hasFile('icon_image')) { 
                    Storage::disk('local')->putFileAs(
                        'public',
                        $request->icon_image,
                        $icon
                    );
                }

                if($request->hasFile('pdf')) { 
                    Storage::disk('local')->putFileAs(
                        'public',
                        $request->pdf,
                        $pdf
                    );
                }

                return response()->json([
                    'success' => true,
                    'data' => $section
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'data' => 'No se pudo crear la sección'
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $section = Section::find($request->id);

        return response()->json([
            'success' => true,
            'data' => $section
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if($request->hasFile('icon_image')) { 
            $icon = time().'_'.'icon.'.$request->icon_image->getClientOriginalExtension();
        } else {
            $icon = $request->fa_icon;
        }

        if($request->hasFile('pdf')) { 
            $pdf = time().'_'.'pdf.'.$request->pdf->getClientOriginalExtension();

            $pdf_description = $request->pdf_description;
        } else {
            $pdf = '';

            $pdf_description = '';
        }

        if ($request->content_type_id == '') {
            $content_type_id = 0;
        } else {
            $content_type_id = $request->content_type_id;
        }

        $section = Section::find($id);

        if ($request->status_id != 'null' 
        && $request->status_id != null 
        && $request->status_id != '') {
            $section->status_id = $request->status_id;
        }

        if ($request->title != 'null' 
        && $request->title != null 
        && $request->title != '') {
            $section->title = $request->title;
        }

        if ($request->google_tag != 'null' 
        && $request->google_tag != null 
        && $request->google_tag != '') {
            $section->google_tag = $request->google_tag;
        }

        if ($request->position != 'null' 
        && $request->position != null 
        && $request->position != '') {
            $section->position = $request->position;
        }

        if ($request->color != 'null' 
        && $request->color != null 
        && $request->color != '') {
            $section->color = $request->color;
        }

        if ($request->start_date != 'null' 
        && $request->start_date != null 
        && $request->start_date != '') {
            $section->start_date = $request->start_date;
        }

        if ($request->end_date != 'null' 
        && $request->end_date != null 
        && $request->end_date != '') {
            $section->end_date = $request->end_date;
        }

        if ($request->georeferencing_type_id != 'null' 
        && $request->georeferencing_type_id != null 
        && $request->georeferencing_type_id != '') {
            $section->georeferencing_type_id = $request->georeferencing_type_id;
        }

        if ($request->icon_status_id != 'null' 
        && $request->icon_status_id != null 
        && $request->icon_status_id != '') {
            $section->icon_status_id = $request->icon_status_id;
        }

        if ($request->icon_type_id != 'null' 
        && $request->icon_type_id != null 
        && $request->icon_type_id != '') {
            $section->icon_type_id = $request->icon_type_id;
        }

        if ($icon != 'null' 
        && $icon != null 
        && $icon != '') {
            $old_icon = $section->icon;
            $section->icon = $icon;
        }

        if ($request->content_type_id != 'null' 
        && $request->content_type_id != null 
        && $request->content_type_id != '') {
            $section->content_type_id = $request->content_type_id;
        }

        if ($request->video_description != 'null' 
        && $request->video_description != null 
        && $request->video_description != '') {
            $section->video_description = $request->video_description;
        }

        if ($request->video_type_id != 'null' 
        && $request->video_type_id != null 
        && $request->video_type_id != '') {
            $section->video_type_id = $request->video_type_id;
        }

        if ($request->video_id != 'null' 
        && $request->video_id != null 
        && $request->video_id != '') {
            $section->video_id = $request->video_id;
        }

        if ($request->src_description != 'null' 
        && $request->src_description != null 
        && $request->src_description != '') {
            $section->src_description = $request->src_description;
        }

        if ($request->audio_src != 'null' 
        && $request->audio_src != null 
        && $request->audio_src != '') {
            $section->audio_src = $request->audio_src;
        }

        if ($request->text_description != 'null' 
        && $request->text_description != null 
        && $request->text_description != '') {
            $section->text_description = $request->text_description;
        }

        if ($request->pdf_description != 'null' 
        && $request->pdf_description != null 
        && $request->pdf_description != '') {
            $section->pdf_description = $request->pdf_description;
        }

        if ($pdf != 'null' 
        && $pdf != null 
        && $pdf != '') {
            $old_pdf = $section->pdf;
            $section->pdf = $pdf;
        }

        if ($request->iframe_description != 'null' 
        && $request->iframe_description != null 
        && $request->iframe_description != '') {
            $section->iframe_description = $request->iframe_description;
        }
 
        if ($request->iframe_url != 'null' 
        && $request->iframe_url != null 
        && $request->iframe_url != '') {
            $section->iframe_url = $request->iframe_url;
        }
  
        if ($request->phone != 'null' 
        && $request->phone != null 
        && $request->phone != '') {
            $section->phone = $request->phone;
        }
        
        if ($request->url_external_page != 'null' 
        && $request->url_external_page != null 
        && $request->url_external_page != '') {
            $section->url_external_page = $request->url_external_page;
        }

        if ($request->app_type_id != 'null' 
        && $request->app_type_id != null 
        && $request->app_type_id != '') {
            $section->app_type_id = $request->app_type_id;
        }
        
        if ($request->url_app != 'null' 
        && $request->url_app != null 
        && $request->url_app != '') {
            $section->url_app = $request->url_app;
        }

        if ($request->uri_app != 'null' 
        && $request->uri_app != null 
        && $request->uri_app != '') {
            $section->uri_app = $request->uri_app;
        }

        if ($request->url_desktop_app != 'null' 
        && $request->url_desktop_app != null 
        && $request->url_desktop_app != '') {
            $section->url_desktop_app = $request->url_desktop_app;
        }

        if ($request->url_not_installed_app != 'null' 
        && $request->url_not_installed_app != null 
        && $request->url_not_installed_app != '') {
            $section->url_not_installed_app = $request->url_not_installed_app;
        }

        if ($request->whatsapp_type_id != 'null' 
        && $request->whatsapp_type_id != null 
        && $request->whatsapp_type_id != '') {
            $section->whatsapp_type_id = $request->whatsapp_type_id;
        }

        if ($request->whatsapp_url != 'null' 
        && $request->whatsapp_url != null 
        && $request->whatsapp_url != '') {
            $section->whatsapp_url = $request->whatsapp_url;
        }

        $section->save();

        if ($section) {
            if ($request->georeferencing_type_id == 1) {
                $section_regions = SectionRegion::where('section_id', $section->id)->get();

                foreach ($section_regions as $section_region) {
                    $section_region_detail = SectionRegion::find($section_region->id);
                    $section_region_detail->delete();
                }

                $section_communes = SectionCommune::where('section_id', $section->id)->get();

                foreach ($section_communes as $section_commune) {
                    $section_commune_detail = SectionCommune::find($section_commune->id);
                    $section_commune_detail->delete();
                }

                $region_data = explode(',', $request->region_id);

                if (count($region_data) > 0) {
                    for ($i=0; $i < count($region_data); $i++) { 
                        $section_region = new SectionRegion();
                        $section_region->section_id = $section->id;
                        $section_region->region_id = $region_data[$i];
                        $section_region->save();
                    }
                } else {
                    $regions = Region::all();

                    foreach ($regions as $region) {
                        $section_region = new SectionRegion();
                        $section_region->section_id = $section->id;
                        $section_region->region_id = $region->id;
                        $section_region->save();
                    }
                }
                
                $commune_data = explode(',', $request->commune_id);

                if (count($commune_data)) {
                    for ($i=0; $i < count($commune_data); $i++) {
                        $section_commune = new SectionCommune();
                        $section_commune->section_id = $section->id;
                        $section_commune->commune_id = $commune_data[$i];
                        $section_commune->save();
                    }  
                } else {
                    $communes = Commune::all();

                    foreach ($communes as $commune) {
                        $section_commune = new SectionCommune();
                        $section_commune->section_id = $section->id;
                        $section_commune->commune_id = $commune->id;
                        $section_commune->save();
                    }
                }
            } else {
                $section_regions = SectionRegion::where('section_id', $section->id)->get();

                foreach ($section_regions as $section_region) {
                    $section_region_detail = SectionRegion::find($section_region->id);
                    $section_region_detail->delete();
                }

                $section_communes = SectionCommune::where('section_id', $section->id)->get();

                foreach ($section_communes as $section_commune) {
                    $section_commune_detail = SectionCommune::find($section_commune->id);
                    $section_commune_detail->delete();
                }
            }

            if($request->hasFile('icon_image')) { 
                if ($icon != '') {
                    Storage::disk('local')->delete('public/'.$old_icon);
                }

                Storage::disk('local')->putFileAs(
                    'public',
                    $request->icon_image,
                    $icon
                );
            }

            if($request->hasFile('pdf')) { 
                if ($pdf != '') {
                    Storage::disk('local')->delete('public/'.$old_pdf);
                }

                Storage::disk('local')->putFileAs(
                    'public',
                    $request->pdf,
                    $pdf
                );
            }

            return response()->json([
                'success' => true,
                'data' => $section
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => 'No se pudo actualizar la sección'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $section = Section::find($request->id);

        if ($section->icon_type_id == 2) {
            $icon = $section->icon;
        } else {
            $icon = '';
        }

        if ($section->content_type_id == 4) {
            $pdf = $section->pdf;
        } else {
            $pdf = '';
        }
        
        if($section->delete()) {
            if ($icon != '') {
                Storage::disk('local')->delete('public/'.$icon);
            }

            if ($pdf != '') {
                Storage::disk('local')->delete('public/'.$pdf);
            }
        }

        return response()->json([
            'success' => true,
            'data' => $section
        ], 200);
    }
}