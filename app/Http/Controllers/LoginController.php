<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\LoginResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        // 1. The request is already validated by LoginRequest

        try {
            // 2. Attempt to authenticate the user using the 'ctj-api' guard
            $credentials = $request->only('email', 'password');
            if (!Auth::guard('ctj-api')->attempt($credentials)) {
                return response()->json([
                    'status'  => Response::HTTP_UNAUTHORIZED,
                    'message' => 'Invalid credentials',
                ], Response::HTTP_UNAUTHORIZED);
            }

            // 3. Retrieve the authenticated user
            $user = Auth::guard('ctj-api')->user();

            // 4. Return the user data using LoginResource
            return new LoginResource($user);
        } catch (ValidationException $e) {
            return response()->json([
                'status'  => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}