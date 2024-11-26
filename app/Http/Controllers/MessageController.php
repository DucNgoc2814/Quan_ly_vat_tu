<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckEmployees');
    }

    public function sendMessage(Request $request)
    {
        try {
            $employee = auth()->guard('employee')->user();

            if (!$employee) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $message = Message::create([
                'employee_id' => $employee->id,
                'message' => $request->message
            ]);

            $messageWithRelations = $message->load('employee.roleEmployee');
            broadcast(new NewMessage($messageWithRelations));

            return response()->json($messageWithRelations);
        } catch (\Exception $e) {
            // \Log::error('Message error: ' . $e->getMessage());
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }








    public function getMessages()
    {
        $messages = Message::with('employee.roleEmployee')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }
}


