<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends BaseController
{

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("token personal")->plainTextToken
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User not Logged In Successfully',
                'token' => ""
            ], 401);
        }
    }

    public function islogged(Request $request)
    {
        $user =  auth('sanctum')->user();

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'Acceso mediante el token exitoso.',
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Su token a expirado, por favor solicite un nuevo usuario.',
                'user' => null
            ], 401);
        }
    }
}
