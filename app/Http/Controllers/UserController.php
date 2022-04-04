<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function visited(Request $request)
    {
        User::where('email', $request->email)->update(['is_visited' => true]);

        return redirect('/');
    }
}
