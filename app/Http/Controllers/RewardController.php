<?php

namespace App\Http\Controllers;

use App\Models\RewardsModel;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        $reward = RewardsModel::with(['history'])
            ->where('user_id', auth()->user()->id)
            ->first();

        $reward->referral_summary = $reward->history->count();
        // dd($reward->history[0]->referral->user);
        // dd($reward);

        return view('after-login.reward.index')->with('reward', $reward);
    }
}
