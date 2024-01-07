<?php
    include "koneksi.php";
    if(isset($_POST['submit'])){
        if(empty($_POST['pilihan'])){
        ?>
            <script language="JavaScript">
                alert('Oops! Serius. Anda tidak mengerjakan soal apapun ...');
                document.location='./';
            </script>
        <?php
        }
        
        $pilihan    =$_POST["pilihan"];
        $id_soal    =$_POST["id"];
        $jumlah        =$_POST["jumlah"];
        
        $score    =0;
        $benar    =0;
        $salah    =0;
        $kosong    =0;

        for($i=0;$i<$jumlah;$i++){
            $nomor    =$id_soal[$i];
            
            // jika peserta tidak memilih jawaban
            if(empty($pilihan[$nomor])){
                $kosong++;
            }
            // jika memilih
            else {
                $jawaban    =$pilihan[$nomor];

                // cocokan kunci jawaban dengan database
                $query    =mysqli_query($conn, "SELECT * FROM tbl_soal WHERE id_soal='$nomor' AND kunci='$jawaban'");
                $cek    =mysqli_num_rows($query);
                
                // jika jawaban benar (cocok dengan database)
                if($cek){
                    $benar++;
                }
                // jika jawaban salah (tidak cocok dengan database)
                else {
                    $salah++;
                }
            }
            /*
                ----------
                Nilai 100
                ----------
                Hasil = 100 / jumlah soal * Jawaban Benar
            */
            // script php membuat soal pilihan ganda
            // hitung skor
            $hitung =mysqli_query($conn, "SELECT * FROM tbl_soal WHERE aktif='Y'");
            $jumlah_soal    =mysqli_num_rows($hitung);
            $score    =100 / $jumlah_soal * $benar;
            $hasil    =number_format($score,2);
        }
    }

    // Tampilkan Hasil Ujian Soal Pilihan Ganda
    echo"
    <table border='0'>
        <tbody>
            <tr>
                <td colspan='4'><h4>Nilai Ujian Anda</h4></td>
            </tr>
            <tr>
                <td width='80'><u>Benar ✔</u></td>
                <td width='80'><u>Salah ✕</u></td>
                <td width='140'><u>Tidak Terjawab !</u></td>
                <td width='100'><u>Skor Akhir #</u></td>
            </tr>
            <tr>
                <td align='center'>$benar</td>
                <td align='center'>$salah</td>
                <td align='center'>$kosong</td>
                <td align='right'><b>$hasil</b></td>
            </tr>
        </tbody>
    </table>
    ";
    echo "<br /><a href='soal.php./'><< kembali</a>";
    
?>