<?php

namespace App\Http\Controllers;

use App\Models\Auction;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.pages.dashboard.index');
    }

    public function auction()
    {
        $data = Auction::latest()->get();
        return view('admin.pages.auction.index', compact('data'));
    }
}
