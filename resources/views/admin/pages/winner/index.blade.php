@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pemenang</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content overflow-auto">
    <div class="container-fluid overflow-x-hidden">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">No HP/Whatsapp</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$item->winner->name}}</td>
                    <td><a target="_blank" href="https://wa.me/+62{{substr($item->winner->phone, 1);}}">{{$item->winner->phone}}</a> </td>
                </tr>

                   <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <form action="{{route('user.update', $item->id)}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-dialog  modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit pengguna</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="title">Nama</label>
                                            @error('name')
                                            <span>{{$message}}</span>
                                            @enderror
                                            <input required class="form-control" type="text" id="name" name="name"
                                                placeholder="Masukan nama pengguna..." value="{{$item->name}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">email</label>
                                            @error('email')
                                            <span>{{$message}}</span>
                                            @enderror
                                            <input required class="form-control" type="email" id="email" name="email"
                                                placeholder="Masukan email pengguna..." value="{{$item->email}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">No HP/Whatsapp</label>
                                            @error('phone')
                                            <span>{{$message}}</span>
                                            @enderror
                                            <input required class="form-control" type="text" id="phone" name="phone"
                                                placeholder="Masukan judul pengguna..." value="{{$item->phone}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            @error('address')
                                            <span>{{$message}}</span>
                                            @enderror
                                            <textarea required class="form-control" name="address" id="address"
                                                cols="30" rows="10"
                                                placeholder="Masukan alamat pengguna...">{{$item->address}}</textarea>
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
                        <form action="{{route('user.destroy', $item->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-dialog  modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="destroyModalLabel">Hapus pengguna</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah anda yakin ingin menghapus pengguna?</p>
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
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


@endsection
