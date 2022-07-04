@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3 ms-3 fw-bold">Daftar Lelang</h1>

    <form action="{{ route('search') }}" method="get">
        <div class="input-group input-group mb-3 w-75 mx-auto">
            @csrf
            <input name="search" type="text" class="form-control w-25" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-sm" style="outline: 0px !important; box-shadow:none;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    <div class="row gap-3 justify-content-center">
        @forelse ($data as $item)
        <div class="col-md-3 3 d-flex justify-content-center mb-3">
            <div class="card shadow p-3 bg-body rounded" style="width: 20rem">
                <img height="200" src="http://lelangcengkeh548.herokuapp.com/{{$item->photo}}" class="card-img-top">
                {{-- <img height="200" src="{{ asset($item->photo) }}" class="card-img-top"> --}}
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
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Lelang Cengkeh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="fw-bold">Selamat datang di Lelang Cengkeh</h5>
                <p>Syarat & ketentuan yang ditetapkan di bawah ini mengatur pemakaian aplikasi Lelang Cengkeh
                    terkait
                    transaksi dan penggunaan layanan di Lelang Cengkeh </p>
                <p>Pengguna disarankan membaca dengan seksama karena dapat berdampak kepada hak dan kewajiban
                    Pengguna
                    di bawah hukum.</p>

                <h5 class="fw-bold">Informasi</h5>
                <ol type="i">
                    <li>Lelang Cengkeh adalah suatu perseroan terbatas yang menjalankan kegiatan usaha jasa balai
                        lelang
                        dengan merek aplasi mobile Lelang Cengkeh yakni suatu aplikasi yang menawarkan jasa lelang .
                    </li>
                    <li>Kami telah mendapat izin dari Kementrian Keuangan Republik Indonesia, Direktorat Jendral
                        Kekayaan Negara dengan Nomor 23/KM.6/Juni 2007.</li>
                    <li>Petunjuk pelaksanaan lelang diatur secara keseluruhan berdasarkan Peraturan Menteri Keuangan
                        Republik Indonesia Nomor 213/PMK.06/2020.</li>
                    <li>Pedoman pelaksanaan lelang tanpa kehadiran peserta dengan melakukan penawaran lelang secara
                        tertulis melalui internet diatur berdasarkan Peraturan Menteri Keuangan Republik Indonesia
                        Nomor
                        90/PMK.06.2016.</li>
                    <li>Syarat & ketentuan adalah perjanjian antara Pengguna dan Developer yang berisikan
                        seperangkat
                        peraturan yang mengatur hak, kewajiban, tanggung jawab pengguna dan Developer, serta tata
                        cara
                        penggunaan sistem layanan Lelang Cengkeh.</li>
                    <li>Pengguna adalah pihak yang menggunakan layanan Lelang Cengkeh, termasuk namun tidak terbatas
                        pada
                        pembeli, penjual ataupun pihak lain yang sekedar berkunjung ke lelang Lelang Cengkeh.</li>
                    <li>Peserta lelang adalah pengguna yang telah terdaftar dan membayarkan uang deposit serta
                        mengikuti
                        dan melakukan penawaran terhadap objek lelang pada lelang IBID baik secara on site, online,
                        maupun live auction.</li>
                    <li>Pemenang lelang adalah peserta lelang yang memenangkan objek lelang di lelang Lelang Cengkeh
                        dan
                        mendapatkan Konfirmasi Pemenang Lelang (KPL) yang secara resmi dikirimkan oleh Lelang
                        Cengkeh.
                    </li>
                    <li>Penitip adalah pengguna terdaftar yang menitipkan barang nya untuk menjadi objek lelang pada
                        Lelang Cengkeh sesuai dengan Perjanjian Kerjasama antara Lelang Cengkeh dengan Penitip.</li>
                    <li>Penitip adalah pengguna terdaftar yang menitipkan barang nya untuk menjadi objek lelang pada
                        Lelang Cengkeh sesuai dengan Perjanjian Kerjasama antara Lelang Cengkeh dengan Penitip.</li>
                </ol>

                <div>
                    <h5 class="fw-bold">Akun, Password, dan Keamanan Data</h5>
                    <ol type="i">
                        <li>Peserta lelang dengan ini menyatakan bahwa peserta lelang adalah orang yang cakap dan
                            mampu
                            untuk mengikatkan dirinya dalam sebuah perjanjian yang sah menurut hukum.</li>
                        <li>Lelang Cengkeh tidak memungut biaya pendaftaran akun kepada peserta lelang. Pembayaran
                            jaminan lelang dijelaskan pada bagian Pembelian Nomor Peserta Lelang (NPL)</li>
                        <li>Peserta lelang yang telah memiliki akun diwajibkan terlebih dahulu masuk ke akun yang
                            telah
                            terdaftar sebelum membeli NPL.</li>
                        <li>Peserta lelang wajib memberikan informasi nomor telepon pada data akun yang dimilikinya.
                        </li>
                        <li>Peserta lelang bertanggung jawab secara pribadi untuk menjaga kerahasiaan akun dan
                            password
                            untuk semua aktivitas yang terjadi dalam akun peserta lelang.</li>
                        <li>Lelang Cengkeh tidak akan meminta username, password maupun kode SMS verifikasi atau
                            kode OTP
                            milik akun Peserta lelang untuk alasan apapun, oleh karena itu Lelang Cengkeh menghimbau
                            Peserta lelang agar tidak memberikan data tersebut maupun data penting lainnya kepada
                            pihak
                            yang mengatasnamakan Lelang Cengkeh atau pihak lain yang tidak dapat dijamin
                            keamanannya.
                        </li>
                    </ol>
                </div>

                <div>
                    <div class="mb-3">
                        <input type="checkbox"  id="validasi" value="tenis_meja">
                        <label for="validasi">Setuju dan Lanjutkan</label>
                    </div>
                    <button type="button" data-bs-dismiss="modal" onclick="accept()" name="setuju" class="btn btn-success w-100 d-none">Setuju dan
                        lanjutkan</button>
                    <button disabled name="setuju-disabled" class="btn btn-secondary w-100" disabled>Setuju dan
                        lanjutkan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const accept = () => {
        localStorage.setItem('visited', true)
    }
    if (!localStorage.getItem('visited')) {
        $(window).on('load', function () {
            $('#infoModal').modal('show');
        });


        $("input[type=checkbox]").on("change", function (evt) {
            var validasi = $('input[id=validasi]:checked');
            if (validasi.length == 0) {
                $("button[name=setuju-disabled]").removeClass('d-none');
                $("button[name=setuju]").addClass('d-none');
            } else {
                $("button[name=setuju-disabled]").addClass('d-none');
                $("button[name=setuju]").removeClass('d-none');
            }
        });


    }

</script>
@endsection
