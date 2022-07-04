<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $usuario = User::where('email', $request->email)->first();
        if (!$usuario)
        {
            return response()->json([
                'success' => false,
                'message' => 'usuario invalido',
                
            ], 400);

        }
        if (Hash::check($request->password,$usuario->password )) {
            $key = env('JWT_SECRET', '');
            $time = time();
            $token = array(
                'iat' => $time, // Tiempo que inició el token
                'exp' => $time + (1200 * 60), // Tiempo que expirará el token (+1 hora)
                'data' => [ // información del usuario
                    'name' => $usuario->name,
                    'email' => $usuario->email,
                    'rol' => $usuario->rol,
                ]
            );
            $jwt = JWT::encode($token, $key,'HS256');
            return response()->json([
                'success' => true,
                'token' => $jwt,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Credenciales invalidas.',
                'username' => $request->username,
            ], 400);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return User::all();
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
      
			//$input = $request->all();
			//User::create([
			//	'name'=> $request->name,
              //  'email'=> $input[]
            //]);

            return User::create($request->all());
     		//return view("usuarios.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $user = User::findOrFail($id);
            $user->update($request->all());
            return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $user=User::findOrFail($id); 
         $user->delete();
       return $user;
    
    }
}
