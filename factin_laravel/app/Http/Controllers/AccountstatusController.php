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
        $info = Contract::select('contracts.*','agreements.*','leads.*','business_trackings.*','collaborators.*')
        ->join('agreements','agreements.legal_id','=','contracts.con_social')
        ->join('collaborators','collaborators.id','=','agreements.legal_cola')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social') ->get();

        $index = $request->Month;
        $year = $request->Year;
        $data = [];
        foreach ($info as $item) {
            $mon = \mb_split('-',$item->con_final);
            switch ($mon[1]) {
                case '01': $isMonth = 0; break;
                case '02': $isMonth = 1; break;
                case '03': $isMonth = 2; break;
                case '04': $isMonth = 3; break;
                case '05': $isMonth = 4; break;
                case '06': $isMonth = 5; break;
                case '07': $isMonth = 6; break;
                case '08': $isMonth = 7; break;
                case '09': $isMonth = 8; break;
                case '10': $isMonth = 9; break;
                case '11': $isMonth = 10; break;
                case '12': $isMonth = 11; break;
            }            
            if ( $year == intval($mon[0]) && $index <= $isMonth) {
                \array_push($data, $item);
            }
        }
        // almacena mi información en un json
        $MyData = \json_encode($data);
        switch ($index) {
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
        // quita los puntos decimales de los datos en moneda
        $valWith = $request->subtotal;
        $valWithout = \str_replace(".","",$valWith);
        // almacena en mi tabla
        BillingOrder::create([
            'bo_month' => $MonthAct,
            'bo_year' => \strval($mon[0]),
            'bo_sale_month' => $valWithout,
            'bo_data' => $MyData
        ]);
        return \redirect()->route('account.index')->with('Success','Success');
    }
}