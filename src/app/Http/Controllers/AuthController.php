<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        $v = $request->validated();

        try {
            DB::beginTransaction();


            $user = User::create([
                'name' => $v['name'],
                'email' => $v['email'],
                'password' => Hash::make($v['password']),
            ]);


            DB::commit();

            event(new Registered($user));
            Auth::login($user);

            // 認証メール送信
            $user->sendEmailVerificationNotification();
            // 誘導画面(仮)
            return redirect()->route('/register-done');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('REGISTER FAILED', [
                'msg' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->withErrors(['register' => '登録でエラーが発生しました'])->withInput();
        }
    }
    // ログインフォーム
    public function loginForm()
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        $credentials =
            $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {

            return back()
                ->withErrors(['auth' => 'ログイン情報が登録されていません'])
                ->withInput();
        }

        $request->session()->regenerate();
        $user = Auth::user();

        if (!$user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }
        return redirect()->route('items.index');
    }
    public function show(Item $item)
    {
        $item->load(['images' => fn($q) => $q->orderBy('sort_order')]);
        $main = $item->images->first();
        return view('items.show', compact('item', 'main'));
    }
}
