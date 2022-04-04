@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Lelang</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content overflow-auto">
    <div class="container-fluid">
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Buat lelang
            baru</button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Dimulai pada</th>
                    <th scope="col">Berakhir pada</th>
                    <th scope="col">Harga awal</th>
                    <th scope="col" colspan="3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$item->title}}</td>
                    <td>{{ date('Y-m-d h:i', strtotime($data->start_at))}}</td>
                    <td>{{ date('Y-m-d h:i', strtotime($data->end_at))}}</td>
                    <td>Rp. {{number_format($item->start_price, 0, ',', '.')}}</td>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#editModal{{$item->id}}" class="btn btn-warning">Edit</button>
                    </td>
                    <td>
                        <a href="{{route('admin.auction.show', $item->id)}}" class="btn btn-primary">Lihat</a>
                    </td>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#destroyModal{{$item->id}}"
                        class="btn btn-danger">Hapus</button>
                    </td>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <form action="{{route('auction.update', $item->id)}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-dialog  modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit lelang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <img src="{{asset($item->photo)}}" height="200"
                                                id="img_preview_edit" class="mb-3"> <br>
                                            <label for="photo_edit">Foto</label>
                                            @error('photo')
                                            <span>{{$message}}</span>
                                            @enderror
                                            <input  onchange="changePreviewEdit()" class="form-control"
                                                type="file" id="photo_edit" name="photo">
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Judul</label>
                                            @error('title')
                                            <span>{{$message}}</span>
                                            @enderror
                                            <input required class="form-control" type="text" id="title" name="title"
                                                placeholder="Masukan judul lelang..." value="{{$item->title}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Deskripsi</label>
                                            @error('description')
                                            <span>{{$message}}</span>
                                            @enderror
                                            <textarea required class="form-control" name="description" id="description"
                                                cols="30" rows="10"
                                                placeholder="Masukan deskripsi lelang...">{{$item->description}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="start_at">Dimulai pada</label>
                                            @error('start_at')
                                            <span>{{$message}}</span>
                                            @enderror
                                            <input  class="form-control" type="datetime-local" id="start_at"
                                                name="start_at" value="{{$item->start_at}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="end_at">Berakhir pada</label>
                                            @error('end_at')
                                            <span>{{$message}}</span>
                                            @enderror
                                            <input  class="form-control" type="datetime-local" id="end_at"
                                                name="end_at" value="{{$item->end_at}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="start_price">Harga awal</label>
                                            @error('start_price')
                                            <span>{{$message}}</span>
                                            @enderror
                                            <input required class="form-control" type="number" id="start_price"
                                                name="start_price" placeholder="Masukan harga awal lelang..."
                                                value="{{$item->start_price}}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Destroy Modal -->
                    <div class="modal fade" id="destroyModal{{$item->id}}" tabindex="-1" aria-labelledby="destroyModalLabel"
                        aria-hidden="true">
                        <form action="{{route('auction.destroy', $item->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-dialog  modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="destroyModalLabel">Hapus lelang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah anda yakin ingin menghapus lelang?</p>
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

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <form action="{{route('auction.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Buat lelang baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <img src="" height="200" id="img_preview" class="mb-3"> <br>
                        <label for="photo">Foto</label>
                        @error('photo')
                        <span>{{$message}}</span>
                        @enderror
                        <input required onchange="changePreview()" class="form-control" type="file" id="photo"
                            name="photo">
                    </div>
                    <div class="form-group">
                        <label for="title">Judul</label>
                        @error('title')
                        <span>{{$message}}</span>
                        @enderror
                        <input required class="form-control" type="text" id="title" name="title"
                            placeholder="Masukan judul lelang...">
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        @error('description')
                        <span>{{$message}}</span>
                        @enderror
                        <textarea required class="form-control" name="description" id="description" cols="30" rows="10"
                            placeholder="Masukan deskripsi lelang..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="start_at">Dimulai pada</label>
                        @error('start_at')
                        <span>{{$message}}</span>
                        @enderror
                        <input required class="form-control" type="datetime-local" id="start_at" name="start_at">
                    </div>
                    <div class="form-group">
                        <label for="end_at">Berakhir pada</label>
                        @error('end_at')
                        <span>{{$message}}</span>
                        @enderror
                        <input required class="form-control" type="datetime-local" id="end_at" name="end_at">
                    </div>
                    <div class="form-group">
                        <label for="start_price">Harga awal</label>
                        @error('start_price')
                        <span>{{$message}}</span>
                        @enderror
                        <input required class="form-control" type="number" id="start_price" name="start_price"
                            placeholder="Masukan harga awal lelang...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>

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
