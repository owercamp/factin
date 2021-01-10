<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductConfig;
use App\Models\Productmodule;
use Illuminate\Http\Request;

class ProductConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function configmoduleproductindex()
    {
        $module = Productmodule::all();    
        $product = Product::all();
        $configuration = ProductConfig::select(
            'product_configs.*',
            'products.*'
        )
        ->join('products','products.pro_id','=','product_configs.pc_typepro')
        ->get();

        return view('partials.ProductType.configproduct', compact('configuration','product','module'));
    }

    function configmoduleproductsave(Request $request)
    {
        $variable = $this::upper($request->ver_one).'-'.$this::upper($request->ver_two).'-'.$this::upper($request->ver_three);
        $informacion = ProductConfig::where('pc_version',$variable)->first();
        if ($informacion == null) {
            $code = $this::upper($request->ver_one).'-'.$this::upper($request->ver_two).'-'.$this::upper($request->ver_three);
            ProductConfig::create([
                'pc_version' => $code,
                'pc_typepro' => trim($request->TipoPro),
                'pc_content' => $this::upper($request->Contenido)
            ]);
            return redirect()->route('config.index')->with('SuccessCreation', 'Almacenado Correctamente');
        } else {
            return redirect()->route('config.index')->with('SecondaryCreation', 'Ya existe esta configuración almacenada');
        }        
    }

    function configmoduleproductupdate(Request $request)
    {
        $code = $this::upper($request->ver_one_Edit).'-'.$this::upper($request->ver_two_Edit).'-'.$this::upper($request->ver_three_Edit);
        $validate = ProductConfig::where('pc_version',$this->fu($code))
        ->where('pc_id','!=',trim($request->pc_id_Edit))
        ->first();
        if($validate == null)
        {
            $updated = ProductConfig::find($request->pc_id_Edit);
            if ($updated != null) {
                $codes = $this::upper($request->ver_one_Edit).'-'.$this::upper($request->ver_two_Edit).'-'.$this::upper($request->ver_three_Edit);
                $updated->pc_version = $codes;
                $updated->pc_typepro = trim($request->TipoPro_Edit);
                $MyContent = $this::upper($request->Contenido_Edit).' '.$this::upper($request->NewContent);
                $updated->pc_content = $MyContent;
                $updated->save();
                return redirect()->route('config.index')->with('PrimaryCreation','Configuración actualizada');
            } else {
                return redirect()->route('config.index')->with('SecondaryCreation','NoEncontrado');
            }
        }else{
            return redirect()->route('config.index')->with('SecondaryCreation','Configuración no se pudo actualizar');
        }
    }

    function configmoduleproductdelete(Request $request)
    {
        $validate = ProductConfig::where('pc_id',trim($request->pc_id_Delete))
        ->first();
        if($validate != null)
        {
            $delet = ProductConfig::find(trim($request->pc_id_Delete));
            $validate->delete();
            return redirect()->route('config.index')->with('WarningCreation', 'Configuración de la versión '.$delet->pc_version.' eliminada');
        }else{
            return redirect()->route('config.index')->with('SecondaryCreation', 'no es posible eliminar este registro');
        }
    }
}
