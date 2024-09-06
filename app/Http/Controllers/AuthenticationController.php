<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\RewardsModel;
use Illuminate\Http\Request;
use App\Models\ReferralsModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\RewardHistoriesModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('authentication.login');
    }

    private function generateUniqueReferralCode()
    {
        do {
            $code = strtoupper(substr(md5(mt_rand()), 0, 6));
        } while (User::where('referral_code', $code)->exists());

        return $code;
    }

    public function cekLogin(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        if ($validated->fails()) {
                $this->alert(
                    'Sign in Failed',
                    'Email atau Password Salah',
                    'error'
                );

            return redirect()->back();
        } else {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $this->alert(
                    'Sign in',
                    'Sign in Successfuly',
                    'success'
                );

                return redirect()->intended('reward');
            }

            $this->alert(
                'Sign in Failed',
                'Email atau Password Salah',
                'error'
            );

            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();

        Session::invalidate();

        $this->alert(
            'Logout Successfuly',
            'Redict to login',
            'success'
        );

        return redirect()->route('login');
    }
}
