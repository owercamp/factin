<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        return view('partials.ProductType.moduleproduct');
    }

    function configmoduleproductindex()
    {
        return view('partials.ProductType.configproduct');
    }
}
