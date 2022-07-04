<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $count['auction'] = Auction::count();
        $count['user'] = User::count();
        return view('admin.pages.dashboard.index', compact('count'));
    }

    public function auction()
    {
        $data = Auction::latest()->get();
        return view('admin.pages.auction.index', compact('data'));
    }

    public function user()
    {
        $data = User::latest()->get();
        return view('admin.pages.user.index', compact('data'));
    }

    public function winner()
    {
        $data  = Auction::where('winner_id', '!=', null)->get();
        return view('admin.pages.winner.index', compact('data'));
    }
}
