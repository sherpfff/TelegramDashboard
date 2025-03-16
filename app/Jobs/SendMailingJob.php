<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Telegram\Bot\Api;

class SendMailingJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $chatId;
    protected $message;

    public function __construct($chatId, $message)
    {
        $this->chatId = $chatId;
        $this->message = $message;
    }

    public function handle()
    {
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        $telegram->sendMessage([
            'chat_id' => $this->chatId,
            'text' => $this->message,
        ]);
    }
}
