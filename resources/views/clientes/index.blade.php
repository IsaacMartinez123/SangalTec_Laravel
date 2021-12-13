@extends('layouts.app')


@section('titulo')
    Gestion De Clientes
@endsection   


@section('content')
<div class="card">
    <div class="card-body">
            <div>
                <a style="position: relative; left: 90%;" href="/clientes/crear" class="btn btn-success"> Crear Cliente </a>
            </div>
            <br>
            <table id="clientes" class="table table-bordered" style="width: 100%;">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre Del Cliente</th>
                        <th>Documento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){--
            $('#clientes').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('clientes.datatable') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'Nombre_Cliente', name: 'Nombre_Cliente'},
                {data: 'Documento', name: 'Documento'},
                {data: 'acciones', name: 'acciones', orderable: false, searchable: false},
        ],
        "language": idioma_español
    });
        });
    </script>

@endsection