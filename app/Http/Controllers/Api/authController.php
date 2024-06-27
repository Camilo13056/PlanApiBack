<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'password_app' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Intentar autenticar al usuario con email y password
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Verificar password_app
            if (Hash::check($request->password_app, $user->password_app)) {
                $token = $user->createToken('authToken')->plainTextToken;
                return response()->json(['token' => $token, 'user' => $user], 200);
            } else {
                return response()->json(['message' => 'Credenciales inválidas'], 401);
            }
        }

        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }
}
