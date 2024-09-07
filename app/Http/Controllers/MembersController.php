<?php

namespace App\Http\Controllers;

use App\Models\MembersModel;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function index()
    {
        $members = MembersModel::all();
        return view('after-login.members.index')->with('members', $members);
    }
}
