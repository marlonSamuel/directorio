@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar') }}</div>

                <div class="card-body">
                    <form action="{{ url('users', [$user->id]) }}" method="POST" autocomplete="off">
                        <input name="_method" type="hidden" value="PUT">
                        @csrf

                        <div class="form-group row">
                            <label for="empleado_id" class="col-md-4 col-form-label text-md-right">{{ __('Empleado') }}</label>

                            <div class="col-md-6">
                                <select id="empleado_id" type="text" class="form-control @error('empleado_id') is-invalid @enderror" name="empleado_id">
                                    <option value=""><--- seleccione empleado ---></option>
                                    @foreach ($empleados as $empleado)
                                        <option value="{{$empleado['id']}}" {{$user->empleado_id==$empleado['id'] ? 'selected' : ''}}>{{$empleado['primer_nombre'].' '.$empleado['primer_apellido']}} </option>
                                    @endforeach
                                </select>
                                
                                <!--<input id="empleado_id" type="text" class="form-control @error('empleado_id') is-invalid @enderror" name="empleado_id" value="{{ old('empleado_id') }}" required autocomplete="empleado"> -->

                                @error('empleado_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electronico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar') }}
                                </button>
                                <a href="{{ route('usuario') }}" class="btn btn-danger">
                                    {{ __('Cancelar') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
