<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\BillingOrder;
use App\Models\Collaborator;
use App\Models\Commission;
use App\Models\Contract;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class FinanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function billingorderindex()
    {
        $billingOrder = BillingOrder::all();
        return \view('partials.Finances.BillingOrder', \compact('billingOrder'));
    }
    function billingorderpdf(Request $request)
    {
        $data = BillingOrder::where('bo_id',\trim($request->OrderPrinter))->get();
        $sale_month = $data[0]['bo_sale_month'];
        $month = $data[0]['bo_month'];
        $year = $data[0]['bo_year'];
        $JsonData = \json_decode($data[0]['bo_data']);

        $pdf = PDF::loadView('partials.pdf.BillingOrderPDF', \compact('sale_month','month','year','JsonData'));
        return $pdf->stream('Orden Factura.pdf');
    }
    function comissionsindex()
    {
        $facturations = Commission::select('commissions.*','collaborators.*')
        ->join('collaborators','collaborators.id','=','commissions.co_cola')->get();
        $collaborators = Collaborator::all();
        return \view('partials.Finances.settlementCommission', compact('collaborators','facturations'));
    }
    function commissionsave(Request $request)
    {
        $facture = Contract::select('contracts.*','agreements.*','collaborators.*','leads.*','business_trackings.*')
        ->join('agreements','agreements.legal_id','=','contracts.con_social')
        ->join('collaborators','collaborators.id','=','agreements.legal_Cola')
        ->join('leads','leads.lead_id','=','agreements.legal_social')
        ->join('business_trackings','business_trackings.bt_id','=','leads.lead_social')->get();
        // return $facture;
        // lo que envio para insertar en la db
        $indexMonth = $request->MonthSelected;
        $indexYear = $request->YearSelected;
        $collaborator = $request->ColaSelected;
        $dataJSON = [];
        $comi = 0;
        // esta es la zona de mi validación para ingrsar los datos al array
        foreach($facture as $data){
            $mon = \mb_split('-',$data->con_final);
            if( $indexMonth <= $mon[1] && \intval($mon[0]) == $indexYear && $data->id == $collaborator)
            {
                $comi += $data->legal_comi;
                \array_push($dataJSON, $data);
            }
        }
        switch ($indexMonth) {
            case '01': $MonthAct = "Enero"; break;
            case '02': $MonthAct = "Febrero"; break;
            case '03': $MonthAct = "Marzo"; break;
            case '04': $MonthAct = "Abril"; break;
            case '05': $MonthAct = "Mayo"; break;
            case '06': $MonthAct = "Junio"; break;
            case '07': $MonthAct = "Julio"; break;
            case '08': $MonthAct = "Agosto"; break;
            case '09': $MonthAct = "Septiembre"; break;
            case '10': $MonthAct = "Octubre"; break;
            case '11': $MonthAct = "Noviembre"; break;
            case '12': $MonthAct = "Diciembre"; break;
        }
        $json = \json_encode($dataJSON);        
        $search = Commission::where('co_cola',$collaborator)->where('co_month',$MonthAct)->where('co_year',$indexYear)->first();               
        if($search == null){
            Commission::create([
                'co_cola' => $collaborator,
                'co_month' => $MonthAct,
                'co_year' => $indexYear,
                'co_comi' => $comi,
                'co_data' => $json
            ]);
            return \redirect()->route('comission.finance')->with('Success','Success');
        }else{
            return \redirect()->route('comission.finance')->with('SecondaryCreation','Duplicate');
        }
    }
    function commissionpdf(Request $request)
    {        
        $data = Commission::where('co_id',$request->commissionPDF)
        ->join('collaborators','collaborators.id','=','commissions.co_cola')->get();
        $nameCol = $data[0]['col_name'];
        $dataFact = \json_decode($data[0]['co_data']); 
        $comi = $data[0]['co_comi'];       
        $pdf = PDF::loadView('partials.pdf.CommissionPDF', \compact('nameCol','dataFact','comi'));
        return $pdf->stream('Comision.pdf');
    }
    // estadisticas de ventas mes
    function salesindex()
    {
        return view('partials.Finances.salesStatistics');
    }
    // estadistica comissiones
    function commissionindex()
    {
        return view('partials.Finances.commissionStatistics');
    }
}
