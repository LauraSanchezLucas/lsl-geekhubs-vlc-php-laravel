<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PartyController extends Controller
{
    public function createParty(Request $request)
    {
        try {
            $game_id = $request->input('game_id');
            $name = $request->input('name');
            $rules = $request->input('rules');

            $newParty = new Party();
            $newParty->game_id = $game_id;
            $newParty->name = $name;
            $newParty->rules = $rules;
            $newParty->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Party Created",
                    "data" => $newParty
                ],
                200
            );
        } catch (\Throwable $th) {
            Log::error("Creating party Error: " . $th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error creating party"
                ],
                500
            );
        }
    }

    public function getPartyByGame($id)
    {
        try {
            
            $parties = Party::where('game_id', $id)->get();
            return response()->json([
                'success' => true,
                'message' => 'Parties found',
                'data' => $parties
            ]);
        } catch (\Throwable $th) {
            Log::error("Error getting parties: " . $th->getMessage());

            return response()->json([
                'success' => true,
                'message' => 'Could not get parties'
            ], 500);
        }
    }

    // public function joinPartyById($id)
    // {
    //     try {
    //         $userId = auth()->user()->id;
    //         $party = Party::find($id);
    //         if (!$party) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Party does not exist'
    //             ], 500);
    //         }
    //         $active = $party->user()->find($userId);
    //         $existing = $party->user()->find($userId);
    //          if ($active && $party) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'You already are in that party',
    //             ]);
    //         } else if ($existing && $party) {
    //             $party->user()->updateExistingPivot($userId, ['owner' => false, 'active' => true]);
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Party re-joined',
    //             ]);
    //         } else {
    //             $party->user()->attach($userId, ['owner' => false, 'active' => true]);
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Party joined',
    //             ]);
    //         }
    //     } catch (\Throwable $th) {
    //         Log::error("Error joining party: " . $th->getMessage());

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Could not join party'
    //         ], 500);
    //     }
    // }

}
