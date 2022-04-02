@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-3 fw-bold">Daftar Lelang</h1>

        <div class="row">
            @forelse ($data as $item)
                <div class="col-md-3 mb-5">
                    <div class="card mb-5">
                        <img height="200" src="{{ asset($item->photo) }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">
                                {{ \Illuminate\Support\Str::limit($item->description, $limit = 50, $end = '...') }}</p>
                            <a href="{{ route('auction.show', $item->id) }}" class="btn btn-primary">Lihat</a>
                        </div>
                    @empty
                        <p class="text-center">Belum ada lelang berlangsung</p>
            @endforelse
        </div>
    </div>
@endsection
