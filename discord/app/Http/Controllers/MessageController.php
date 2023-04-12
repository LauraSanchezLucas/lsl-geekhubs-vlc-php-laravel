<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
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

    public function deleteMessage(Request $request, $id)
    {
        try {
            Message::destroy($id);
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
    public function updateMessage(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'message' => 'string',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $newMessage = Message::find($id);
            if (!$newMessage) {
                return response()->json(
                    [
                        "success" => true,
                        "message" => "Message doesn't exists",
                    ],
                    404
                );
            }
            $message = $request->input('message');
            if (isset($message)) {
                $newMessage->message = $message;
            }
            $newMessage->save();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Message updated",
                    "data" => $newMessage
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
