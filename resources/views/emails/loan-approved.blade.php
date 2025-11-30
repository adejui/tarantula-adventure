<h2>Halo {{ $data['name'] }},</h2>

<p>Pengajuan peminjaman Anda dengan ID <strong>{{ $data['id'] }}</strong> telah <strong>disetujui</strong>.</p>

<h3>Detail Peminjaman:</h3>
<ul>
    <li><strong>Tanggal Peminjaman:</strong> {{ $data['borrow_date'] }}</li>
    <li><strong>Tanggal Pengembalian:</strong> {{ $data['return_date'] }}</li>
    <li><strong>Jumlah Barang:</strong> {{ $data['quantity'] }}</li>
</ul>

<h3>Data Pengaju:</h3>
<ul>
    <li><strong>Nama:</strong> {{ $data['name'] }}</li>

    @if (!empty($data['organization_name']))
        <li><strong>Organisasi:</strong> {{ $data['organization_name'] }}</li>
    @endif

    @if (!empty($data['campus_name']))
        <li><strong>Kampus:</strong> {{ $data['campus_name'] }}</li>
    @endif

    @if (!empty($data['phone_number']))
        <li><strong>Nomor HP:</strong> {{ $data['phone_number'] }}</li>
    @endif

    @if (!empty($data['email']))
        <li><strong>Email:</strong> {{ $data['email'] }}</li>
    @endif
</ul>

<h3>Lokasi Pengambilan Barang:</h3>
<p>
    Barang dapat diambil di Sekretariat:<br>
    <strong>58XG+6PC Ambarketawang, Kabupaten Sleman, Daerah Istimewa Yogyakarta</strong>
</p>

<p>
    Silakan membawa identitas diri dan datang sesuai jadwal pengambilan yang ditentukan oleh admin.
</p>

<br>

<p>Terima kasih telah menggunakan layanan peminjaman kami.</p>
<p>Jika ada pertanyaan lebih lanjut, silakan hubungi pihak admin.</p>

<br>

<p>Salam hormat,</p>
<p><strong>Tim Logistik</strong></p>
