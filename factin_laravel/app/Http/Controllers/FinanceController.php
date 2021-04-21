<?php

namespace App\Http\Controllers;

use App\Models\BillingOrder;
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
}
