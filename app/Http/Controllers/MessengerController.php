<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessengerController extends Controller
{
    public function index()
    {
        // Получаем список всех пользователей (студенты и преподаватели)
        $users = User::where('ID', '!=', Auth::id())->get();

        return view('messenger.index', compact('users'));
    }

    public function getConversation($userId)
    {
        $currentUserId = Auth::id();

        // Получаем сообщения между текущим пользователем и выбранным
        $messages = Message::where(function($query) use ($currentUserId, $userId) {
            $query->where('sender_id', $currentUserId)
                ->where('receiver_id', $userId);
        })->orWhere(function($query) use ($currentUserId, $userId) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', $currentUserId);
        })->orderBy('created_at', 'asc')->get();

        // Помечаем сообщения как прочитанные
        Message::where('sender_id', $userId)
            ->where('receiver_id', $currentUserId)
            ->where('read', 0)
            ->update(['read' => 1]);

        $receiver = User::findOrFail($userId);

        return view('messenger.conversation', compact('messages', 'receiver'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,ID',
            'message' => 'required|string|max:1000',
        ]);

        $message = new Message();
        $message->sender_id = Auth::id();
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;
        $message->save();

        return response()->json(['status' => 'success', 'message' => $message]);
    }

    public function getNewMessages($userId)
    {
        $messages = Message::where('sender_id', $userId)
            ->where('receiver_id', Auth::id())
            ->where('read', 0)
            ->orderBy('created_at', 'asc')
            ->get();

        // Помечаем сообщения как прочитанные
        if ($messages->count() > 0) {
            Message::where('sender_id', $userId)
                ->where('receiver_id', Auth::id())
                ->where('read', 0)
                ->update(['read' => 1]);
        }

        return response()->json($messages);
    }
}
