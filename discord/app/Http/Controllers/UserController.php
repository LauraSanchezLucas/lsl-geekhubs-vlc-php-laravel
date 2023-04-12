<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // USER
    public function profile()
    {
        try {
            $user = auth()->user();
            return response()->json([
                'success' => true,
                'message' => 'Profile successfully retrieved',
                'data' => $user
            ]);
        } catch (\Throwable $th) {
            Log::error("Error retrieving user: " . $th->getMessage());
            return response()->json([
                'success' => true,
                'message' => 'User could not be retrieved'
            ], 500);
        }
    }
    public function updateProfile(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'string',
                'surname' => 'string',
                'age' => 'string|min:1|max:2',
                'direction' => 'string',
                'phone' => 'string|max:15',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $user = User::find($id);
            if (!$user) {
                return response()->json(
                    [
                        "success" => true,
                        "message" => "User doesn't exists",
                    ],
                    404
                );
            }
            $name = $request->input('name');
            $surname = $request->input('surname');
            $age = $request->input('age');
            $direction = $request->input('direction');
            $phone = $request->input('phone');
            if (isset($name)) {
                $user->name = $name;
            }
            if (isset($surname)) {
                $user->surname = $surname;
            }
            if (isset($age)) {
                $user->age = $age;
            }
            if (isset($direction)) {
                $user->direction = $direction;
            }
            if (isset($phone)) {
                $user->phone = $phone;
            }
            $user->save();
            return response()->json(
                [
                    "success" => true,
                    "message" => "User updated",
                    "data" => $user
                ],
                200
            );
        } catch (\Throwable $th) {
            Log::error("Update Profile error: " . $th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "Update Profile error " . ($user)
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    // ADMIN
    public function getAllUsers()
    {
        try {
            $users = User::query()->get();
            return response()->json([
                'success' => true,
                'message' => 'Users successfully retrieved',
                'data' => $users
            ]);
        } catch (\Throwable $th) {
            Log::error("Error retrieving users: " . $th->getMessage());

            return response()->json([
                'success' => true,
                'message' => 'Users could not be retrieved'
            ], 500);
        }
    }
    public function getUserById($id)
    {
        try {
            $users = User::query()->find($id);
            return response()->json([
                'success' => true,
                'message' => 'Profile successfully retrieved',
                'data' => $users
            ]);
        } catch (\Throwable $th) {
            Log::error("Error retrieving user: " . $th->getMessage());

            return response()->json([
                'success' => true,
                'message' => 'User could not be retrieved'
            ], 500);
        }
    }

    public function deleteProfile($id)
    {
        try {
            $user = User::find($id);
            if ($user->role_id != 1) {
                User::destroy($id);
                return response()->json([
                    'success' => true,
                    'message' => 'User successfully deleted',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Admin profiles cannot be deleted'
                ], 400);
            }
        } catch (\Throwable $th) {
            Log::error("Error deleting user: " . $th->getMessage());
            return response()->json([
                'success' => true,
                'message' => 'User could not be deleted'
            ], 500);
        }
    }
}
