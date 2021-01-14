<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Product;
use App\Models\ProductConfig;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function factinwebindex()
    {
        $configpro = ProductConfig::all();
        $product = Product::all();
        $factin = Portfolio::select(
            'portfolios.*','product_configs.*','products.*'
        )
        ->join('product_configs','product_configs.pc_id','=','portfolios.cpro_id')
        ->join('products','products.pro_id','=','product_configs.pc_typepro')
        ->get();
        // return $factin;
        return view('partials.Portfolio.FactinWeb', compact('factin','product','configpro'));
    }

    function softwareindex()
    {
        return view('partials.Portfolio.Software');
    }

    function hardwareindex()
    {
        return view('partials.Portfolio.Hardware');
    }

    function technicalsupportindex()
    {
        return view('partials.Portfolio.TechnicalSupport');
    }
}
