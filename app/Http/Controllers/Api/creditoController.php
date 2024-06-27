<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Credito;
use Illuminate\Support\Facades\Validator;

class creditoController extends Controller
{
    public function index()
    {
        $creditos = Credito::all();

        if ($creditos->isEmpty()) {
            $data = [
                'message' => 'No hay créditos registrados',
                'status' => 200
            ];
            return response()->json($data, 200);
        }

        return response()->json($creditos, 200);
    }

    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $validator = Validator::make($request->all(), [
            'monto' => 'required|numeric',
            'motivo' => 'required|string|max:255',
        ]);

        // Si la validación falla, retornar los errores
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Crear el crédito
        $credito = Credito::create([
            'monto' => $request->monto,
            'motivo' => $request->motivo,
        ]);

        if (!$credito) {
            return response()->json([
                'message' => 'Error al crear el crédito',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'message' => 'Crédito creado correctamente',
            'credito' => $credito,
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        $credito = Credito::find($id);

        if (!$credito) {
            return response()->json([
                'message' => 'Crédito no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'credito' => $credito,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        // Buscar el crédito por ID
        $credito = Credito::find($id);

        // Verificar si el crédito existe
        if (!$credito) {
            return response()->json([
                'message' => 'Crédito no encontrado',
                'status' => 404
            ], 404);
        }

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'monto' => 'required|numeric',
            'motivo' => 'required|string|max:255',
        ]);

        // Si la validación falla, retornar los errores
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Actualizar los datos del crédito
        $credito->monto = $request->input('monto');
        $credito->motivo = $request->input('motivo');

        $credito->save();

        // Retornar la respuesta exitosa con el crédito actualizado
        return response()->json([
            'message' => 'Crédito actualizado correctamente',
            'credito' => $credito,
            'status' => 200
        ], 200);
    }

    public function destroy($id)
    {
        $credito = Credito::find($id);

        if (!$credito) {
            return response()->json([
                'message' => 'Crédito no encontrado',
                'status' => 404
            ], 404);
        }

        $credito->delete();

        return response()->json([
            'message' => 'Crédito eliminado correctamente',
            'status' => 200
        ], 200);
    }
}

