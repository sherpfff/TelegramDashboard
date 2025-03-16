<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    public function handleWebhook($botToken)
    {
        $telegram = new Api($botToken);
        $update = $telegram->getWebhookUpdate();

        $chatId = $update->getMessage()->getChat()->getId();
        $text = $update->getMessage()->getText();

        // Логика обработки входящих сообщений
        \Log::info("Incoming message from chat ID: {$chatId}, Text: {$text}");
    }

    public function sendMessage(Request $request)
    {
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        $chatId = $request->input('chat_id');
        $text = $request->input('text');

        $response = $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $text,
        ]);

        return response()->json($response);
    }
}
