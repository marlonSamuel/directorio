<?php

namespace App\Http\Controllers\User;

use App\Empleado;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['users_list']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('auth.User');
    }

    public function changePasswordView()
    {
        return view('auth.changePassword');
    }

    public function users_list()
    {
        $users = User::with('empleado')->get();

        foreach ($users as $user) {
            $user['nombre_completo'] = $user->empleado->primer_nombre.' '.$user->empleado->segundo_nombre.' '.$user->empleado->primer_apellido.' '.$user->empleado->segundo_apellido;
        }

        return datatables()->collection($users)
                           ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $empleados = Empleado::all();
        return view('auth.edit',compact('empleados','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
               'empleado_id' => 'required|integer|unique:users,empleado_id,' . $user->id,
               'email' => 'email|unique:users,email,' . $user->id,
            ]; 

        $this->validate($request, $rules);

        $user->email = $request->email;
        $user->empleado_id = $request->empleado_id;

         try {
            $user->save();
            toastr()->success('Empleado editado con exito correctamente!');

            return redirect('/usuario');

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());

            return redirect()
                ->back()
                ->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user_auth = Auth::user();
        if($user->id === $user_auth->id){
            toastr()->error('no se puede eliminar a si mismo!');
             return [
                'mensaje' => 'no se puede eliminar a si mismo!',
                'error' => false
            ]; 
        }
         try {
            $user->delete();
            toastr()->success('usuario eliminado correctamente!');
             return [
                'mensaje' => 'usuario eliminado correctamente!',
                'error' => false
            ];

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
             return [
                'mensaje' => 'no se pudo eliminar usuario!',
                'error' => true
            ];
        }
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'old_password'=>'required',
            'password' => 'required|string|confirmed',
        ];


        $this->validate($request,$rules);

        if (Hash::check($request->password, $user->password)) {
            toastr()->error('La contraseña actual no puede ser igual a la nueva contraseña!');
            return redirect('/change_password_view');
        }

        if (Hash::check($request->old_password, $user->password)) { 
            $user->password = bcrypt($request->password);
            $user->save();
            toastr()->success('La contraseña ah sido cambiada correctamente, cerrando sesión!');

            Auth::logout();
            return redirect('/login');

        } else {
            toastr()->error('La contraseña anterior es incorrecta!');
            return redirect('/change_password_view');
        }

    }
}
