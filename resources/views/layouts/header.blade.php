<nav class="navbar navbar-expand-md navbar-light bg-blue shadow-sm">

		<a href="{{ url('/') }}"><img src="{{asset('img/logo.jpg')}}" class="img-responsive" alt=""></a>
	<div class="container">

	    <a class="navbar-brand" href="{{ url('/') }}">
	        DIRECCIÓN GENERAL DE SERVICIOS DE SEGURIDAD PRIVADA -DIGESSP-
	    </a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
	        <span class="navbar-toggler-icon"></span>
	    </button>

	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	        <!-- Left Side Of Navbar -->
	        <ul class="navbar-nav mr-auto">

	        </ul>

	        <!-- Right Side Of Navbar -->
	        <ul class="navbar-nav ml-auto">
	            <!-- Authentication Links -->
	            @guest
	                <li class="nav-item">
	                    <a class="nav-link" href="{{ route('login') }}"><b>{{ __('Ingresar') }}</b></a>
	                </li>
	            @else
	            <li class="nav-item">
	                <a class="nav-link" href="{{ route('usuario') }}"><b>{{ __('Usuarios') }}</b></a>
	            </li>
	            <li class="nav-item dropdown">
	                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
	                  <b>  {{ Auth::user()->empleado->primer_nombre }} {{ Auth::user()->empleado->primer_apellido }} </b><span class="caret"></span>
	                </a>

	                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
	                	<a class="dropdown-item" href="{{ route('change_password_view') }}">
	                        {{ __('Cambiar contraseña') }}
	                    </a>

	                    <a class="dropdown-item" href="{{ route('logout') }}"
	                       onclick="event.preventDefault();
	                                     document.getElementById('logout-form').submit();">
	                        {{ __('Salir') }}
	                    </a>

	                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                        @csrf
	                    </form>
	                </div>
	            </li>
	            @endguest
	        </ul>
	    </div>
	</div>
	</nav>