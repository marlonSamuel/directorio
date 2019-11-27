@extends('layouts.app')

@section('content')
<div class="container">
	@yield('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Usuarios') }} 
                	<a href="{{ route('register') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Nuevo</a>
                </div>
                	
                <div class="card-body">
                	<table id="users" class="table table-hover">
                		<thead>
                			<tr>
                				<th scope="col">Correo</th>
                				<th scope="col">Empleado</th>
                                <th scope="col">Acciones</th>
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
        $('#users').DataTable({
            "serverSide": true,
            "ajax": "{{ url('api/users_list') }}",
            "columns": [
                {data: 'email'},
                {data: 'nombre_completo'},
                {
                'data': null,
                'orderable': false,
                    'render': function (data, type, row) {
                        return '<button id="' + row.id + '" class="btn btn-primary btn-sm" onclick="edit(this)" data-toggle="tooltip" data-placement="top" title="Editar registro"><i class="fa fa-pencil"></i></button> <button id="' + row.id + '" class="btn btn-danger btn-sm" onclick="deleteItem(this)" data-toggle="tooltip" data-placement="top" title="Eliminar registro"><i class="fa fa-trash-o"></i></button>'
                    }
                }
            ],

            "language": idioma_spanish,

        });
    } );

    function edit (obj) {
        var id = $(obj).attr('id');
        window.location.href = "/users/" + id + "/edit";
    }

    function deleteItem (obj) {
        var id = $(obj).attr('id');

        var r = confirm("Esta seguro de eliminar empleado!"); 
        if (r) { 
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax(
                {
                    url: "/users/"+parseInt(id),
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function (r){
                        if(r.error){
                          window.location.href = "/usuario";
                        }else{
                            $('#users').DataTable().ajax.reload();
                            window.location.href = "/usuario";
                        }
                    }
                });
        }
    }
</script>
@endsection


