<?php
session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";
// panggil fungsi untuk format tanggal
include "../../config/fungsi_tanggal.php";
// panggil fungsi untuk format rupiah
include "../../config/fungsi_rupiah.php";

$hari_ini = date("d-m-Y");

$no = 1;
// fungsi query untuk menampilkan data dari tabel obat
$query = mysqli_query($mysqli, "SELECT kode_regu,komandan,nama_regu FROM is_regu ORDER BY nama_regu ASC")
    or die('Ada kesalahan pada query tampil Data Deteni: ' . mysqli_error($mysqli));
$count  = mysqli_num_rows($query);
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>LAPORAN DATA DETENI</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
</head>

<body>
    <div>
        <table style="width:80%;" border="0">
            <tr>
                <td rowspan="6"><img src="../../assets/img/pengayoman.png" alt="" style="margin-top:25px;width:70px;"></td>
                <td>
                    <div id="title1">KEMENTERIAN HUKUM DAN HAK ASASI MANUSIA</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="title1">REPUBLIK INDONESIA</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="title1">RUMAH DETENSI IMIGRASI SURABAYA</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="title2">Jl.Raya Raci, Kecamatan Bangil, Kabupaten Pasuruan</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="title2">Telepon 0343-744656 Fax 0343-744260,744656</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="title2">Laman : www.rudenimsurabaya.kemenkumham.go.id Email: detensi_imigrasi@yahoo.com</div>
                </td>
            </tr>
        </table>
    </div>


    <hr><br>
    <div>
        <table style="width:100%;" border="0">
            <tr>
                <td>
                    <div id="title3">LAPORAN DATA REGU</div>
                </td>
            </tr>
        </table>
    </div>

    <div id="isi">
        <table width="100%" border="0.3" cellpadding="0" cellspacing="0" align="center">
            <thead style="background:#e8ecee">
                <tr class="tr-title">
                    <th height="20" align="center" valign="middle">NO.</th>
                    <th height="20" align="center" valign="middle">KODE REGU</th>
                    <th height="20" align="center" valign="middle">NAMA KOMANDAN</th>
                    <th height="20" align="center" valign="middle">NAMA REGU</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // tampilkan data
                while ($data = mysqli_fetch_assoc($query)) {

                    // menampilkan isi tabel dari database ke tabel di aplikasi
                    echo "  <tr>
                        <td width='40' height='13' align='center' valign='middle'>$no</td>
                        <td width='80' height='13' align='center' valign='middle'>$data[kode_regu]</td>
                        <td style='padding-left:5px;' width='180' height='13' valign='middle'>$data[komandan]</td>
                        <td style='padding-right:10px;' width='80' height='13' align='center' valign='middle'>$data[nama_regu]</td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>

        <div id="footer-tanggal">
            Pasuruan, <?php echo tgl_eng_to_ind("$hari_ini"); ?>
        </div>
        <div id="footer-jabatan">
            Kepala Seksi Keamanan dan Ketertiban
        </div>

        <div id="footer-nama">
            Endra Andie Aryanto
        </div>
        <div id="footer-nip">
            NIP.197802091998031002
        </div>
    </div>
</body>

</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename = "LAPORAN Data Regu.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">' . ($content) . '</page>';
// panggil library html2pdf
require_once('../../assets/plugins/html2pdf_v4.03/html2pdf.class.php');
try {
    $html2pdf = new HTML2PDF('P', 'F4', 'en', false, 'ISO-8859-15', array(10, 10, 10, 10));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
} catch (HTML2PDF_exception $e) {
    echo $e;
}
?>