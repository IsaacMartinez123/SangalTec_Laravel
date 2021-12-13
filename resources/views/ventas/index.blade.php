@extends('layouts.app')

@section('titulo')
    Gestion De Ventas
@endsection 

@section('content')
@if ($errors->any())
    <div style=" margin-left: 30%; width: 40%;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

<div class="card">

    <div class="card-body">
        <div>
            <a style="position: relative; left: 90%;" href="/ventas/crear" class="btn btn-success "> Crear Venta </a>
        </div>
        {{-- <div>
            <a href="/ventas/detalle/" class="btn btn-secondary"> Tabla Detalle</a>'
        </div> --}}
        <br>
            <table id="ventas" class="table table-bordered" style="width: 100%;">
                <thead>
                    <tr>
                        <th>id</th>
                        
                        <th>Documento Del Cliente</th> 
                        <th>Precio Total</th>                      
                        <th>Fecha De La Venta</th>
                        <th>Cambiar</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#ventas').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/ventas/listar",
            columns: [
                {data: 'id', name: 'id'},               
                {data: 'Documento', name: 'Documento'}, 
                {data: 'precio_total', name: 'precio_total'}, 
                {data: 'created_at', name: 'created_at'},                              
                {data: 'cambiar', name: 'cambiar', orderable: false, searchable: false},
                {data: 'detalle', name: 'detalle', orderable: false, searchable: false},
        ],
        "language": idioma_español
    });
        });
        

        
    </script>
@endsection 