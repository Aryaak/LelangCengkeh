<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionBid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuctionController extends Controller
{
    public function __construct()
    {
        $this->checkWinner();
    }

    private function checkWinner()
    {
        $data = Auction::where('is_ended', false)->get();
        foreach ($data as $item) {
            if (Carbon::now() > $item->end_at) {
                $bid = AuctionBid::where('auction_id', $item->id)->orderBy('bid', 'DESC')->first();
                if ($bid) {
                    Auction::where('id', $item->id)->update([
                        'winner_id' => $bid->user_id,
                        'selling_price' => $bid->bid,
                        'is_ended' => true
                    ]);
                }
            }
        }
    }

    public function adminShow($id)
    {
        $data = Auction::find($id);
        return view('admin.pages.auction.show', compact('data'));
    }

    public function show($id)
    {
        $data = Auction::find($id);
        $data['is_joined'] = DB::table('auction_user')
            ->where('auction_id', $data->id)
            ->where('user_id', Auth::user()->id)
            ->first();
        return view('pages.auction.show', compact('data'));
    }

    public function join(Request $request)
    {
        $input = $request->except('_token');
        DB::table('auction_user')->insert($input);
        return redirect()->back();
    }

    public function leave(Request $request)
    {
        DB::table('auction_user')
            ->where('auction_id', $request->auction_id)
            ->where('user_id', $request->user_id)
            ->delete();
        AuctionBid::where('auction_id', $request->auction_id)
            ->where('user_id', $request->user_id)
            ->delete();
        return redirect()->back();
    }

    public function bid(Request $request)
    {
        $data = $this->validate($request, [
            'auction_id' => 'required',
            'user_id' => 'required',
            'bid' => 'required',
        ]);

        AuctionBid::create($data);

        return redirect()->back();
    }

    public function store(Request $request)
    {

        $data = $this->validate($request, [
            'photo' => 'required',
            'title' => 'required',
            'description' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
            'start_price' => 'required'
        ]);

        $data['user_id'] = Auth::user()->id;
        $data['photo'] = $request->file('photo')->store('auction');
        Auction::create($data);

        return redirect()->back()->with(['success' => 'Lelang baru berhasil ditambahkan']);
    }

    public function update($id, Request $request)
    {
        $data = $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
            'start_price' => 'required'
        ]);

        $data['user_id'] = Auth::user()->id;
        if ($request->file('photo')) {
            $data['photo'] = $request->file('photo')->store('auction');
        }
        Auction::where('id', $id)->update($data);
        return redirect()->back()->with(['success' => 'Berhasil memperbarui lelang']);
    }

    public function destroy($id)
    {
        Auction::where('id', $id)->delete();
        return redirect()->back()->with(['success' => 'Berhasil menghapus lelang']);
    }
}
