<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class MessageController extends Controller
{
    public function getAllMessagesByAdmin()
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










    // public function updateMessage(Request $request){
    // {
    //         try {
    //             $user = auth()->user()->id;
    //             $user1 = DB::table('message')->where('id', '=', $user)->get();
    //             $validator = Validator::make($request->all(), [
    //                 'message' => 'string',
    //             ]);
    //             if ($validator->fails()) {
    //                 return response()->json($validator->errors(), 400);
    //             }
    //             $newuser = Message::find($user);
    //             if (!$user1) {
    //                 return response()->json(
    //                     [
    //                         "success" => true,
    //                         "message" => "Message doesn't exists",
    //                     ],
    //                     404
    //                 );
    //             }
    //         $message = $request->input('message');
            
    //         if (isNull($message)) {
    //             $newuser->message = $message;
    //         }
    //         $newuser->save();
    //         return response()->json(
    //             [
    //                 "success" => true,
    //                 "message" => "Message Updated Correctly",
    //                 "data" => $message
    //             ],
    //             200
    //         );
    //         } catch (\Throwable $th) {
    //             Log::error("Update Message error: " . $th->getMessage());
    //             return response()->json(
    //                 [
    //                     "success" => false,
    //                     "message" => "Update Message error ". ($user)
    //                 ],
    //                 Response::HTTP_INTERNAL_SERVER_ERROR
    //             );
    //         }
    //     }
    // }
}
