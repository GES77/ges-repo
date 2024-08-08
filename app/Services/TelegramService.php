<?php

namespace App\Services;

use Telegram\Bot\Api;
use Illuminate\Support\Facades\Auth;

class TelegramService
{
    protected $telegram;

    public function __construct()
    {
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }

    public function sendOtp($chatId, $otp)
    {
        $user = Auth::user()->nama;
        $message = "Halo,\n\n" .
            "Berikut adalah Kode OTP (One-Time Password) yang Anda butuhkan untuk mengakses akun *{$user}*:\n\n" .
            "*Kode OTP: {$otp}*\n\n" .
            "Kode ini berlaku hanya untuk satu kali penggunaan dan berlaku selama 2 menit. Mohon untuk tidak membagikannya kepada orang lain demi menjaga keamanan akun Anda.\n" .
            "Jika Anda tidak merasa melakukan permintaan ini, harap segera hubungi tim dukungan teknis kami.\n\n" .
            "Terima kasih";
        $chatId = env('TELEGRAM_CHAT_ID');
        return $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'Markdown'
        ]);
    }
}
