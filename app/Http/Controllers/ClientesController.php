<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Clientes;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function index()
    {
        return view('clientes.index');
    }

    public function crear()
    {
        return view('clientes.crear');
    }

    
    public function store(Request $request)
    {
        $request->validate([

            'nombre_cliente' => 'required|min:3',
            'documento' => 'required|unique:clientes,Documento|numeric|digits_between:6,10',

        ]);

        try {

        

        $clientes = new Clientes();
            $clientes->Nombre_Cliente = $request->nombre_cliente;
            $clientes->Documento = $request->documento;

            $clientes->save();

            return redirect("/clientes")->with('registrar', 'Se Registro El Cliente Correctamente');


        } catch (\Throwable $e) {
            
            return redirect("clientes.crear");
        }
        
        
    }

    public function listar(Request $request)
    {
        $clientes = Clientes::all();

        return DataTables::of($clientes)

            ->editColumn('estado', function ($cliente) {     
                return $cliente->Estado == 1 ? "Activa" : "Inactiva";
            })
            ->addColumn('acciones', function ($cliente) {
                return '<a href="/clientes/editar/'.$cliente->id.'" class="btn btn-primary"> Editar</a>';
            })
        
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function editar($id)
    {
        $clientes = Clientes::find($id);

        return view('clientes.editar', compact('clientes'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([

            'nombre_cliente' => 'required|min:3',
            'documento' => 'required|numeric|digits_between:6,10',

        ]);

        try {

            
            $clientes = Clientes::find($id);

            $clientes->Nombre_Cliente = $request->input('nombre_cliente');
            $clientes->Documento = $request->input('documento');

            $clientes->save();

            return redirect("/clientes")->with('editar', 'Se Editó El Cliente Correctamente');

        } catch (\Throwable $e) {
            
            return redirect("clientes/editar");
        }

        
    }


    public function destroy($id)
    {
        //
    }
}
