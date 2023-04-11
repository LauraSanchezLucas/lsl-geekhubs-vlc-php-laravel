<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function getMessage()
    {
        return "Get all users";
    }

    public function createMessage()
    {
        return "Create user";
    }

    public function updateMessage()
    {
        return "Update user";
    }

    public function deleteMessage()
    {
        return "Delete user";
    }
}
