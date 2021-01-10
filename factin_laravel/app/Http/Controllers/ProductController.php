<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Productmodule;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function productindex()
    {
        $products = Product::all();
        
        return view('partials.ProductType.product', compact('products'));
    }

    function productsave(Request $request)
    {
        $validation = Product::where('pro_name',$this::upper($request->productname))->first();
        if($validation == null)
        {
            Product::create([
                $newproduct = $request->productname,
                'pro_name' => $this::upper($request->productname)
            ]);
            return redirect()->route('product.index')->with('SuccessCreation', 'Producto '.$newproduct.' creado satisfactoriamente');
        }else{
            return redirect()->route('product.index')->with('SecondaryCreation', 'Producto '.$this->fu($request->productname).' existente');
        }
    }

    function productupdate(Request $request)
    {
        $validateData = Product::where('pro_name',$this::upper($request->productname_Edit))
        ->where('pro_id','!=',trim($request->productid_Edit))
        ->first();
        if($validateData == null)
        {
            $valida = Product::find($request->productid_Edit);
            if($valida != null)
            {
                $valida->pro_name = $this::upper($request->productname_Edit);
                $valida->save();
                return redirect()->route('product.index')->with('PrimaryCreation','Producto '.$this::upper($request->productname_Edit).' actualizado');
            }else{
                return redirect()->route('product.index')->with('SecondaryCreation','NoEncontrado');
            }
        }else{
            return redirect()->route('product.index')->with('SecondaryCreation','Producto '.$request->productname_edit.' existente');
        }
    }

    function productdelete(Request $request)
    {
        $validate = Product::where(trim($request->productid_Delete));        
        if($validate != null)
        {
            $name = $this->fu($request->productname_Delete);
            Product::findOrFail($request->productid_Delete)->delete();
            return redirect()->route('product.index')->with('WarningCreation','Producto '.$name.' eliminado');
        }else{
            return redirect()->route('product.index')->with('SecondDelete', 'NoEncontrado');
        }
    }

    function moduleproductindex()
    {
        $modules = Productmodule::all();
        
        return view('partials.ProductType.moduleproduct', compact('modules'));
    }

    function moduleproductsave(Request $request)
    {
        $validate = Productmodule::where('mod_name',$this::upper($request->modulename))->first();
        if($validate == null)
        {
            Productmodule::create([
                $newproduct = $request->modulename,
                'mod_name' => $this::upper($request->modulename)
            ]);
            return redirect()->route('module.index')->with('SuccessCreation', 'Producto '.$newproduct.' creado satisfactoriamente');
        }else{
            return redirect()->route('module.index')->with('SecondaryCreation', 'Producto '.$this->fu($request->modulename).' existente');
        }
    }

    function moduleproductupdate(Request $request)
    {
        $validateData = Productmodule::where('mod_name',$this::upper($request->modulename_Edit))
        ->where('mod_id','!=',trim($request->moduleid_Edit))
        ->first();
        if($validateData == null)
        {
            $valida = Productmodule::find($request->moduleid_Edit);
            if($valida != null)
            {
                $valida->mod_name = $this::upper($request->modulename_Edit);
                $valida->save();
                return redirect()->route('module.index')->with('PrimaryCreation','Producto '.$this::upper($request->modulename_Edit).' actualizado');
            }else{
                return redirect()->route('module.index')->with('SecondaryCreation','NoEncontrado');
            }
        }else{
            return redirect()->route('module.index')->with('SecondaryCreation','Producto '.$request->modulename_edit.' existente');
        }
    }

    function moduleproductdelete(Request $request)
    {
        $validate = Productmodule::where(trim($request->moduleid_Delete));        
        if($validate != null)
        {
            Productmodule::findOrFail($request->moduleid_Delete)->delete();
            return redirect()->route('module.index')->with('WarningCreation','Producto eliminado');
        }else{
            return redirect()->route('module.index')->with('SecondDelete', 'NoEncontrado');
        }
    }
}
