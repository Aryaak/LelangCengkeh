@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-3 fw-bold">Daftar Lelang</h1>

        <form action="{{ route('search') }}" method="get">
            <div class="input-group input-group-sm mb-3 w-75 mx-auto">
                @csrf
                <input name="search" type="text" class="form-control w-25" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-sm">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>

        <div class="row gap-3 justify-content-center">
            @forelse ($data as $item)
                <div class="col-md-3 d-flex justify-content-center">
                    <div class="card shadow p-3 bg-body rounded" style="width: 18rem">
                        <img height="200" src="{{ asset($item->photo) }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">
                                {{ \Illuminate\Support\Str::limit($item->description, $limit = 50, $end = '...') }}
                            </p>
                            <a href="{{ route('auction.show', $item->id) }}" class="btn btn-primary">Lihat</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Belum ada lelang berlangsung</p>
            @endforelse
        </div>
    </div>
@endsection
