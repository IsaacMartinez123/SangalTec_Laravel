<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Ventas;
use App\Models\Productos;
use App\Models\Clientes;
use App\Models\VentasDetalle;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    
    public function index()
    {        

        return view('ventas.index');
    }

    public function crear()
    {
        $productos = Productos::all();
        $clientes = Clientes::all();;

        return view('ventas.crear', compact('productos','clientes'));
    }

    public function store(Request $request)
    {
        
        $request->validate(
            [
                'ProductoN'=> 'required',
                'DocumentoC'=> 'required',
                'cantidad'=> 'required'
            ],

            [
                'ProductoN.required' => 'El Nombre Del Producto, La Cantidad y El Precio Son Campos Obligatorios',

                'DocumentoC.required' => 'El Documento y El Nombre Del Cliente Son Campos Obligatorios',

                'cantidad.required' => 'No Se Puede Realizar La Venta Sin Ingresar La Cantidad '
            ]
        );
        
        $input = $request->all();

        foreach ($input["ProductoN"] as $key => $value) {
            $productoRecorrido = Productos::findOrFail($value);
            if ($input["cantidades"][$key] > $productoRecorrido->Cantidad) {
                return redirect('/ventas/crear')->with('cantidad', 'El Stock De '. $productoRecorrido->Nombre_Producto .' Es Insuficiente');
            }
        }

        try {
            
            DB::beginTransaction();

            $ventas = Ventas::create([
                'cliente_id'=> $input["DocumentoC"],
                'precio_total'=> $input["precio_venta"],
                "Estado"=> 0,
    
                
            ]);
    
            foreach($input["ProductoN"] as $key => $value)
            {
                
                $ventasdetalles = VentasDetalle::create([
                    'producto_id'=> $value,
                    'venta_id'=> $ventas->id,
                    'cantidad'=> $input["cantidades"][$key],
                    'sub_total'=> $input["precios"][$key] * $input["cantidades"][$key],
                    
                ]);

                $product = Productos::findOrFail($value);

                $product->update(["Cantidad"=> $product->Cantidad - $input["cantidades"][$key]]);

    
            }

            DB::commit();

        } catch (\Throwable $e) {

            return redirect("/ventas/crear");

            DB::rollBack();  
        }      
        

        return redirect("/ventas")->with('registrarVenta', 'Se Registro La venta Correctamente');
        
    }


    public function listar(Request $request)
    {
        
        $ventas = Ventas::select("ventas.*", "clientes.Documento as Documento")
        ->join("clientes", "ventas.cliente_id", "=", "clientes.id")
        ->get();
        
        
        return DataTables::of($ventas)

            ->editColumn('estado', function ($venta) {     
                return $venta->Estado == 1 ? "Activa" : "Inactiva";
            })
            

            ->addColumn('cambiar', function ($venta) {

                if ($venta->Estado == 1) {
                    return '<a class="btn btn-danger " href="/ventas/cambiarEstado/'.$venta->id.'/0">Inactivo</a>';
                }
                else{
                    return '<a class="btn btn-success" href="/ventas/cambiarEstado/'.$venta->id.'/1"> Activo</a>';
                }
            })

            ->addColumn('detalle', function ($venta) {
                return '<a href="/ventas/verproductos/'.$venta->id.'" class="btn btn-secondary"> Ver Productos Vendidos</a>';
            })
        
            ->rawColumns([ 'cambiar','detalle'])
            ->make(true);
    }



    public function listardetalle($id)
    {
        
            $ventasdetalles = VentasDetalle::select("ventasdetalles.id as Id", "ventasdetalles.venta_id as Ventas", "productos.Nombre_Producto as Productos", "ventasdetalles.cantidad as Cantidad", "ventasdetalles.sub_total as SubTotal")
                ->join("productos", "ventasdetalles.producto_id", "=", "productos.id")
                ->where("ventasdetalles.venta_id", "=", $id)
                ->get();
                    
            return view("ventas.productos", compact("ventasdetalles"));

    }


    public function updateState($id, $Estado)
    {
        $ventas = Ventas::find($id);

        $ventas->update(["Estado"=>$Estado]);

        return redirect("/ventas")->with('cambiar', 'Se Cambio El Estado Correctamente');;
    }

}
