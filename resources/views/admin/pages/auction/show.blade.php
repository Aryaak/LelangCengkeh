@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Lelang</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <img height="300" src="{{asset('storage/' . $data->photo)}}" class="mb-3">
        <h3 class="mb-2">{{$data->title}}</h3>
        <p class="mb-3">{{$data->description}}</p>
        <p>Dimulai pada: </p>
        <p>{{$data->start_at}}</p>
        <p>Berakhir pada: </p>
        <p>{{$data->end_at}}</p>
        <h3>Penawar</h3>
        <table class="table w-50">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Penawar</th>
                    <th scope="col">Bergabung pada</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data->bids as $item)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$item->title}}</td>
                    <td>{{$item->start_at}}</td>
                    <td>{{$item->end_at}}</td>
                    <td>Rp. {{number_format($item->start_price, 0, ',', '.')}}</td>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-warning">Edit</button>
                        <button data-bs-toggle="modal" data-bs-target="#destroyModal"
                            class="btn btn-danger">Hapus</button>
                        <a href="{{route('auction.show', $item->id)}}" class="btn btn-primary">Lihat</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse

            </tbody>
        </table>
        <h3>Penawaran</h3>
        <table class="table w-50">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Penawar</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Ditawarkan pada</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data->bids as $item)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$item->title}}</td>
                    <td>{{$item->start_at}}</td>
                    <td>{{$item->end_at}}</td>
                    <td>Rp. {{number_format($item->start_price, 0, ',', '.')}}</td>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-warning">Edit</button>
                        <button data-bs-toggle="modal" data-bs-target="#destroyModal"
                            class="btn btn-danger">Hapus</button>
                        <a href="{{route('auction.show', $item->id)}}" class="btn btn-primary">Lihat</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
    function changePreview() {
        const inputFile = document.getElementById('photo');
        const imgPreview = document.getElementById('img_preview');
        const url = URL.createObjectURL(inputFile.files[0]);
        imgPreview.setAttribute('src', url)
    }

    function changePreviewEdit() {
        const inputFile = document.getElementById('photo_edit');
        const imgPreview = document.getElementById('img_preview_edit');
        const url = URL.createObjectURL(inputFile.files[0]);
        imgPreview.setAttribute('src', url)
    }

</script>
@endsection
