<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
    public function createGame(Request $request)
    {
        try {
            $party_id = $request->input('party_id');
            $user_id = auth()->user()->id;
            $name = $request->input('name');
            $platform = $request->input('platform');

            $newGame = new Game();
            $newGame->party_id = $party_id;
            $newGame->user_id = $user_id;
            $newGame->name = $name;
            $newGame->platform = $platform;
            $newGame->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Game Created",
                    "data" => $newGame
                ],
                200
            );
        } catch (\Throwable $th) {
            Log::error("Creating game Error: " . $th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error creating game"
                ],
                500
            );
        }
    }
}
