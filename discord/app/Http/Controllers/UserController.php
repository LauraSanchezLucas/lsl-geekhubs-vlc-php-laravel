<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    // public function deleteProfile($id)
    // {
    //     try {
            
    //         $user = User::find($id);

    //         if ($user->role_id != 1) {
    //             User::destroy($id);

    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'User successfully deleted',
    //             ], 200);
    //         } else {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Admin profiles cannot be deleted'
    //             ], 400);
    //         }
    //     } catch (\Throwable $th) {
    //         Log::error("Error deleting user: " . $th->getMessage());

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'User could not be deleted'
    //         ], 500);
    //     }
    // }

}
