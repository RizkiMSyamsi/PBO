<?php
ob_start();
include "../inc/config.php";
validate_admin_not_login("login.php");

// Fungsi untuk mengambil data pesanan
function getDataPesanan($db) {
    $dataPesanan = [];
    $q = mysqli_query($db, "SELECT pesanan.* FROM pesanan ORDER BY id DESC") or die(mysqli_error($db));
    while ($data = mysqli_fetch_object($q)) {
        $totalHarga = 0;
        $q2 = mysqli_query($db, "SELECT detail_pesanan.*, produk.harga FROM detail_pesanan INNER JOIN produk ON detail_pesanan.produk_id = produk.id WHERE pesanan_id = '$data->id'") or die(mysqli_error($db));
        while ($d = mysqli_fetch_object($q2)) {
            $totalHarga += $d->harga * $d->qty;
        }
        $data->totalHarga = $totalHarga;
        $dataPesanan[] = $data;
    }
    return $dataPesanan;
}

if (@$_GET['act'] != "cetak") {
    include "inc/header.php";
}
?>
<div class="container">
    <h4>Laporan Penjualan</h4>
    <?php
    if (@$_GET['act'] != "cetak") {
    ?>
        <a href="?act=cetak" class="btn btn-primary">Cetak</a>
    <?php
    }
    ?>
    <div class="col-md-12">
        <hr/>
    </div>

    <div class="row">
        <table class="table table-striped" border="1">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Tanggal Tempo</th>
                <th>Tanggal Pesan</th>
                <th>Total</th>
                <th>Ongkir</th>
                <th>Status</th>
            </tr>
            <tbody>
                <?php
                $totalSemua = 0;
                $totalOngkir = 0;
                $no = 0;
                $pesanan = getDataPesanan($db);
                foreach ($pesanan as $data) {
                    $no++;
                    $totalSemua += $data->totalHarga;
                    $totalOngkir += $data->ongkir;
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data->nama; ?></td>
                        <td><?php echo $data->tanggal_digunakan; ?></td>
                        <td><?php echo $data->tanggal_pesan; ?></td>
                        <td><?php echo "Rp. " . number_format($data->totalHarga, 2, ",", "."); ?></td>
                        <td><?php echo "Rp. " . number_format($data->ongkir, 2, ",", "."); ?></td>
                        <td><?php echo $data->status; ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="4" align="right">
                        <font size="3">
                            <b>TOTAL</b>
                        </font>
                    </td>
                    <td>
                        <font size="3"><?php echo "Rp. " . number_format($totalSemua, 2, ",", "."); ?></font>
                    </td>
                    <td>
                        <font size="3">
                            <?php echo "Rp. " . number_format($totalOngkir, 2, ",", "."); ?>
                        </font>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
if (@$_GET['act'] == "cetak") {
    require_once '../vendor/autoload.php'; // Sesuaikan path ke file autoload.php milik mPDF
    $mpdf = new "\mpdf\mpdf.php";
    $mpdf->WriteHTML(ob_get_clean()); // Mengambil output buffer yang telah diisi dengan konten HTML laporan
    $mpdf->Output(); // Outputkan dokumen PDF ke browser
    exit; // Hentikan eksekusi skrip setelah output PDF selesai
}
?>
