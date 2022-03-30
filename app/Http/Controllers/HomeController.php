<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = Auction::latest()->get();
        return view('pages.home.index', compact('data'));
    }
}
