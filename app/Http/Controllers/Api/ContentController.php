<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\ContentRegion;
use App\Models\ContentCommune;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contents = Content::select('id', 'section_id', 'category_id', 'status_id', 'title', 'google_tag', 'position', 'color', 'start_date', 'end_date', 'georeferencing_type_id', 'icon_status_id', 'icon_type_id', 'icon', 'content_type_id', 'video_description', 'video_type_id', 'video_id', 'src_description', 'audio_src', 'text_description', 'pdf_description', 'pdf', 'iframe_description', 'iframe_url', 'phone', 'url_external_page', 'app_type_id', 'url_app', 'uri_app', 'url_desktop_app', 'url_not_installed_app', 'whatsapp_type_id', 'whatsapp_url')
             ->orderBy('position')
             ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $contents
        ], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        $section_id = $request->segment(4);
        $category_id = $request->segment(5);
        
        $contents = Content::select('id', 'section_id', 'category_id', 'status_id', 'title', 'google_tag', 'position', 'color', 'start_date', 'end_date', 'georeferencing_type_id', 'icon_status_id', 'icon_type_id', 'icon', 'content_type_id', 'video_description', 'video_type_id', 'video_id', 'src_description', 'audio_src', 'text_description', 'pdf_description', 'pdf', 'iframe_description', 'iframe_url', 'phone', 'url_external_page', 'app_type_id', 'url_app', 'uri_app', 'url_desktop_app', 'url_not_installed_app', 'whatsapp_type_id', 'whatsapp_url')
             ->where('section_id', $section_id)
             ->where('category_id', $category_id)
             ->orderBy('position')
             ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $contents
        ], 200);
    }

     /**
     * Show the form for creating a new resource.
     */
    public function move_down(Request $request)
    {
        $section_id = $request->segment(4);
        $category_id = $request->segment(5);
        $id = $request->segment(6);

        $content = Content::where('section_id', $section_id)->where('category_id', $category_id)->where('id', $id)->first();
        $new_up_position = $content->position;
        $new_up_position = $new_up_position + 1;
        $content->position = $new_up_position;
        $content->save();

        $content = Content::where('position', $new_up_position)->where('section_id', $section_id)->where('category_id', $category_id)->where('id', '!=', $id)->first();
        $new_down_position = $content->position;
        $new_down_position = $new_down_position - 1;
        $content->position = $new_down_position;
        $content->save();

        return response()->json([
            'success' => true,
            'data' => $content
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function move_up(Request $request)
    {
        $section_id = $request->segment(4);
        $category_id = $request->segment(5);
        $id = $request->segment(6);

        $content = Content::where('section_id', $section_id)->where('category_id', $category_id)->where('id', $id)->first();
        $new_up_position = $content->position;
        $new_up_position = $new_up_position - 1;
        $content->position = $new_up_position;
        $content->save();

        $content = Content::where('position', $new_up_position)->where('section_id', $section_id)->where('category_id', $category_id)->where('id', '!=', $id)->first();
        $new_down_position = $content->position;
        $new_down_position = $new_down_position + 1;
        $content->position = $new_down_position;
        $content->save();

        return response()->json([
            'success' => true,
            'data' => $content
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
            $content_to_copy = Content::find($request->id);

            $content_qty = Content::where('section_id', $content_to_copy->section_id)->where('category_id', $content_to_copy->category_id)->count();
            $content_qty = $content_qty + 1;

            if($content_to_copy->icon_type_id == 2) { 
                $icon = time().'_'.$content_to_copy->icon;
            } else {
                $icon = $content_to_copy->icon;
            }

            if($content_to_copy->content_type_id == 4) { 
                $pdf = time().'_'.$content_to_copy->pdf;
            } else {
                $pdf = $content_to_copy->pdf;
            }

            $content = Content::create([
                'section_id' => $content_to_copy->section_id,
                'category_id' => $content_to_copy->category_id,
                'status_id' => $content_to_copy->status_id,
                'title' => $content_to_copy->title,
                'google_tag' => $content_to_copy->google_tag,
                'position' => $content_to_copy->position,
                'color' => $content_to_copy->color,
                'start_date' => $content_to_copy->start_date,
                'end_date' => $content_to_copy->end_date,
                'georeferencing_type_id' => $content_to_copy->georeferencing_type_id,
                'icon_status_id' => $content_to_copy->icon_status_id,
                'icon_type_id' => $request->icon_type_id,
                'icon' => $icon,
                'content_type_id' => $content_to_copy->content_type_id,
                'video_description' => $content_to_copy->video_description,
                'video_type_id' => $content_to_copy->video_type_id,
                'video_id' => $content_to_copy->video_id,
                'src_description' => $content_to_copy->src_description,
                'audio_src' => $content_to_copy->audio_src,
                'text_description' => $content_to_copy->text_description,
                'pdf_description' => $content_to_copy->pdf_description,
                'pdf' => $pdf,
                'iframe_description' => $content_to_copy->iframe_description,
                'iframe_url' => $content_to_copy->iframe_url,
                'phone' => $content_to_copy->phone,
                'url_external_page' => $content_to_copy->url_external_page,
                'app_type_id' => $content_to_copy->app_type_id,
                'url_app' => $content_to_copy->url_app,
                'uri_app' => $content_to_copy->uri_app,
                'url_desktop_app' => $content_to_copy->url_desktop_app,
                'url_not_installed_app' => $content_to_copy->url_not_installed_app,
                'whatsapp_type_id' => $content_to_copy->whatsapp_type_id,
                'whatsapp_url' => $content_to_copy->whatsapp_url,
            ]);

            if ($content) {
                if ($content_to_copy->georeferencing_type_id == 1) {
                    $content_regions_to_copy = ContentRegion::where('content_id', $content_to_copy->id)->get();
                    $content_regions_qty_to_copy = ContentRegion::where('content_id', $content_to_copy->id)->count();

                    if ($content_regions_qty_to_copy > 0) {
                        foreach ($content_regions_to_copy as $content_region_to_copy) {
                            $content_region = new ContentRegion();
                            $content_region->content_id = $content->id;
                            $content_region->region_id = $content_region_to_copy->region_id;
                            $content_region->save();
                        }
                    }

                    $content_communes_to_copy = ContentCommune::where('content_id', $content_to_copy->id)->get();
                    $content_communes_qty_to_copy = ContentCommune::where('content_id', $content_to_copy->id)->count();

                    if ($content_communes_qty_to_copy > 0) {
                        foreach ($content_communes_to_copy as $content_commune_to_copy) {
                            $content_commune = new ContentCommune();
                            $content_commune->content_id = $content->id;
                            $content_commune->commune_id = $category_commune_to_copy->commune_id;
                            $content_commune->save();
                        }
                    }
                }
                
                if($content_to_copy->icon_type_id == 2) { 
                    $original_image = 'public/' . $content_to_copy->icon;
                    $new_name_image = $icon;
                    $copy_path = 'public/' . $new_name_image;
                    File::copy(storage_path('app/' . $original_image), storage_path('app/' . $copy_path));
                }

                if($content_to_copy->content_type_id == 4) { 
                    $original_image = 'public/' . $content_to_copy->pdf;
                    $new_name_image = $pdf;
                    $copy_path = 'public/' . $new_name_image;
                    File::copy(storage_path('app/' . $original_image), storage_path('app/' . $copy_path));
                }

                return response()->json([
                    'success' => true,
                    'data' => $content
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            if($request->hasFile('icon_image')) { 
                $icon = time().'_'.'icon.'.$request->icon_image->getClientOriginalExtension();
            } else {
                if ($request->icon_status_input == 1) {
                    $html = $request->fa_icon;

                    $pattern = '/class="(.*?)"/';

                    preg_match($pattern, $html, $matches);

                    $icon = $matches[1];
                } else {
                    $icon = '';
                }
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
            
            $content = Content::create([
                'section_id' => $request->section_id,
                'category_id' => $request->category_id,
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

            if ($content) {
                if ($request->georeferencing_type_id == 1) {
                    $region_data = explode(',', $request->region_id);

                    if (count($region_data) > 0) {
                        for ($i=0; $i < count($region_data); $i++) { 
                            $content_region = new ContentRegion();
                            $content_region->content_id = $content->id;
                            $content_region->region_id = $region_data[$i];
                            $content_region->save();
                        }
                    } else {
                        $regions = Region::all();

                        foreach ($regions as $region) {
                            $content_region = new ContentRegion();
                            $content_region->content_id = $content->id;
                            $content_region->region_id = $region->id;
                            $content_region->save();
                        }
                    }
                    
                    $commune_data = explode(',', $request->commune_id);

                    if (count($commune_data)) {
                        for ($i=0; $i < count($commune_data); $i++) {
                            $content_commune = new ContentCommune();
                            $content_commune->content_id = $content->id;
                            $content_commune->commune_id = $commune_data[$i];
                            $content_commune->save();
                        }  
                    } else {
                        $communes = Commune::all();

                        foreach ($communes as $commune) {
                            $content_commune = new ContentCommune();
                            $content_commune->content_id = $content->id;
                            $content_commune->commune_id = $commune->id;
                            $content_commune->save();
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
                    'data' => $content
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
        $content = Content::find($request->id);

        return response()->json([
            'success' => true,
            'data' => $content
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

        $content = Content::find($id);

        if ($request->section_id != 'null' 
        && $request->section_id != null 
        && $request->section_id != '') {
            $content->section_id = $request->section_id;
        }

        if ($request->category_id != 'null' 
        && $request->category_id != null 
        && $request->category_id != '') {
            $content->category_id = $request->category_id;
        }

        if ($request->status_id != 'null' 
        && $request->status_id != null 
        && $request->status_id != '') {
            $content->status_id = $request->status_id;
        }

        if ($request->title != 'null' 
        && $request->title != null 
        && $request->title != '') {
            $content->title = $request->title;
        }

        if ($request->google_tag != 'null' 
        && $request->google_tag != null 
        && $request->google_tag != '') {
            $content->google_tag = $request->google_tag;
        }

        if ($request->position != 'null' 
        && $request->position != null 
        && $request->position != '') {
            $content->position = $request->position;
        }

        if ($request->color != 'null' 
        && $request->color != null 
        && $request->color != '') {
            $content->color = $request->color;
        }

        if ($request->start_date != 'null' 
        && $request->start_date != null 
        && $request->start_date != '') {
            $content->start_date = $request->start_date;
        }

        if ($request->end_date != 'null' 
        && $request->end_date != null 
        && $request->end_date != '') {
            $content->end_date = $request->end_date;
        }

        if ($request->georeferencing_type_id != 'null' 
        && $request->georeferencing_type_id != null 
        && $request->georeferencing_type_id != '') {
            $content->georeferencing_type_id = $request->georeferencing_type_id;
        }

        if ($request->icon_status_id != 'null' 
        && $request->icon_status_id != null 
        && $request->icon_status_id != '') {
            $content->icon_status_id = $request->icon_status_id;
        }

        if ($request->icon_type_id != 'null' 
        && $request->icon_type_id != null 
        && $request->icon_type_id != '') {
            $content->icon_type_id = $request->icon_type_id;
        }

        if ($icon != 'null' 
        && $icon != null 
        && $icon != '') {
            $content->icon = $icon;
        }

        if ($request->content_type_id != 'null' 
        && $request->content_type_id != null 
        && $request->content_type_id != '') {
            $content->content_type_id = $request->content_type_id;
        }

        if ($request->video_description != 'null' 
        && $request->video_description != null 
        && $request->video_description != '') {
            $content->video_description = $request->video_description;
        }

        if ($request->video_type_id != 'null' 
        && $request->video_type_id != null 
        && $request->video_type_id != '') {
            $content->video_type_id = $request->video_type_id;
        }

        if ($request->video_id != 'null' 
        && $request->video_id != null 
        && $request->video_id != '') {
            $content->video_id = $request->video_id;
        }

        if ($request->src_description != 'null' 
        && $request->src_description != null 
        && $request->src_description != '') {
            $content->src_description = $request->src_description;
        }

        if ($request->audio_src != 'null' 
        && $request->audio_src != null 
        && $request->audio_src != '') {
            $content->audio_src = $request->audio_src;
        }

        if ($request->text_description != 'null' 
        && $request->text_description != null 
        && $request->text_description != '') {
            $content->text_description = $request->text_description;
        }

        if ($request->pdf_description != 'null' 
        && $request->pdf_description != null 
        && $request->pdf_description != '') {
            $content->pdf_description = $request->pdf_description;
        }

        if ($pdf != 'null' 
        && $pdf != null 
        && $pdf != '') {
            $content->pdf = $pdf;
        }

        if ($request->iframe_description != 'null' 
        && $request->iframe_description != null 
        && $request->iframe_description != '') {
            $content->iframe_description = $request->iframe_description;
        }
 
        if ($request->iframe_url != 'null' 
        && $request->iframe_url != null 
        && $request->iframe_url != '') {
            $content->iframe_url = $request->iframe_url;
        }
  
        if ($request->phone != 'null' 
        && $request->phone != null 
        && $request->phone != '') {
            $content->phone = $request->phone;
        }
        
        if ($request->url_external_page != 'null' 
        && $request->url_external_page != null 
        && $request->url_external_page != '') {
            $content->url_external_page = $request->url_external_page;
        }

        if ($request->app_type_id != 'null' 
        && $request->app_type_id != null 
        && $request->app_type_id != '') {
            $content->app_type_id = $request->app_type_id;
        }
        
        if ($request->url_app != 'null' 
        && $request->url_app != null 
        && $request->url_app != '') {
            $content->url_app = $request->url_app;
        }

        if ($request->uri_app != 'null' 
        && $request->uri_app != null 
        && $request->uri_app != '') {
            $content->uri_app = $request->uri_app;
        }

        if ($request->url_desktop_app != 'null' 
        && $request->url_desktop_app != null 
        && $request->url_desktop_app != '') {
            $content->url_desktop_app = $request->url_desktop_app;
        }

        if ($request->url_not_installed_app != 'null' 
        && $request->url_not_installed_app != null 
        && $request->url_not_installed_app != '') {
            $content->url_not_installed_app = $request->url_not_installed_app;
        }

        if ($request->whatsapp_type_id != 'null' 
        && $request->whatsapp_type_id != null 
        && $request->whatsapp_type_id != '') {
            $content->whatsapp_type_id = $request->whatsapp_type_id;
        }

        if ($request->whatsapp_url != 'null' 
        && $request->whatsapp_url != null 
        && $request->whatsapp_url != '') {
            $content->whatsapp_url = $request->whatsapp_url;
        }

        $content->save();

        if ($content) {
            if ($request->georeferencing_type_id == 1) {
                $content_regions = ContentRegion::where('content_id', $content->id)->get();

                foreach ($content_regions as $content_region) {
                    $content_region_detail = ContentRegion::find($content_region->id);
                    $content_region_detail->delete();
                }

                $content_communes = ContentCommune::where('content_id', $content->id)->get();

                foreach ($content_communes as $content_commune) {
                    $content_commune_detail = ContentCommune::find($content_commune->id);
                    $content_commune_detail->delete();
                }

                $region_data = explode(',', $request->region_id);

                if (count($region_data) > 0) {
                    for ($i=0; $i < count($region_data); $i++) { 
                        $content_region = new ContentRegion();
                        $content_region->content_id = $content->id;
                        $content_region->region_id = $region_data[$i];
                        $content_region->save();
                    }
                } else {
                    $regions = Region::all();

                    foreach ($regions as $region) {
                        $content_region = new ContentRegion();
                        $content_region->content_id = $content->id;
                        $content_region->region_id = $region->id;
                        $content_region->save();
                    }
                }
                
                $commune_data = explode(',', $request->commune_id);

                if (count($commune_data)) {
                    for ($i=0; $i < count($commune_data); $i++) {
                        $content_commune = new ContentCommune();
                        $content_commune->content_id = $content->id;
                        $content_commune->commune_id = $commune_data[$i];
                        $content_commune->save();
                    }  
                } else {
                    $communes = Commune::all();

                    foreach ($communes as $commune) {
                        $content_commune = new ContentCommune();
                        $content_commune->content_id = $content->id;
                        $content_commune->commune_id = $commune->id;
                        $content_commune->save();
                    }
                }
            } else {
                $content_regions = ContentRegion::where('content_id', $content->id)->get();

                foreach ($content_regions as $content_region) {
                    $content_region_detail = ContentRegion::find($content_region->id);
                    $content_region_detail->delete();
                }

                $content_communes = ContentCommune::where('content_id', $content->id)->get();

                foreach ($content_communes as $content_commune) {
                    $content_commune_detail = ContentCommune::find($content_commune->id);
                    $content_commune_detail->delete();
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
                'data' => $content
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
        $content = Content::find($request->id);

        if ($content->icon_type_id == 2) {
            $icon = $content->icon;
        } else {
            $icon = '';
        }

        if ($content->content_type_id == 4) {
            $pdf = $content->pdf;
        } else {
            $pdf = '';
        }
        
        if($content->delete()) {
            if ($icon != '') {
                echo $icon;
                Storage::disk('local')->delete('public/'.$icon);
            }

            if ($pdf != '') {
                Storage::disk('local')->delete('public/'.$pdf);
            }
        }

        return response()->json([
            'success' => true,
            'data' => $content
        ], 200);
    }
}
