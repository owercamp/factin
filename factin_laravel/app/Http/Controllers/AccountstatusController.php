<?php

namespace App\Http\Controllers;

use App\Models\BillingOrder;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class AccountstatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function Accountindex()
    {
        return \view('partials.AccountStatus.AccountIndex');
    }
    function accountfact(Request $request)
    {
        // return $request;
        $factSelection = $request->selection;
        $month = $request->Month;
        $year = $request->Year;
        $number = 0;
        foreach ($factSelection as $key) {
            if ($key == 'Si') {
                $data = [];
                switch ($month) {
                    case 0: $MonthAct = "Enero"; break;
                    case 1: $MonthAct = "Febrero"; break;
                    case 2: $MonthAct = "Marzo"; break;
                    case 3: $MonthAct = "Abril"; break;
                    case 4: $MonthAct = "Mayo"; break;
                    case 5: $MonthAct = "Junio"; break;
                    case 6: $MonthAct = "Julio"; break;
                    case 7: $MonthAct = "Agosto"; break;
                    case 8: $MonthAct = "Septiembre"; break;
                    case 9: $MonthAct = "Octubre"; break;
                    case 10: $MonthAct = "Noviembre"; break;
                    case 11: $MonthAct = "Diciembre"; break;
                }
                $info = Contract::where('contracts.con_id',$request->NContract[$number])                
                ->join('agreements','agreements.legal_id','=','contracts.con_social')
                ->join('collaborators','collaborators.id','=','agreements.legal_cola')
                ->join('leads','leads.lead_id','=','agreements.legal_social')
                ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->first();
                // return $info;
                \array_push($data,$info);
                $MyData = \json_encode($data);               
                BillingOrder::create([
                    'bo_month' => $MonthAct,
                    'bo_year' => $year,
                    'bo_sale_month' => $request->quota[$number],
                    'bo_data' => $MyData
                ]);
            }
            $number++;
        }        
        return \redirect()->route('account.index')->with('Success','Success');
    }
}