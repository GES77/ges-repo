<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OTP;
use App\Services\TelegramService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Symfony\Component\Uid\NilUlid;

class AuthController extends Controller
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    public function login()
    {
        if (!empty(Auth::check())) {
            return redirect('panel/user');
        }
        return view('auth.login');
    }

    public function auth_login(Request $request)
    {
        $remember = $request->filled('remember');

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $remember)) {
            $otp = rand(100000, 999999);
            $user = Auth::user();
            $user->otp = Hash::make($otp);
            $user->otp_created_at = now();
            /** @var \App\Models\User $user **/
            $user->save();

            $this->telegramService->sendOtp($user->telegram_chat_id, $otp);
            Session::put('auth_otp', $user->id);
            Session::forget('otp_verified');

            return redirect()->route('auth.verify');
        } else {
            return redirect()->back()->with('error', 'Maaf, username atau password yang telah anda masukan salah!');
        }
    }

    public function showVerifyForm()
    {
        if (!Session::has('auth_otp')) {
            return redirect()->route('login');
        }

        return view('auth.verify-otp');
    }

    public function verify(Request $request)
    {
        $userId = Session::get('auth_otp');
        $user = User::find($userId);

        if ($user) {
            $otpValidUntil = $user->otp_created_at->addMinutes(2); // OTP berlaku selama 2 menit

            if (now()->greaterThan($otpValidUntil)) {
                return redirect()->back()->with('error', 'Masa berlaku kode OTP anda telah habis!');
            }

            if (Hash::check($request->otp, $user->otp)) {
                Session::put('otp_verified', true);
                Session::forget('auth_otp');
                return redirect('panel/user');
            }
        }

        return redirect()->back()->with('error', 'OTP yang anda masukan salah!');
    }

    public function resendOtp(Request $request)
    {
        $userId = Session::get('auth_otp');
        $user = User::find($userId);

        if ($user) {
            $otp = rand(100000, 999999);
            $user->otp = Hash::make($otp);
            $user->otp_created_at = now();
            $user->save();

            $this->telegramService->sendOtp($user->telegram_chat_id, $otp);

        }

        return redirect()->route('auth.verify')->with('success', 'Kode OTP baru telah dikirim');
    }

    public function logout()
    {
        $user = Auth::user(); // Ambil pengguna yang sedang masuk
        if ($user) {
            $user->otp = null; // Set token OTP ke null
            $user->otp_created_at = null;
            $user->remember_token = null;
            /** @var \App\Models\User $user **/
            $user->save(); // Simpan perubahan ke database
        }

        Auth::logout(); // Lakukan logout pengguna
        return redirect('/'); // Redirect ke halaman utama
    }
}
