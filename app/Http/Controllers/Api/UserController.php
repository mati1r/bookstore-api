<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function createUser(CreateUserRequest $request){
        try {
            $user = User::create([
                "name"=> $request->name,
                "email"=> $request->email,
                "password" => Hash::make($request->password),
            ]);

            return response()->json([
                "status" => true,
                "message" => "User created successfuly",
                "token" => $user->createToken("API TOKEN", ["user"])->plainTextToken
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }

    public function loginUser(LoginUserRequest $request){

        try{
            if(!Auth::attempt($request->only("email","password"))){
                return response()->json([
                    "status" => false,
                    "message" => "Account with provided credentials does not exits"
                ], 401);
            }

            $user = User::where("email", $request->email)->first();

            return response()->json([
                "status"=> true,
                "message"=> "User loged in successfuly",
                "token" => $user->createToken("API TOKEN", ["user"])->plainTextToken
            ],200);
        }catch (\Exception $e){
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request){
        $user = $request->user();

        $user->tokens()->delete();

        return response()->json([
            "status"=> true,
            "message"=> "User logged out"
        ], 200);
    }

    public function changePassword(ChangePasswordRequest $request){

        try{
            $data = $request->all();
            $newPassword = $data["password"];
            $user = $request->user();

            $user->update([
                "password"=> Hash::make($newPassword),
            ]);

            return response()->json([
                "status"=> true,
                "message"=> "Password changed successfuly"
            ]);
        }catch (\Exception $e){
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }
}
