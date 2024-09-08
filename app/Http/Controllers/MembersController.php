<?php

namespace App\Http\Controllers;

use App\Models\MembersModel;
use Exception;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function index()
    {
        $members = MembersModel::all();
        return view('after-login.members.index')->with('members', $members);
    }

    public function isMember($phone_number)
    {
        try {
            $member = MembersModel::where('phone_number', $phone_number)->first();
            $exists = !is_null($member);

            return response()->json([
                'exists' => $exists,
                'member' => $member
            ]);
        } catch (Exception $e) {
            return false;
        }
    }
}
