<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


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

    // public function getMyMessages()
    // {
    //     try {
    //         $id = auth()->user()->id;
    //         $myMessage = DB::table('messages')->where('user_id', '=', $id)->get();
            
    //         $myMessage->party_id = $party_id;
    //         $myMessage->user_id = $user_id;
    //         $myMessage->message = $message;
    //         $newMessage->save();

    //         return response()->json(
    //             [
    //                 "success" => true,
    //                 "message" => "Message deleted",
    //                 "data" => [
    //                     'id' => $myMessage->id,
    //                     'user_id' => $myMessage->user_id,
    //                     'message' => $myMessage->message,
    //                     'party_id' => $myMessage->party_id,
    //                 ]
    //             ],
    //             200
    //         );
    //     } catch (\Throwable $th) {
    //         Log::error("Error retrieving message: " . $th->getMessage());

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Messages could not be retrieved'
    //         ], 500);
    //     }
    // }

    
}
