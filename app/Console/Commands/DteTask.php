<?php

namespace App\Console\Commands;
use App\Models\Dte;
use App\Models\BranchOffice;
use App\Models\Cashier;
use App\Models\Collection;
use Illuminate\Console\Command;
use DB;
use DateTime;

class CollectionTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dte-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://libredte.cl/api/dte/dte_emitidos/buscar/77777612',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "receptor": null,
            "razon_social": null,
            "dte": null,
            "folio": null,
            "fecha": null,
            "total": null,
            "usuario": null,
            "fecha_desde": null,
            "fecha_hasta": null,
            "total_desde": null,
            "total_hasta": null,
            "sucursal_sii": null,
            "periodo": null,
            "receptor_evento": null,
            "cedido": null,
            "xml": {
                "Detalle/NmbItem": "abono"
            }
        }',
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        $id = $request->segment(4);
        $url = 'https://libredte.cl';
        $hash = 'mIrjMMSoCs2sHmrK92SH4BsQifGbpZS9';
        $rut = 77777612;

        // crear cliente
        $LibreDTE = new \sasco\LibreDTE\SDK\LibreDTE($hash, $url);

        // descargar PDF
        $dte = $LibreDTE->get('/dte/dte_emitidos/buscar/' . $rut);
        if ($dte['status']['code']!=200) {
            die('Error al descargar el PDF del DTE emitido: '.$pdf['body']."\n");
        }

        return $response;
    }
}
