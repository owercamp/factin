<?php

namespace App\Http\Controllers;

use App\Models\Hardware;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\ProductConfig;
use App\Models\Software;
use App\Models\TechnicalSupport;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function factinwebindex()
    {
        $product = Product::all();
        $configpro = ProductConfig::select('product_configs.*', 'products.*')
            ->join('products', 'products.pro_id', '=', 'product_configs.pc_typepro')->get();
        $factin = Portfolio::select('portfolios.*', 'product_configs.*', 'products.*')
            ->join('product_configs', 'product_configs.pc_id', '=', 'portfolios.cpro_id')
            ->join('products', 'products.pro_id', '=', 'product_configs.pc_typepro')->get();
        return view('partials.Portfolio.FactinWeb', compact('factin', 'product', 'configpro'));
    }

    function factinwebsave(Request $request)
    {
        $validate = Portfolio::where('cpro_id', $this->fu($request->porweb))
            ->where('price', trim($request->porprice))
            ->first();
        if ($validate == null) {
            $precio = $this->fu($request->porprice);
            $clearprice = str_replace('.', '', $precio);
            Portfolio::create([
                'cpro_id' => trim($request->porweb),
                'price' => trim($clearprice)
            ]);
            return redirect()->route('factin.index')->with('SuccessCreation', 'Registro exitoso');
        } else {
            return redirect()->route('factin.index')->with('SecondaryCreation', 'Registro ' . $this::upper($request->porweb) . ' existente');
        }
    }

    function factinwebupdate(Request $request)
    {
        $search = Portfolio::find($request->por_id_Edit);
        if ($search != null) {
            $newprice = $this->fu($request->porprice_Edit);
            $newclear = str_replace('.', '', $newprice);
            $search->cpro_id = trim($request->porweb_Edit);
            $search->price = $newclear;
            $search->save();
            return redirect()->route('factin.index')->with('PrimaryCreation', 'Actualización Exitosa');
        } else {
            return redirect()->route('factin.index')->with('SecondaryCreation', 'Error al momento de altualizar');
        }
    }

    function factinwebdelete(Request $request)
    {
        $validation = Portfolio::where(trim($request->por_id_Delete));
        if ($validation != null) {
            Portfolio::findOrFail($request->por_id_Delete)->delete();
            return redirect()->route('factin.index')->with('WarningCreation', 'Producto Web Eliminado');
        } else {
            return redirect()->route('factin.index')->with('SecondCreation', 'NoEncontrado');
        }
    }

    function softwareindex()
    {
        $product = Product::all();
        $configtype = ProductConfig::select('product_configs.*', 'products.*')
            ->join('products', 'products.pro_id', '=', 'product_configs.pc_typepro')->get();
        $software = Software::select('software.*', 'product_configs.*', 'products.*')
            ->join('product_configs', 'product_configs.pc_id', '=', 'software.cpro_id')
            ->join('products', 'products.pro_id', '=', 'product_configs.pc_typepro')->get();
        return view('partials.Portfolio.Software', compact('software', 'product', 'configtype'));
    }

    function softwaresave(Request $request)
    {
        $valida = Software::where('cpro_id', $this->fu($request->porsof))
            ->where('sofprice', trim($request->porsofprice))->first();
        if ($valida == null) {
            $val = $this->fu($request->porsofprice);
            $clearprice = str_replace('.', '', $val);
            Software::create([
                'cpro_id' => trim($request->porsof),
                'sofprice' => trim($clearprice)
            ]);
            return redirect()->route('software.index')->with('SuccessCreation', 'Producto registrado');
        } else {
            return redirect()->route('software.index')->with('SecondaryCreation', 'Registro ' . $this::upper($request->porsof) . ' existente');
        }
    }

    function softwareupdate(Request $request)
    {
        $search = Software::find($request->sof_id_Edit);
        if ($search != null) {
            $newval = $this->fu($request->porsofprice_Edit);
            $clear = str_replace('.', '', $newval);
            $search->cpro_id = trim($request->porsof_Edit);
            $search->sofprice = $clear;
            $search->save();
            return redirect()->route('software.index')->with('PrimaryCreation', 'Actualización Exitosa');
        } else {
            return redirect()->route('software.index')->with('SecondaryCreation', 'Error al momento de actualizar');
        }
    }

    function softwaredelete(Request $request)
    {
        $validation = Software::where(trim($request->sof_id_Delete));
        if ($validation != null) {
            Software::findOrFail($request->sof_id_Delete)->delete();
            return redirect()->route('software.index')->with('WarningCreation', 'Software Eliminado');
        } else {
            return redirect()->route('software.index')->with('SecondCreation', 'NoEncontrado');
        }
    }

    function hardwareindex()
    {
        $product = Product::all();
        $configpros = ProductConfig::select('product_configs.*', 'products.*')
            ->join('products', 'products.pro_id', '=', 'product_configs.pc_typepro')->get();
        $hardware = Hardware::select('hardware.*', 'product_configs.*', 'products.*')
            ->join('product_configs', 'product_configs.pc_id', '=', 'hardware.cpro_id')
            ->join('products', 'products.pro_id', '=', 'product_configs.pc_typepro')->get();
        return view('partials.Portfolio.Hardware', compact('hardware','configpros','product'));
    }

    function hardwaresave(Request $request)
    {
        $validar = Hardware::where('cpro_id', $this->fu($request->porhar))
            ->where('harprice', trim($request->porharprice))->first();
        if ($validar == null) {
            $val = $this->fu($request->porharprice);
            $clearprice = str_replace('.', '', $val);
            Hardware::create([
                'cpro_id' => trim($request->porhar),
                'harprice' => trim($clearprice)
            ]);
            return redirect()->route('hardware.index')->with('SuccessCreation', 'Producto registrado');
        } else {
            return redirect()->route('hardware.index')->with('SecondaryCreation', 'Registro ' . $this::upper($request->porsof) . ' existente');
        }
    }

    function hardwareupdate(Request $request)
    {
        $search = Hardware::find($request->har_id_Edit);
        if ($search != null) {
            $newval = $this->fu($request->porharprice_Edit);
            $clear = str_replace('.', '', $newval);
            $search->cpro_id = trim($request->porhar_Edit);
            $search->harprice = $clear;
            $search->save();
            return redirect()->route('hardware.index')->with('PrimaryCreation', 'Actualización Exitosa');
        } else {
            return redirect()->route('hardware.index')->with('SecondaryCreation', 'Error al momento de actualizar');
        }
    }

    function hardwaredelete(Request $request)
    {
        $validation = Hardware::where(trim($request->har_id_Delete));
        if ($validation != null) {
            Hardware::findOrFail($request->har_id_Delete)->delete();
            return redirect()->route('hardware.index')->with('WarningCreation', 'Software Eliminado');
        } else {
            return redirect()->route('hardware.index')->with('SecondCreation', 'NoEncontrado');
        }
    }

    function technicalsupportindex()
    {
        $product = Product::all();
        $configspro = ProductConfig::select('product_configs.*', 'products.*')
            ->join('products', 'products.pro_id', '=', 'product_configs.pc_typepro')->get();
        $tsupport = TechnicalSupport::select('technical_supports.*', 'product_configs.*', 'products.*')
            ->join('product_configs', 'product_configs.pc_id', '=', 'technical_supports.cpro_id')
            ->join('products', 'products.pro_id', '=', 'product_configs.pc_typepro')->get();
        return view('partials.Portfolio.TechnicalSupport', compact('tsupport','configspro','product'));
    }

    function technicalsupportsave(Request $request)
    {
        $validar = TechnicalSupport::where('cpro_id', $this->fu($request->ports))
            ->where('tsprice', trim($request->portsprice))->first();
        if ($validar == null) {
            $val = $this->fu($request->portsprice);
            $clearprice = str_replace('.', '', $val);
            TechnicalSupport::create([
                'cpro_id' => trim($request->ports),
                'tsprice' => trim($clearprice)
            ]);
            return redirect()->route('support.index')->with('SuccessCreation', 'Producto registrado');
        } else {
            return redirect()->route('support.index')->with('SecondaryCreation', 'Registro ' . $this::upper($request->porsof) . ' existente');
        }
    }

    function technicalsupportupdate(Request $request)
    {
        $search = TechnicalSupport::find($request->id_Edit);
        if ($search != null) {
            $newval = $this->fu($request->portsprice_Edit);
            $clear = str_replace('.', '', $newval);
            $search->cpro_id = trim($request->ports_Edit);
            $search->tsprice = $clear;
            $search->save();
            return redirect()->route('support.index')->with('PrimaryCreation', 'Actualización Exitosa');
        } else {
            return redirect()->route('support.index')->with('SecondaryCreation', 'Error al momento de actualizar');
        }
    }

    function technicalsupportdelete(Request $request)
    {
        $validation = TechnicalSupport::where(trim($request->id_Delete));
        if ($validation != null) {
            TechnicalSupport::findOrFail($request->id_Delete)->delete();
            return redirect()->route('support.index')->with('WarningCreation', 'Software Eliminado');
        } else {
            return redirect()->route('support.index')->with('SecondCreation', 'NoEncontrado');
        }
    }
}
