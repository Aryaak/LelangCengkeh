@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dasbor</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-12">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$count['auction']}}</h3>

                        <p>Total Lelang</p>
                    </div>
                    <a href="{{route('admin.auction')}}" class="small-box-footer">Lihat detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-12">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$count['user']}}</h3>

                        <p>Pengguna</p>
                    </div>
                    <a href="{{route('admin.user')}}" class="small-box-footer">Lihat detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
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
                        <input type="checkbox" oninput="validasi()" id="validasi" value="tenis_meja">
                        <label for="validasi">Setuju dan Lanjutkan</label>
                    </div>
                    <button type="button" data-bs-dismiss="modal" onclick="accept()" name="setuju"
                        class="btn btn-success w-100 d-none">Setuju dan
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
