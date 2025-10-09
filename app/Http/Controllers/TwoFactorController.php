<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\EmailTwoFactorCode;

/**
 * Controller for email-based 2FA
 */
class TwoFactorController extends Controller
{
    public function index()
    {
        // Show the 2FA code input form
        return view('auth.2fa');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user(); 

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->email_2fa_code === $request->code && $user->email_2fa_expires_at->isFuture()) {
            $user->email_2fa_code = null;
            $user->email_2fa_expires_at = null;
            $user->save();

            return redirect('/dashboard');
        }

        return back()->withErrors(['code' => 'The code is invalid or expired.']);
    }

    public static function generateCode()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user) return;

        $user->email_2fa_code = rand(100000, 999999);
        $user->email_2fa_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        $user->notify(new EmailTwoFactorCode);
    }
}
