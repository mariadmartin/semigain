<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    // GET obtener todos los Usuarios
    public function index()
    {
        try {
            $usuarios = Usuario::all();
            return ApiResponse::success('Lista de usuarios', 200, $usuarios);
        } catch (Exception $e) {
            return ApiResponse::error('Error al obtener la lista de usuarios: ' . $e->getMessage(), 500);
        }
    }

    // POST - Creacion Usuario
    public function store(Request $request)
    {
        try {
            request()->validate([
                'nombre' => 'required',
                'apellidos' => 'required',
                'email' => 'required',
                'numero_socio' => 'required',
                'fecha_alta' => 'required',

            ]);
            $usuario = Usuario::create($request->all());
            return ApiResponse::success('Usuario creado', 200, $usuario);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            return ApiResponse::error('Error de Validacion: ', 422, $errors);
        }
    }

    // GET by ID - mostrar un usuario
    public function show(Usuario $usuario)
    {
       try {
            $usuario = Usuario::findOrFail($usuario->id);
            return ApiResponse::success('Usuario obtenido', 200, $usuario);
       } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Usuario no encontrado:  '.$e->getMessage(), 404);
       }
    }

<<<<<<< HEAD
    // PUT - Actualizar un Usuario
=======
    // PUT - actualizar usuario
>>>>>>> pistasController
    public function update(Request $request, Usuario $usuario)
    {
        try {
            $usuario = Usuario::findOrFail($usuario->id);
            request()->validate([
                'nombre' => 'required',
                'apellidos' => 'required',
                'email' => 'required',
                'numero_socio' => 'required',
                'fecha_alta' => 'required',
            ]);
            $usuario = $usuario->update($request->all());
            return ApiResponse::success('Usuario actualizada correctamente', 200, $usuario);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Usuario no encontrada ', 404);
        } catch (Exception $e) {
            return ApiResponse::error('Error: ' . $e->getMessage(), 422);
        }
    }

    public function destroy(Usuario $usuario)
    {
        try {
            $usuario = Usuario::findOrFail($usuario->id);
            $usuario->delete();
            return ApiResponse::success('Usuario borrado',200, $usuario);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Usuario no encontrada ', 404);
        }
    }
}