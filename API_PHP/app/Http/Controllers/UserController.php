<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Ensure you have a User model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;


class UserController extends Controller{
    
    //método para listar todos os usuarios
    function index(){
        try{
            $user = User::all();
            return response()->json($user);
        }catch(Exception $e){
            return response()->json(['error'=> 'Server error'], 500);
        }
    }

    // método para cadastrar um usuario
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'type_user_id' => 'required|integer|exists:type_users,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type_user_id' => $request->type_user_id
            ]);
            return response()->json($user, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }

    // metodo para buscar por id
    public function show($id){
        try {
            $user = User::findOrFail($id); 
            return response()->json($user);
        } catch (Exception $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }


    public function update(Request $request, $id){
        try {
            $user = User::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'string|max:255',
                'email' => 'string|email|max:255|unique:users,email,' . $id,
                'password' => 'string|min:8',
                'type_user_id' => 'integer|exists:type_users,id'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $user->update($request->all());
            return response()->json($user);
        } catch (Exception $e) {
            return response()->json(['error' => 'User not found or update failed'], 404);
        }
    }

    // metodo para excluir um usuario
    public function destroy($id){
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => 'User not found or delete failed'], 404);
        }
    }
}
