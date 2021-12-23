<?php

namespace App\Http\Controllers;

use App\User;
use App\Sector;
use DataTables;
use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listado()
    {
        return view('user.listado');
    }

    public function ajax_listado()
    {
        $usuarios = User::all();
        return Datatables::of($usuarios)
                ->addColumn('action', function($usuarios){
                    if($usuarios->id != 1){
                        return '<a href="#" class="btn btn-icon btn-warning btn-sm mr-2" onclick="edita('.$usuarios->id.')">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-danger btn-sm mr-2" onclick="elimina('.$usuarios->id.', \''.$usuarios->name.'\')">
                                    <i class="flaticon2-delete"></i>
                                </a>';

                    }
                })->make(true);
    }

    public function formulario(Request $request, $idUser)
    {
        // dd($idUser);
        if($idUser != 0){
            $datosUser = User::find($idUser);
        }else{
            $datosUser = null;
        }    

        return view('user.formulario')->with(compact('datosUser'));
    }

    public function guarda(Request $request)
    {
        // dd($request->input());

        if($request->filled('userId')){
            $persona = User::find($request->userId);
        }else{
            $persona = new User();
        }

        $persona->perfil = $request->input('perfil');
        $persona->name   = $request->input('name');
        $persona->ci     = $request->input('ci');
        $persona->email  = $request->input('email');
        if($request->has('password')){
            $persona->password         = Hash::make($request->input('password'));
        }
        $persona->fecha_nacimiento = $request->input('fecha_nacimiento');
        $persona->direccion        = $request->input('direccion');
        $persona->celulares        = $request->input('celulares');
        $persona->save();

        return redirect('user/listado');
    }

    public function elimina(Request $request)
    {
        User::destroy($request->id);
        return redirect('User/listado');

    }

    public function edita(Request $request, $id)
    {
        $datosUsuario = User::findOrFail($id);
        $categorias = Categoria::all();
        return view('user.edita')->with(compact('datosUsuario', 'categorias'));                   
    }
}