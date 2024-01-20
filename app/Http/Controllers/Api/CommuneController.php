<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commune;
use Illuminate\Http\Request;

class CommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = $request->segment(3);

        if ($id != '') {
            $communes = Commune::select('id', 'commune')
            ->where('region_id', $id)
            ->orderBy('commune', 'asc')
            ->get();
        } else {
            $communes = Commune::select('id', 'commune')
            ->orderBy('commune', 'asc')
            ->get();
        }

        return response()->json([
            'success' => true,
            'data' => $communes
        ], 200);
    }

    /**
     * Find the commune from the third party API using the IP.
     *
     * @return \Illuminate\Http\Response
     */
    public function find()
    {
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
            $ip = explode(":", $ip);
            $ip = $ip[3];
        } 
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
            $ip = explode(":", $ip);
            $ip = $ip[3];
        }
        else{  
            $ip = $_SERVER['REMOTE_ADDR'];  
        }

        $apiKey = env('IP2LOCATION');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ip2location.io/?key={$apiKey}&ip={$ip}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $details = json_decode($response);
        }

        $city_name = $details->city_name;

        $commune = Commune::where('commune', 'like', '%' . $city_name . '%')->first();
        
        return $this->successResponse($commune);
    }
}
