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
        <img height="100%" width="100%" src="{{ asset($data->photo) }}" class="mb-3">
        <h3 class="mb-2">{{ $data->title }}</h3>
        <p class="mb-3">{{ $data->description }}</p>
        <p>Dimulai pada: </p>
        <p>{{ $data->start_at }}</p>
        <p>Berakhir pada: </p>
        <p>{{ $data->end_at }}</p>
        <h3>Penawaran</h3>
        <div class="overflow-auto">
            <table class="table w-50">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Penawar</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Ditawarkan pada</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data->bids as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->user->name }}</td>
                        <td>Rp. {{ number_format($item->bid, 0, ',', '.') }}</td>
                        <td>{{ $item->created_at->diffForHumans() }}</td>
                        <td>
                            <button data-bs-toggle="modal" data-bs-target="#destroyBidModal"
                                class="btn btn-danger">Hapus</button>
                        </td>
                    </tr>
                      <!-- Destroy Bid Modal -->
                    <div class="modal fade" id="destroyBidModal" tabindex="-1"
                        aria-labelledby="destroyBidModalLabel" aria-hidden="true">
                        <form action="{{route('auction.bid.destroy', $item->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-dialog  modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="destroyBidModalLabel">Hapus Penawaran</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah anda yakin ingin menghapus penawaran?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        <h3>Penawar</h3>
        <div class="overflow-auto">
            <table class="table w-50">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Penawar</th>
                        <th scope="col">Bergabung pada</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data->members as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <button data-bs-toggle="modal" data-bs-target="#destroyMemberModal"
                                class="btn btn-danger">Hapus</button>
                        </td>
                    </tr>
                    <!-- Destroy Member Modal -->
                    <div class="modal fade" id="destroyMemberModal" tabindex="-1"
                        aria-labelledby="destroyMemberModalLabel" aria-hidden="true">
                        <form action="{{route('auction.member.destroy', [$data->id, $item->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-dialog  modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="destroyMemberModalLabel">Hapus Penawar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah anda yakin ingin menghapus penawar?</p>
                                        <p>Penawaran harga juga akan terhapus</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<div class="overflow-auto">

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
