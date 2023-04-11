<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartyController extends Controller
{
    public function getParty()
    {
        return "Get all users";
    }

    public function createParty()
    {
        return "Create user";
    }

    public function updateParty()
    {
        return "Update user";
    }

    public function deleteParty()
    {
        return "Delete user";
    }
}
