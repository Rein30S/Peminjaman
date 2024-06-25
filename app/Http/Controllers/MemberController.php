<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.member.member', compact('users'));
    }
}