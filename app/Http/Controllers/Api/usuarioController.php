<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;

class usuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();

        $data = [
            'usuarios' => $usuarios,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:usuarios',
            'phone' => 'required|digits:10',
            'password' => 'required',
            'monto_credito' => 'required|numeric', // Nuevo campo monto_credito
            'motivo_credito' => 'required', // Nuevo campo motivo_credito
        ]);

        // Si la validación falla, retornar los errores
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400 
            ];
            return response()->json($data, 400);
        }

        // Crear el usuario
        $usuario = Usuario::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'monto_credito' => $request->monto_credito,
            'motivo_credito' => $request->motivo_credito,
        ]);

        // Verificar si se pudo crear el usuario
        if (!$usuario) {
            $data = [
                'message' => 'Error al crear el usuario',
                'status' => 500 
            ];
            return response()->json($data, 500);
        }

        // Retornar respuesta exitosa con el usuario creado
        $data = [
            'message' => 'Usuario creado correctamente',
            'usuario' => $usuario,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404 
            ];
            return response()->json($data, 404);
        }

        $data = [
            'usuario' => $usuario,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $usuario->delete();

        $data = [
            'message' => 'Usuario eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Validación de los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:usuarios,email,'.$usuario->id,
            'phone' => 'required|digits:10',
            'password' => 'required',
            'monto_credito' => 'required|numeric', // Nuevo campo monto_credito
            'motivo_credito' => 'required', // Nuevo campo motivo_credito
        ]);

        // Si la validación falla, retornar los errores
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Actualizar los datos del usuario
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->phone = $request->phone;
        $usuario->password = $request->password;
        $usuario->monto_credito = $request->monto_credito; // Actualizar monto_credito
        $usuario->motivo_credito = $request->motivo_credito; // Actualizar motivo_credito

        $usuario->save();

        // Retornar respuesta exitosa con el usuario actualizado
        $data = [
            'message' => 'Usuario actualizado correctamente',
            'usuario' => $usuario,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
