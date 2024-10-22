<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class ChatsController extends Controller
{
    public function getSMSMessages()
  {
    $messages = Message::where('type', 'sms')->get(); 
    return response()->json($messages);
  }
}
