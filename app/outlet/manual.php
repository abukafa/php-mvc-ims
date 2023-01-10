<?php 
include_once '../templates/header.php';
if($u['kode'] == 'Office'){
	exit;
}
?>
<!--  MANUAL --------------------------------------------------------------------------------------------------------->
<style>
    p {
        text-align: justify;
        text-justify: inter-word;
    }
</style>
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>User Manual</strong> - Office User</h1>

        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Petunjuk Pemakaian</h5>
                        <br>
                        <p>Selamat datang !! </p>
                        <p>Ini adalah Pre-Release Aplikasi Inventory Management System PT. JUPRI yang sudah disertai fungsi & Database untuk digunakan dalam simulasi. Silahkan dicoba, kemudian berikan kami (Developer) masukan dan koreksi tentang kekurangan dari aplikasi ini.</p>
                    </div>
                    <div class="card-body">
                        <ol class="">
                            <li class="card-title">Login</li>
                                <p>Masuk ke alamat: <a href="http://jupri.great-site.net">www.jupri.great-site.net</a> kemudian masukan username dan password dari akun yang sudah terdaftar. Jika akun anda Office maka akan otomatis masuk ke menu Office, begitu juga jika akun yang digunakan login adalah akun Outlet tertentu akan masuk ke menu outlet tersebut. Jika ingin membuka lebih dari satu jendela anda bisa click kanan lalu pilih "Open in New Tab".</p>
                            <li class="card-title">Navbar</li>
                                <p>Ketika memasuki menu aplikasi terdapat Navigasi bar di bagian atas, di sebelah kiri ada toogle untuk menampilkan dan menyembunyikan sidebar. di sebelah kanannya ada menu Notifikasi (icon lonceng) dan popup angka yang menandakan jumlah notifikasi yang ada, jika di-click akan menampilkan Notifikasi yang dipergunakan sebagai remainder (pengingat). Di sebelah kanannya ada pic dan nama pengguna, jika di-click akan menampilkan beberapa menu user seperti Ganti Password & Logout.</p>
                            <li class="card-title">Sidebar</li>
                                <p>Navigasi menu yang berada di sebelah kiri, untuk memindahkan halaman yang digunakan. Antara user Office dan user Outlet mempunyai menu yang berbeda sesuai kebutuhannya masing-masing.</p>
                            <li class="card-title">Dashboard</li>
                                <p>Ini adalah menu utama yang akan tampil pertama kali setelah Login. di dalamnya ada informasi jumlah stok dan grafik penjualan yang nantinya akan menghitung stok terjual di seluruh outlet setiap bulannya. Dibawahnya ada kalender dan grafik stok terbuang yang nantinya menjumlah stok terbuang di seluruh outlet. dibawahnya lagi ada map chart lokasi outlet AGJ yang mengambil dari data kordinat setiap outlet AGJ Priangan Timur yang diinput di data Outlet. di paling bawah ada tabel nama-nama Outlet yang sudah mengisi laporan dan belum, juga terdapat grafik penjualan setiap outlet yang akan menghitung jumlah stok yang terjual.</p>
                            <li class="card-title">Master Data</li>
                                <p>Ini adalah menu yang nanti harus diisi pertama kali oleh user Office. mulai dari data outlet s.d. data barang, dengan meng-click tombol hijau untuk entri data baru, beberapa tabel men-generate kode secara otomatis. data jenis barang, satuan, dan supplier harus diisi terlebih dahulu sebelum data barang, karena dalam data barang akan memanggil data-data tersebut.</p>
                            <li class="card-title">Gudang</li>
                                <p>Menu ini menampilkan stok yang ada di gudang. data barang yang sudah diisi di data master harus diinput kembali di data gudang dengan hanya memanggil kode barang nya saja, dilengkapi dengan stok minimum untuk mengatur jika stok sudah mencapai minimum maka aplikasi akan menampilkan notifikasi. Jumlah stok otomatis diisi NOL karena nanti akan bertambah dan berkurang secara otomatis.</p>
                            <li class="card-title">Barang Masuk - Gudang (Pembelian)</li>
                                <p>Ini adalah halaman untuk input Pembelian barang, yaitu barang yang akan masuk gudang. ketika mengentri data disini akan otomatis meng-update data barang di gudang. isi data dengan lengkap, jika pembayaran ditangguhkan maka isi kolom Bayar dengan angka NOL. anda bisa mengedit data yang sudah diinput jika ada kesalahan, anda juga bisa menghapusnya jika perlu. Stok barang di gudang akan meng-generate dengan otomatis.</p>
                            <li class="card-title">Pengiriman</li>
                                <p>Menu ini menampilkan Invoice (Faktur) Pengiriman barang dari gudang ke outlet. Tabel hanya menunjukan invoice, click tombol hijau (icon printer) untuk menampilkan Struk Bukti Pengiriman berformat pdf bisa di-download atau langsung dicetak. Tekan tombol hijau "Entri Baru" untuk membuat invoice data pengiriman baru. menu ini menggunakan sistem Point Of Sale seperti yang digunakan pada mesin kasir, yang bisa memasukan banyak item pengiriman (Shipment) dalam satu faktur (invoice).</p>
                            <li class="card-title">Outlet</li>
                                <p>Menu Outlet hampir sama dengan menu Gudang, digunakan untuk meng-input data barang yang ada di Outlet. isi stok minimum dan kosongkan stok. Terdapat data QTY atau konversi diisi dengan jumlah satuan terkecil, contoh : jika beras satuannya diisi "Krg" (karung) qty nya diisi "25" (25 Kg) ini akan mengkonversi stok tersebut ketika masuk ke Outlet.</p>
                            <li class="card-title">Barang Masuk - Outlet (Penerimaan)</li>
                                <p>Stok masuk di outlet mirip dengan yang ada di menu gudang, namun di outlet menggunakan satuan terkecil. jumlah barang yang dikirim ke outlet akan dikonversi dengan satuan terkecil, contoh : Gudang mengirim 3 Karung beras aplikasi akan merubahnya menjadi 75 Kg beras. Untuk meng-input data stok masuk cukup dengan memanggil data dengan kode (Shipment Number) dalam form Entri Baru.</p>
                            <li class="card-title">Stok Keluar</li>
                                <p>Ini adalah menu entri yang akan diisi user outlet setiap hari, yaitu barang keluar baik yang terjual maupun yang terbuang.</p>
                            <li class="card-title">Laporan</li>
                                <p>Menu ini digunakan untuk menarik data laporan. di bagian atas terdapat grafik stok masuk, keluar, dan sisa stok. di bagian bawah terdapat 4 menu untuk memanggil laporan.</p>
                            <li class="card-title">Stok Opname</li>
                                <p>Menu ini diisi user outlet setiap ahir periode dengan meng-click langsung angka jumlah SO untuk diganti sesuai stok fisik yang tersedia di outlet, aplikasi juga akan menghitung selisih datanya secara otomatis. tombol hijau reset ditekan untuk mereset data SO menjadi NOL kembali.</p>
                        </ol>
                    </div>
                    <div class="card-footer">Selamat Mencoba. dan segera berikan koreksi & masukan kepada kami.</div>
                </div>
            </div>
        </div>

    </div>
</main>

<?php 
include_once '../templates/footer.php';
?>