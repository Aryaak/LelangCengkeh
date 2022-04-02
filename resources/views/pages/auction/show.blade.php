@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-fluid">
        <img height="100%" width="100%" src="{{ asset($data->photo) }}" class="mb-3">
        <hr>
        <h3 class="mb-2 fw-bold">{{ $data->title }}</h3>
        <p class="mb-3">{{ $data->description }}</p>
        <hr>
        <h4 class="fw-bolder">Informasi</h4>
        <table class="w-100 mb-4" cellpadding="4">
            <tr class="border-bottom">
                <td>Harga awal</td>
                {{-- <td>:</td> --}}
                <td class="text-secondary">Rp. {{ number_format($data->start_price, 0, ',', ',') }}</td>
            </tr>
            <tr class="border-bottom">
                <td>Dimulai Pada</td>
                {{-- <td>:</td> --}}
                <td class="text-secondary">{{ $data->start_at }} </td>
            </tr>
            <tr class="border-bottom">
                <td>Berakhir pada</td>
                {{-- <td>:</td> --}}
                <td class="text-secondary">{{ $data->end_at }} </td>
            </tr>
        </table>

        @if (!$data->is_ended)
        @if (!$data->is_joined)
        <form action="{{ route('auction.join') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="auction_id" value="{{ $data->id }}">
            <button class="btn btn-success w-100">Gabung lelang</button>
        </form>
        @else
        <button data-bs-toggle="modal" data-bs-target="#leaveModal" class="btn btn-danger w-100">Keluar
            lelang</button>
        @endif
        @endif

        <!-- Leave Modal -->
        <div class="modal fade" id="leaveModal" tabindex="-1" aria-labelledby="leaveModalLabel" aria-hidden="true">
            <form action="{{ route('auction.leave') }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="auction_id" value="{{ $data->id }}">
                {{-- <div class="modal-dialog modal-dialog-centered modal-lg"> --}}
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="leaveModalLabel">Keluar lelang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah anda yakin ingin keluar lelang?</p>
                            <p>Semua penawaran harga anda akan dihapus</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Keluar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @if ($data->is_ended)
        <h3 class="mt-5 fw-bolder">Pemenang</h3>
        <section class="row">
            @if ($data->winner)
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title fw-bolder">{{ $data->winner->name }}</h5>
                        <p class="card-text">Dengan harga Rp.
                            {{ number_format($data->selling_price, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            @else
            <p>Tidak ada pemenang</p>
            @endif
        </section>
        @endif
        <h3 class=" mt-5 fw-bold">Penawaran</h3>
        <section class="row gap-2">
            @forelse ($data->bids as $item)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->user->name }}</h5>
                        <p class="card-text">Rp. {{ number_format($item->bid, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            @empty
            <p>Belum ada penawaran</p>
            @endforelse
        </section>
        @if (\Carbon\Carbon::now() > $data->start_at)
        @if ($data->is_joined && !$data->is_ended)
        <form action="{{ route('auction.bid') }}" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="auction_id" value="{{ $data->id }}">
            <div class="form-group">
                <label for="bid" class="mb-2">Harga penawaran</label>
                <input min="{{ $data->start_price }}" class="form-control mb-2" type="number" name="bid"
                    placeholder="Masukan harga penawaran anda...">
            </div>
            <button type="submit" class="btn btn-primary w-100">Kirim</button>
        </form>
        @endif
        @else
        <p>Lelang masih belum dimulai</p>
        @endif



        <h3 class=" mt-5 fw-bold">Penawar</h3>
        <section class="row gap-2">
            @forelse ($data->members as $item)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text">Bergabung pada {{ $item->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
            @empty
            <p>Belum ada penawar</p>
            @endforelse

        </section>
    </div><!-- /.container-fluid -->
</div>
@endsection
