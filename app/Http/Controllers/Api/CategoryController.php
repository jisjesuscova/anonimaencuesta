<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\CategoryRegion;
use App\Models\CategoryCommune;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $path = $request->segment(3);
        $id = $request->segment(4);

        if ($path == 'all') {
            $categories = Category::select('id', 'section_id', 'status_id', 'title', 'google_tag', 'position', 'color', 'start_date', 'end_date', 'georeferencing_type_id', 'icon_status_id', 'icon_type_id', 'icon', 'content_type_id', 'video_description', 'video_type_id', 'video_id', 'src_description', 'audio_src', 'text_description', 'pdf_description', 'pdf', 'iframe_description', 'iframe_url', 'phone', 'url_external_page', 'app_type_id', 'url_app', 'uri_app', 'url_desktop_app', 'url_not_installed_app', 'whatsapp_type_id', 'whatsapp_url')
            ->where('section_id', $id)
            ->orderBy('position')
            ->get();
        } else {
            $categories = Category::select('id', 'section_id', 'status_id', 'title', 'google_tag', 'position', 'color', 'start_date', 'end_date', 'georeferencing_type_id', 'icon_status_id', 'icon_type_id', 'icon', 'content_type_id', 'video_description', 'video_type_id', 'video_id', 'src_description', 'audio_src', 'text_description', 'pdf_description', 'pdf', 'iframe_description', 'iframe_url', 'phone', 'url_external_page', 'app_type_id', 'url_app', 'uri_app', 'url_desktop_app', 'url_not_installed_app', 'whatsapp_type_id', 'whatsapp_url')
            ->orderBy('position')
             ->paginate(10);
        }

        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }

    /**
     * Search a listing of the resource.
     */
    public function search(Request $request)
    {
        $id = $request->segment(4);
        
        $categories = Category::select('id', 'section_id', 'status_id', 'title', 'google_tag', 'position', 'color', 'start_date', 'end_date', 'georeferencing_type_id', 'icon_status_id', 'icon_type_id', 'icon', 'content_type_id', 'video_description', 'video_type_id', 'video_id', 'src_description', 'audio_src', 'text_description', 'pdf_description', 'pdf', 'iframe_description', 'iframe_url', 'phone', 'url_external_page', 'app_type_id', 'url_app', 'uri_app', 'url_desktop_app', 'url_not_installed_app', 'whatsapp_type_id', 'whatsapp_url')
             ->where('section_id', $id)
             ->orderBy('position')
             ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }

     /**
     * Move down a resource.
     */
    public function move_down(Request $request)
    {
        $section_id = $request->segment(4);
        $id = $request->segment(5);

        $category = Category::where('section_id', $section_id)->where('id', $id)->first();
        $new__position = $category->position;
        $new_up_position = $new_up_position + 1;
        $category->position = $new_up_position;
        $category->save();

        $category = Category::where('position', $new_up_position)->where('section_id', $section_id)->where('id', '!=', $id)->first();
        $new_down_position = $category->position;
        $new_down_position = $new_down_position - 1;
        $category->position = $new_down_position;
        $category->save();

        return response()->json([
            'success' => true,
            'data' => $category
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function move_up(Request $request)
    {
        $section_id = $request->segment(4);
        $id = $request->segment(5);

        $category = Category::where('section_id', $section_id)->where('id', $id)->first();
        $new_up_position = $category->position;
        $new_up_position = $new_up_position - 1;
        $category->position = $new_up_position;
        $category->save();

        $category = Category::where('position', $new_up_position)->where('section_id', $section_id)->where('id', '!=', $id)->first();
        $new_down_position = $category->position;
        $new_down_position = $new_down_position + 1;
        $category->position = $new_down_position;
        $category->save();

        return response()->json([
            'success' => true,
            'data' => $category
        ], 200);
    }

    /**
     * Copy a resource to create a new one.
     */
    public function copy(Request $request)
    {
        try {
            $category_to_copy = Category::find($request->id);

            $category_qty = Category::where('section_id', $category_to_copy->section_id)->count();
            $category_qty = $category_qty + 1;

            if($category_to_copy->icon_type_id == 2) { 
                $icon = time().'_'.$category_to_copy->icon;
            } else {
                $icon = $category_to_copy->icon;
            }

            if($category_to_copy->content_type_id == 4) { 
                $pdf = time().'_'.$category_to_copy->pdf;
            } else {
                $pdf = $category_to_copy->pdf;
            }

            $category = Category::create([
                'section_id' => $category_to_copy->section_id,
                'status_id' => $category_to_copy->status_id,
                'title' => $category_to_copy->title,
                'google_tag' => $category_to_copy->google_tag,
                'position' => $category_qty,
                'color' => $category_to_copy->color,
                'start_date' => $category_to_copy->start_date,
                'end_date' => $category_to_copy->end_date,
                'georeferencing_type_id' => $category_to_copy->georeferencing_type_id,
                'icon_status_id' => $category_to_copy->icon_status_id,
                'icon_type_id' => $category_to_copy->icon_type_id,
                'icon' => $icon,
                'content_type_id' => $category_to_copy->content_type_id,
                'video_description' => $category_to_copy->video_description,
                'video_type_id' => $category_to_copy->video_type_id,
                'video_id' => $category_to_copy->video_id,
                'src_description' => $category_to_copy->src_description,
                'audio_src' => $category_to_copy->audio_src,
                'text_description' => $category_to_copy->text_description,
                'pdf_description' => $category_to_copy->pdf_description,
                'pdf' => $pdf,
                'iframe_description' => $category_to_copy->iframe_description,
                'iframe_url' => $category_to_copy->iframe_url,
                'phone' => $category_to_copy->phone,
                'url_external_page' => $category_to_copy->url_external_page,
                'app_type_id' => $category_to_copy->app_type_id,
                'url_app' => $category_to_copy->url_app,
                'uri_app' => $category_to_copy->uri_app,
                'url_desktop_app' => $category_to_copy->url_desktop_app,
                'url_not_installed_app' => $category_to_copy->url_not_installed_app,
                'whatsapp_type_id' => $category_to_copy->whatsapp_type_id,
                'whatsapp_url' => $category_to_copy->whatsapp_url,
            ]);

            if ($category) {
                if ($category_to_copy->georeferencing_type_id == 1) {
                    $category_regions_to_copy = CategoryRegion::where('category_id', $category_to_copy->id)->get();
                    $category_regions_qty_to_copy = CategoryRegion::where('category_id', $category_to_copy->id)->count();

                    if ($category_regions_qty_to_copy > 0) {
                        foreach ($category_regions_to_copy as $category_region_to_copy) {
                            $category_region = new CategoryRegion();
                            $category_region->category_id = $category->id;
                            $category_region->region_id = $category_region_to_copy->region_id;
                            $category_region->save();
                        }
                    }

                    $category_communes_to_copy = CategoryCommune::where('category_id', $category_to_copy->id)->get();
                    $category_communes_qty_to_copy = CategoryCommune::where('category_id', $category_to_copy->id)->count();

                    if ($category_communes_qty_to_copy > 0) {
                        foreach ($category_communes_to_copy as $category_commune_to_copy) {
                            $category_commune = new CategoryCommune();
                            $category_commune->category_id = $category->id;
                            $category_commune->commune_id = $category_commune_to_copy->commune_id;
                            $category_commune->save();
                        }
                    }
                }
                
                if($category_to_copy->icon_type_id == 2) { 
                    $original_image = 'public/files/' . $category_to_copy->icon;
                    $new_name_image = $icon;
                    $copy_path = 'public/files/' . $new_name_image;
                    File::copy(storage_path('app/' . $original_image), storage_path('app/' . $copy_path));
                }

                if($category_to_copy->content_type_id == 4) { 
                    $original_image = 'public/files/' . $category_to_copy->pdf;
                    $new_name_image = $pdf;
                    $copy_path = 'public/files/' . $new_name_image;
                    File::copy(storage_path('app/' . $original_image), storage_path('app/' . $copy_path));
                }

                return response()->json([
                    'success' => true,
                    'data' => $category
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
                $html = $request->fa_icon;

                $pattern = '/class="(.*?)"/';

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

            $category = Category::create([
                'section_id' => $request->section_id,
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

            if ($category) {
                if ($request->georeferencing_type_id == 1) {
                    $region_data = explode(',', $request->region_id);

                    if (count($region_data) > 0) {
                        for ($i=0; $i < count($region_data); $i++) { 
                            $category_region = new CategoryRegion();
                            $category_region->category_id = $category->id;
                            $category_region->region_id = $region_data[$i];
                            $category_region->save();
                        }
                    } else {
                        $regions = Region::all();

                        foreach ($regions as $region) {
                            $category_region = new CategoryRegion();
                            $category_region->category_id = $category->id;
                            $category_region->region_id = $region->id;
                            $category_region->save();
                        }
                    }
                    
                    $commune_data = explode(',', $request->commune_id);

                    if (count($commune_data)) {
                        for ($i=0; $i < count($commune_data); $i++) {
                            $category_commune = new CategoryCommune();
                            $category_commune->category_id = $category->id;
                            $category_commune->commune_id = $commune_data[$i];
                            $category_commune->save();
                        }  
                    } else {
                        $communes = Commune::all();

                        foreach ($communes as $commune) {
                            $category_commune = new CategoryCommune();
                            $category_commune->category_id = $category->id;
                            $category_commune->commune_id = $commune->id;
                            $category_commune->save();
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
                    'data' => $category
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
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $category = Category::find($request->id);

        return response()->json([
            'success' => true,
            'data' => $category
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

        $category = Category::find($id);

        if ($request->section_id != 'null' 
        && $request->section_id != null 
        && $request->section_id != '') {
            $category->section_id = $request->section_id;
        }

        if ($request->status_id != 'null' 
        && $request->status_id != null 
        && $request->status_id != '') {
            $category->status_id = $request->status_id;
        }

        if ($request->title != 'null' 
        && $request->title != null 
        && $request->title != '') {
            $category->title = $request->title;
        }

        if ($request->google_tag != 'null' 
        && $request->google_tag != null 
        && $request->google_tag != '') {
            $category->google_tag = $request->google_tag;
        }

        if ($request->position != 'null' 
        && $request->position != null 
        && $request->position != '') {
            $category->position = $request->position;
        }

        if ($request->color != 'null' 
        && $request->color != null 
        && $request->color != '') {
            $category->color = $request->color;
        }

        if ($request->start_date != 'null' 
        && $request->start_date != null 
        && $request->start_date != '') {
            $category->start_date = $request->start_date;
        }

        if ($request->end_date != 'null' 
        && $request->end_date != null 
        && $request->end_date != '') {
            $category->end_date = $request->end_date;
        }

        if ($request->georeferencing_type_id != 'null' 
        && $request->georeferencing_type_id != null 
        && $request->georeferencing_type_id != '') {
            $category->georeferencing_type_id = $request->georeferencing_type_id;
        }

        if ($request->icon_status_id != 'null' 
        && $request->icon_status_id != null 
        && $request->icon_status_id != '') {
            $category->icon_status_id = $request->icon_status_id;
        }

        if ($request->icon_type_id != 'null' 
        && $request->icon_type_id != null 
        && $request->icon_type_id != '') {
            $category->icon_type_id = $request->icon_type_id;
        }

        if ($icon != 'null' 
        && $icon != null 
        && $icon != '') {
            $category->icon = $icon;
        }

        if ($request->content_type_id != 'null' 
        && $request->content_type_id != null 
        && $request->content_type_id != '') {
            $category->content_type_id = $request->content_type_id;
        }

        if ($request->video_description != 'null' 
        && $request->video_description != null 
        && $request->video_description != '') {
            $category->video_description = $request->video_description;
        }

        if ($request->video_type_id != 'null' 
        && $request->video_type_id != null 
        && $request->video_type_id != '') {
            $category->video_type_id = $request->video_type_id;
        }

        if ($request->video_id != 'null' 
        && $request->video_id != null 
        && $request->video_id != '') {
            $category->video_id = $request->video_id;
        }

        if ($request->src_description != 'null' 
        && $request->src_description != null 
        && $request->src_description != '') {
            $category->src_description = $request->src_description;
        }

        if ($request->audio_src != 'null' 
        && $request->audio_src != null 
        && $request->audio_src != '') {
            $category->audio_src = $request->audio_src;
        }

        if ($request->text_description != 'null' 
        && $request->text_description != null 
        && $request->text_description != '') {
            $category->text_description = $request->text_description;
        }

        if ($request->pdf_description != 'null' 
        && $request->pdf_description != null 
        && $request->pdf_description != '') {
            $category->pdf_description = $request->pdf_description;
        }

        if ($pdf != 'null' 
        && $pdf != null 
        && $pdf != '') {
            $category->pdf = $pdf;
        }

        if ($request->iframe_description != 'null' 
        && $request->iframe_description != null 
        && $request->iframe_description != '') {
            $category->iframe_description = $request->iframe_description;
        }
 
        if ($request->iframe_url != 'null' 
        && $request->iframe_url != null 
        && $request->iframe_url != '') {
            $category->iframe_url = $request->iframe_url;
        }
  
        if ($request->phone != 'null' 
        && $request->phone != null 
        && $request->phone != '') {
            $category->phone = $request->phone;
        }
        
        if ($request->url_external_page != 'null' 
        && $request->url_external_page != null 
        && $request->url_external_page != '') {
            $category->url_external_page = $request->url_external_page;
        }

        if ($request->app_type_id != 'null' 
        && $request->app_type_id != null 
        && $request->app_type_id != '') {
            $category->app_type_id = $request->app_type_id;
        }
        
        if ($request->url_app != 'null' 
        && $request->url_app != null 
        && $request->url_app != '') {
            $category->url_app = $request->url_app;
        }

        if ($request->uri_app != 'null' 
        && $request->uri_app != null 
        && $request->uri_app != '') {
            $category->uri_app = $request->uri_app;
        }

        if ($request->url_desktop_app != 'null' 
        && $request->url_desktop_app != null 
        && $request->url_desktop_app != '') {
            $category->url_desktop_app = $request->url_desktop_app;
        }

        if ($request->url_not_installed_app != 'null' 
        && $request->url_not_installed_app != null 
        && $request->url_not_installed_app != '') {
            $category->url_not_installed_app = $request->url_not_installed_app;
        }

        if ($request->whatsapp_type_id != 'null' 
        && $request->whatsapp_type_id != null 
        && $request->whatsapp_type_id != '') {
            $category->whatsapp_type_id = $request->whatsapp_type_id;
        }

        if ($request->whatsapp_url != 'null' 
        && $request->whatsapp_url != null 
        && $request->whatsapp_url != '') {
            $category->whatsapp_url = $request->whatsapp_url;
        }

        $category->save();

        if ($category) {
            if ($request->georeferencing_type_id == 1) {
                $category_regions = CategoryRegion::where('category_id', $category->id)->get();

                foreach ($category_regions as $category_region) {
                    $category_region_detail = CategoryRegion::find($category_region->id);
                    $category_region_detail->delete();
                }

                $category_communes = CategoryCommune::where('category_id', $category->id)->get();

                foreach ($category_communes as $category_commune) {
                    $category_commune_detail = CategoryCommune::find($category_commune->id);
                    $category_commune_detail->delete();
                }

                $region_data = explode(',', $request->region_id);

                if (count($region_data) > 0) {
                    for ($i=0; $i < count($region_data); $i++) { 
                        $category_region = new CategoryRegion();
                        $category_region->category_id = $category->id;
                        $category_region->region_id = $region_data[$i];
                        $category_region->save();
                    }
                } else {
                    $regions = Region::all();

                    foreach ($regions as $region) {
                        $category_region = new CategoryRegion();
                        $category_region->category_id = $category->id;
                        $category_region->region_id = $region->id;
                        $category_region->save();
                    }
                }
                
                $commune_data = explode(',', $request->commune_id);

                if (count($commune_data)) {
                    for ($i=0; $i < count($commune_data); $i++) {
                        $category_commune = new CategoryCommune();
                        $category_commune->category_id = $category->id;
                        $category_commune->commune_id = $commune_data[$i];
                        $category_commune->save();
                    }  
                } else {
                    $communes = Commune::all();

                    foreach ($communes as $commune) {
                        $category_commune = new CategoryCommune();
                        $category_commune->category_id = $category->id;
                        $category_commune->commune_id = $commune->id;
                        $category_commune->save();
                    }
                }
            } else {
                $category_regions = CategoryRegion::where('category_id', $category->id)->get();

                foreach ($category_regions as $category_region) {
                    $category_region_detail = CategoryRegion::find($category_region->id);
                    $category_region_detail->delete();
                }

                $category_communes = CategoryCommune::where('category_id', $category->id)->get();

                foreach ($category_communes as $category_commune) {
                    $category_commune_detail = CategoryCommune::find($category_commune->id);
                    $category_commune_detail->delete();
                }
            }

            if($request->hasFile('icon_image')) { 
                Storage::disk('local')->delete('public/'.$icon);

                Storage::disk('local')->putFileAs(
                    'public',
                    $request->icon_image,
                    $icon
                );
            }

            if($request->hasFile('pdf')) { 
                Storage::disk('local')->delete('public/'.$pdf);

                Storage::disk('local')->putFileAs(
                    'public',
                    $request->pdf,
                    $pdf
                );
            }

            return response()->json([
                'success' => true,
                'data' => $category
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
        $category = Category::find($request->id);

        if ($category->icon_type_id == 2) {
            $icon = $category->icon;
        } else {
            $icon = '';
        }

        if ($category->content_type_id == 4) {
            $pdf = $category->pdf;
        } else {
            $pdf = '';
        }
        
        if($category->delete()) {
            if ($icon != '') {
                Storage::disk('local')->delete('public/files/'.$icon);
            }

            if ($pdf != '') {
                Storage::disk('local')->delete('public/files/'.$pdf);
            }
        }

        return response()->json([
            'success' => true,
            'data' => $category
        ], 200);
    }
}
