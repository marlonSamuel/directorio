@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">DIRECTORIO 
                  @auth
                     <a href="{{ route('empleados.create') }}" class="btn btn-success btn-sm" style="color:#fff">Nuevo registro</a>
                  @endauth 
               </div>

                <div class="card-body">
                    <table id="empleados" class="table table-hover small">
                        <thead>
                            <tr>
                                <th>cui</th>
                                <th>Empleado</th>
                                <th>Departamento</th>
                                <th>Extensión</th>
                                <th width="120px">&nbsp;</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function() {
        $('#empleados').DataTable({
            "serverSide": true,
            "ajax": "{{ url('api/empleados_list') }}",
            "columns": [
                {data: 'cui'},
                {data: 'nombre_completo'},
                {data: 'departamento.nombre'},
                {data: 'extension'},
                {
                'data': null,
                'orderable': false,
                    'render': function (data, type, row) {
                        return '@auth <button id="' + row.id + '" class="btn btn-primary btn-sm" onclick="edit(this)" data-toggle="tooltip" data-placement="top" title="Editar registro"><i class="fa fa-pencil"></i></button> <button id="' + row.id + '" class="btn btn-danger btn-sm" onclick="deleteItem(this)" data-toggle="tooltip" data-placement="top" title="Eliminar registro"><i class="fa fa-trash-o"></i></button> @endauth '
                    }
                }
            ],

            "language": idioma_spanish,

        });

    } );

     function edit (obj) {
        var id = $(obj).attr('id');
        window.location.href = "/empleados/" + id + "/edit";
    }

     function deleteItem (obj) {
        var id = $(obj).attr('id');

        var r = confirm("Esta seguro de eliminar empleado!"); 
        if (r) { 
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax(
                {
                    url: "/empleados/"+parseInt(id),
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function (r){
                        if(r.error){
                          window.location.href = "/";
                        }else{
                            $('#empleados').DataTable().ajax.reload();
                            window.location.href = "/";
                        }
                    }
                });
        }
    }



</script>
@endsection
