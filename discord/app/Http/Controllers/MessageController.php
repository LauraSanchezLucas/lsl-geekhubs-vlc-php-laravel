<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function createMessage(Request $request)
    {
        try {
            $party_id = $request->input('party_id');
            $user_id = auth()->user()->id;
            $message = $request->input('message');

            $newMessage = new Message();
            $newMessage->party_id = $party_id;
            $newMessage->user_id = $user_id;
            $newMessage->message = $message;
            $newMessage->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Message Created",
                    "data" => $newMessage
                ],
                200
            );
        } catch (\Throwable $th) {
            Log::error("Creating message Error: " . $th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error creating Message"
                ],
                500
            );
        }
    }
    public function getAllMessages()
    {
        try {
            $messages = Message::query()->get();

            return response()->json([
                'success' => true,
                'message' => 'Messages successfully retrieved',
                'data' => $messages
            ]);
        } catch (\Throwable $th) {
            Log::error("Error retrieving message: " . $th->getMessage());

            return response()->json([
                'success' => true,
                'message' => 'Messages could not be retrieved'
            ], 500);
        }
    }

    public function getMessagesByParty($id)
    {
        try {
            $messages = Message::where('party_id', $id)->get();
            return response()->json([
                'success' => true,
                'message' => 'Messages successfully retrieved',
                'data' => $messages
            ]);
        } catch (\Throwable $th) {
            Log::error("Error retrieving message: " . $th->getMessage());

            return response()->json([
                'success' => true,
                'message' => 'Messages could not be retrieved'
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
    // public function deleteUserByAdmin($id){
    //     try {
    //         User::destroy($id);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'User deleted'
    //         ],200);
    //     } catch (\Throwable $th){
    //         return response()->json([ 
    //             'success' => false,
    //             'message' => $th->getMessage()],500);
    //     }  
    // }
    // public function deleteMessage($id)
    // {
    //     try {
    //         $userId = auth()->user()->id;
    //         $user = User::find($userId);
    //         $party = Message::where('user_id', $userId)->select('party_id')->first();
    //         $userParty = $user->party()->wherePivot('user_id', $userId)->wherePivot('active', true)->wherePivot('party_id', $party->party_id)->first();

    //         $isMine = Message::where('user_id', $userId)->find($id);
    //         if ($isMine && $userParty) {
    //             Message::where('id', $id)->delete();
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Message deleted'
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'You cannot delete that message'
    //             ], 500);
    //         }
    //     } catch (\Throwable $th) {
    //         Log::error("Error deleting message: " . $th->getMessage());

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Could not delete message'
    //         ], 500);
    //     }
    // }
    public function deleteMessage(Request $request, $id)
    {
        try {

            Message::destroy($id);

            // otra manera de hacerlo
            // Pizza::query()->where('id', $id)->where('is_active', 0)->delete();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Message deleted"
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }

    
}
