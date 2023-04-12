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
    // public function editMessage(Request $req)
    // {
    //     try {
    //         $userId = auth()->user()->id;
    //         $user = User::find($userId);
    //         $party = $req->get('party_id');
    //         $messageId = $req->get('id');
    //         $isMine = Message::where('user_id', $userId)->find($messageId);
    //         $userParty = $user->party()->wherePivot('user_id', $userId)->wherePivot('active', true)->find($party);
    //         dd($userParty);
    //         $validator = Validator::make($req->all(), [
    //             'content' => 'required'
    //         ]);
    //         if ($validator->fails()) {
    //             return response()->json($validator->messages(), 400);
    //         }
    //         if ($isMine && $userParty) {
    //             $updatedMessage = Message::where('id', $messageId)->update([
    //                 'content' => $req->get('content')
    //             ]);
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Message edited',
    //                 'data' => $updatedMessage
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'You cannot edit that message'
    //             ], 500);
    //         }
    //     } catch (\Throwable $th) {
    //         Log::error("Error editing message: " . $th->getMessage());

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Could not edit message'
    //         ], 500);
    //     }
    // }

    public function updateMessage(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'message' => 'regex:/^[A-Za-z0-9]+$/',
                // 'type' => [
                //     Rule::in(['fina', 'pan_pizza', 'original']),
                // ],
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $message1 = Message::find($id);

            if (!$message1) {
                return response()->json(
                    [
                        "success" => true,
                        "message" => "Message doesn't exists",
                    ],
                    404
                );
            }

            $message = $request->input('message');
            // $type = $request->input('type');

            if (isset($message)) {
                $message1->message = $message;
            }

            
            $message1->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Pizza updated",
                    "data" => $message1
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

