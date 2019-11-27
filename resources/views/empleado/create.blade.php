@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item active">Nuevo</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
                <div class="col-md-6 offset-md-3">
                  <div class="card">
                    <div class="card-header">
                      <div class="col-sm-12">
                        <h2><span class="badge badge-libreria">Nuevo registro <small>Asignación de extensión</small></span></h2>
                      </div><!-- /.col -->
                    </div>
                    <div class="card-body">
                        <form action="{{ route('empleados.store') }}" method="POST">
                           @csrf
                           <div class="row">
                            <div class="form-group {{ $errors->has('cui') ? ' is-invalid' : '' }} col-md-6">
                                  <label for="cui" class="control-label">Cui</label>
                                  <input type="text" class="form-control {{ $errors->has('cui') ? ' is-invalid' : '' }}" name="cui" value="{{ old('cui') }}">
                                  @if ($errors->has('cui'))
                                      <span class="invalid-feedback" role="alert">
                                          <span>{{ $errors->first('cui') }}</span>
                                      </span>
                                  @endif
                              </div>
                              <div class="form-group {{ $errors->has('extension') ? ' is-invalid' : '' }} col-md-6">
                                  <label for="extension" class="control-label">Extensión</label>
                                  <input type="text" class="form-control {{ $errors->has('extension') ? ' is-invalid' : '' }}" name="extension" value="{{ old('extension') }}">
                                  @if ($errors->has('extension'))
                                      <span class="invalid-feedback" role="alert">
                                          <span>{{ $errors->first('extension') }}</span>
                                      </span>
                                  @endif
                              </div>
	                            <div class="form-group {{ $errors->has('primer_nombre') ? ' is-invalid' : '' }} col-md-6">
	                                <label for="primer_nombre" class="control-label">Primer nombre</label>
	                                <input type="text" class="form-control {{ $errors->has('primer_nombre') ? ' is-invalid' : '' }}" name="primer_nombre" value="{{ old('primer_nombre') }}">
	                                @if ($errors->has('primer_nombre'))
	                                    <span class="invalid-feedback" role="alert">
	                                        <span>{{ $errors->first('primer_nombre') }}</span>
	                                    </span>
	                                @endif
	                            </div>
	                            <div class="form-group {{ $errors->has('segundo_nombre') ? ' is-invalid' : '' }} col-md-6">
	                                <label for="segundo_nombre" class="control-label">Segundo nombre</label>
	                                <input type="text" class="form-control {{ $errors->has('segundo_nombre') ? ' is-invalid' : '' }}" name="segundo_nombre" value="{{ old('segundo_nombre') }}">
	                                @if ($errors->has('segundo_nombre'))
	                                    <span class="invalid-feedback" role="alert">
	                                        <span>{{ $errors->first('segundo_nombre') }}</span>
	                                    </span>
	                                @endif
	                            </div>
                           </div>
                           <div class="row">
                           		
                            <div class="form-group {{ $errors->has('primer_apellido') ? ' is-invalid' : '' }} col-md-6">
                                <label for="primer_apellido" class="control-label">Primer apellido</label>
                                <input type="text" class="form-control {{ $errors->has('primer_apellido') ? ' is-invalid' : '' }}" name="primer_apellido" value="{{ old('primer_apellido') }}">
                                @if ($errors->has('primer_nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('primer_apellido') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('segundo_apellido') ? ' is-invalid' : '' }} col-md-6">
                                <label for="segundo_apellido" class="control-label">Segundo apellido</label>
                                <input type="text" class="form-control {{ $errors->has('segundo_apellido') ? ' is-invalid' : '' }}" name="segundo_apellido" value="{{ old('segundo_apellido') }}">
                                @if ($errors->has('segundo_apellido'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('segundo_apellido') }}</span>
                                    </span>
                                @endif
                            </div>
                           </div>

                           <div class="row">
                           		
                            <div class="form-group {{ $errors->has('departamento_id') ? ' is-invalid' : '' }} col-md-6">
                                <label for="departamento_id" class="control-label">Departamento</label>

                                <select id="departamento_id" type="text" class="form-control @error('departamento_id') is-invalid @enderror" name="departamento_id">
                                    <option value=""><--- seleccione departamento ---></option>
                                    @foreach ($departamentos as $depto)
                                        <option value="{{$depto['id']}}">{{$depto['nombre']}} </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('departamento_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('departamento_id') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('cargo') ? ' is-invalid' : '' }} col-md-6">
                                <label for="cargo" class="control-label">Cargo</label>
                                <input type="text" class="form-control {{ $errors->has('cargo') ? ' is-invalid' : '' }}" name="cargo" value="{{ old('cargo') }}">
                                @if ($errors->has('cargo'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('cargo') }}</span>
                                    </span>
                                @endif
                            </div>
                           </div>
                           
                            <div class="form-group">
                                 <button type="submit" class="btn btn-primary">Guardar</button>
                                  <a href="{{ url('/') }}" class="btn btn-danger">
                                      {{ __('Cancelar') }}
                                  </a>
                            </div>
                        </form>
                    </div>
                </div><!-- /.container-fluid -->    
                </div>
          </div>
    </section>
    <!-- /.content -->
@endsection

