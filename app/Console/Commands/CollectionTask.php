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
    protected $signature = 'app:collection-task';

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
        $branch_offices = BranchOffice::all();
        
        foreach($branch_offices as $branch_office) 
        {
            $cashiers = Cashier::where('branch_office_id', $branch_office->id)->get();

            $date = date('Y-m-d', strtotime('-5 days', strtotime(date('Y-m-d'))));

            foreach($cashiers as $cashier) {
                
                $dtes = Dte::from('dtes as c')
                        ->selectRaw('SUM(c.cash_amount) as cash_amount, SUM(c.card_amount) as card_amount, COUNT(*) as quantity, DATE(c.created_at) as date')
                        ->groupBy(DB::raw('DATE(c.created_at)'))
                        ->whereDate('created_at', '>=', $date)
                        ->where('c.branch_office_id', $branch_office->id)
                        ->where('c.cashier_id', $cashier->id)
                        ->get();

                foreach($dtes as $dte) {
                    $collection_qty = Collection::where('branch_office_id', $branch_office->id)->where('cashier_id', $cashier->id)->whereRaw('DATE(created_at) = "'. $dte->date .'"')->count();

                    if($collection_qty > 0) {
                        $collection = Collection::where('branch_office_id', $branch_office->id)->where('cashier_id', $cashier->id)->whereRaw('DATE(created_at) = "'. $dte->date .'"')->first();
                        $cash_amount = $collection->cash_amount;
                        $card_amount = $collection->card_amount;
                        $ticket_number = $collection->quantity;
                        $old_amount = $collection->cash_amount + $collection->card_amount;
                        $new_amount = $dte->cash_amount + $dte->card_amount;
                        $collection->cash_amount = $dte->cash_amount;
                        $collection->card_amount = $dte->card_amount;
                        $collection->quantity = $dte->quantity;
                        $tz = 'America/Santiago';
                        $timestamp = time();
                        $dt = new DateTime("now", new \DateTimeZone($tz));
                        $dt->setTimestamp($timestamp);
                        $datetime = $dt->format('Y-m-d H:i:s');
                        $collection->updated_at = $datetime;
                        
                        if($old_amount < $new_amount) {
                            $collection->save();
                        }
                    } else {
                        $collection = new Collection;
                        $cash_amount = $collection->cash_amount;
                        $card_amount = $collection->card_amount;
                        $ticket_number = $collection->quantity;
                        $collection->branch_office_id = $branch_office->id;
                        $collection->cashier_id = $cashier->id;
                        $collection->cash_amount = $dte->cash_amount;
                        $collection->card_amount = $dte->card_amount;
                        $collection->quantity = $dte->quantity;
                        $collection->created_at = $dte->date .' 00:00:00';
                        $tz = 'America/Santiago';
                        $timestamp = time();
                        $dt = new DateTime("now", new \DateTimeZone($tz)); //first argument "must" be a string
                        $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
                        $datetime = $dt->format('Y-m-d H:i:s');

                        $collection->updated_at = $datetime;
                        $collection->save();
                    }
                }
            }
        }
    }
}
