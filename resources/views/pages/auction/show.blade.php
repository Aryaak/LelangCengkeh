@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-fluid">
        <img height="300" src="{{asset($data->photo)}}" class="mb-3">
        <h3 class="mb-2">{{$data->title}}</h3>
        <p class="mb-3">{{$data->description}}</p>
        <p>Harga awal: Rp. {{number_format( $data->start_price, 0, ',', '.')}} </p>
        <p>Dimulai pada: {{$data->start_at}}</p>
        <p>Berakhir pada: {{$data->end_at}} </p>
        @if ( !$data->is_ended)
        @if (!$data->is_joined)
        <form action="{{route('auction.join')}}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="auction_id" value="{{$data->id}}">
            <button class="btn btn-success">Gabung lelang</button>
        </form>
        @else
        <button data-bs-toggle="modal" data-bs-target="#leaveModal" class="btn btn-danger">Keluar lelang</button>
        @endif
        @endif

        <!-- Leave Modal -->
        <div class="modal fade" id="leaveModal" tabindex="-1" aria-labelledby="leaveModalLabel" aria-hidden="true">
            <form action="{{route('auction.leave')}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="auction_id" value="{{$data->id}}">
                <div class="modal-dialog  modal-lg">
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
        <h3 class=" mt-5">Pemenang</h3>
        <section class="row">
            @if ($data->winner)
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$data->winner->name}}</h5>
                        <p class="card-text">Dengan harga Rp. {{number_format($data->selling_price, 0, ',', '.')}}</p>
                    </div>
                </div>
            </div>
            @else
            <p>Tidak ada pemenang</p>
            @endif
        </section>
        @endif
        <h3 class=" mt-5">Penawaran</h3>
        <section class="row">
            @forelse ($data->bids as $item)
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$item->user->name}}</h5>
                        <p class="card-text">Rp. {{number_format($item->bid, 0, ',', '.')}}</p>
                    </div>
                </div>
            </div>
            @empty
            <p>Belum ada penawaran</p>
            @endforelse
        </section>
        @if ($data->is_joined && !$data->is_ended)
        <form action="{{route('auction.bid')}}" method="POST" class="w-50 mt-3">
            @csrf
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="auction_id" value="{{$data->id}}">
            <div class="form-group">
                <label for="bid" class="mb-2">Harga penawaran</label>
                <input min="{{$data->start_price}}" class="form-control mb-2" type="number" name="bid"
                    placeholder="Masukan harga penawaran anda...">
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
        @endif


        <h3 class=" mt-5">Penawar</h3>
        <section class="row">
            @forelse ($data->members as $item)
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$item->name}}</h5>
                        <p class="card-text">Bergabung pada {{$item->created_at->diffForHumans()}}</p>
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
