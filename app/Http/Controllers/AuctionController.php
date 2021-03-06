<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionBid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            if (date('Y-m-d\Th:i', strtotime('now')) > $item->end_at) {
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
        $data['is_bid'] = AuctionBid::where('user_id', Auth::user()->id)
            ->where('auction_id', $data->id)->first() ? true : false;

        $data['max_price'] = AuctionBid::where('auction_id', $data->id)
            ->orderBy('bid', 'DESC')
            ->first();

        $data['max_price'] = $data['max_price'] ? $data['max_price']['bid'] : $data->start_price;
        $data['max_price'] = (int)$data['max_price'];
        $data['max_price'] += 100;

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
        // dd(request()->all());
        $data = $this->validate($request, [
            'photo' => 'required',
            'title' => 'required',
            'description' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
            'start_price' => 'required'
        ]);

        $data['user_id'] = Auth::user()->id;
        // $data['photo'] = $request->file('photo')->store('auction');
        $data['photo'] = Storage::disk('public_uploads')->put('img/auction', $request->file('photo'));

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
            $data['photo'] = $request->file('photo')->b('auction');
        }
        Auction::where('id', $id)->update($data);
        return redirect()->back()->with(['success' => 'Berhasil memperbarui lelang']);
    }

    public function destroy($id)
    {
        Auction::where('id', $id)->delete();
        return redirect()->back()->with(['success' => 'Berhasil menghapus lelang']);
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $data = Auction::where('title', 'like', "%" . $keyword . "%")->paginate(5);

        return view('pages.home.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function bidDestroy($id)
    {
        AuctionBid::where('id', $id)->delete();
        return redirect()->back()->with(['success' => 'Berhasil menghapus penawaran lelang']);
    }

    public function memberDestroy($auctionId, $userId)
    {
        DB::table('auction_user')
            ->where('auction_id', $auctionId)
            ->where('user_id', $userId)
            ->delete();
        AuctionBid::where('auction_id', $auctionId)
            ->where('user_id', $userId)
            ->delete();
        return redirect()->back();
        return redirect()->back()->with(['success' => 'Berhasil menghapus penawaran lelang']);
    }
}
