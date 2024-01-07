<html>
<head>
    <title>Tutorial Membuat Soal Pilihan Ganda dengan Script PHP</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@600;800&family=Poppins:wght@200;300;400;500;600&display=swap');

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}


section{
  position: relative;
  width: 100%;
  
  
}


header{
  background-color:dodgerblue;
  position: fixed;
  top: 0;
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  
}

.search-box{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  background: white;
  height: 40px;
  border-radius: 40px;
  padding: 10px;
}


.search-btn{
  color: black;
  float: right;
  width: 40px;
  border-radius: 50%;
  background: white;
  justify-content: center;
  align-items: center;
}

input[type="text" i] {
  border: none;
  background:none;
  outline: none;
  float: left;
  padding: 0;
  color: black;
  font-size: 16px;
  transition: 0.4s;
  line-height: 40px;
  width: 50%;
  height: 20px;
}

header .navigation {
  display: flex;
  align-items: center;
  margin-left: 20px; /* Add some left margin for spacing */
}



header .logo{
  position: relative;
  color: #000;
  font-size: 30px;
  text-decoration: none;
  text-transform: uppercase;
  font-weight: 800;
  letter-spacing: 1px;
}

header .navigation a{
  color:white;
  text-decoration: none;
  font-weight: 500;
  letter-spacing: 1px;
  padding: 2px 20px;
  border-radius: 20px;
  transition: 0.3s;
  margin-right: 30px;
}

header .navigation .active {
  color:white;
  background-color:rgba(250, 250, 250, 0.3); ;
 
}

header .navigation a:not(:last-child){
  margin-right: 30px;
}

header .navigation a:hover{
  background-color: rgba(255, 255, 255, 0.10);
}
.centered-text {
 text-align: center;
 margin-top: 40px;
 margin-bottom: 50px; 
}

.box{
  border-radius: 20px;
  border: #000;
  margin-left: 48px;
  margin-right: 50px;
  margin-top: 60px;
  
}


.box h2{
  margin-top: 80px;
}

video {
  width: 30%;
  box-shadow: 5px 8px 9px;
  transition: 0.3s;
  border-radius: 10px;
  margin-top: 30px;
  
}


.video :hover{
  background: grey;
}
.box img{
 
}

.welcome-area {
  width:100%;
  height: 60vh;
  min-height: 300px;
  background-image: url(assets/images/download\ \(2\)\ \(1\).jpeg);
  background-repeat: no-repeat;
  background-position: left;
  background-size:cover;
  border-bottom-left-radius: 100px;
  border-bottom-right-radius: 100px;
  
}

h1 {
  font-weight: 900;
  font-size: 52px;
  line-height: 450px;
  letter-spacing: 1px;
  margin-bottom: 30px;
  color:white;
  text-align: center;
  text-shadow: 5px 5px 4px rgba(0, 0, 0, 0.5);
}
    </style>
</head>
<body>
<section>
        <header>
            <div class="img">
                <img src="Screenshot__74_-removebg-preview (1).png" alt="" style="width: 258px;">
              </div>
              <div class="search-box">
                <input class="search-txt" type="text" name="" placeholder="Type to search">
                <a class="search-btn" href="#">
                  <i class="fa-solid fa-magnifying-glass"></i>
          
                </a>
              </div>
            <div class="navigation">
                <a href="home.html">Home</a>
                <a href="soal.php">Soal</a>
                <a href="loginn.html" class="active">Log Out</a>
              </div>
            </header>
            </div>
          </section>
       <div class="welcome-area">
       <div class="h1">
        <h1>Soal</h1>
       </div>
      </div>
    <h3>KERJAKAN SOAL PILIHAN GANDA DI BAWAH INI!</h3>
    <table border="0">
        <tbody>
            <?php
                include "koneksi.php";
                $query    =mysqli_query($conn, "SELECT * FROM tbl_soal WHERE aktif='Y' ORDER BY id_soal DESC");
                $jumlah =mysqli_num_rows($query);
                $no = 0;
                while($data = mysqli_fetch_array($query)){
                $no++
            ?>
            <form action="jawab.php" method="POST">
                <input type="hidden" name="id[]" value="<?php echo $data['id_soal']; ?>">
                <input type="hidden" name="jumlah" value="<?php echo $jumlah; ?>">
                <tr>
                    <td><?php echo $no?>.</td>
                    <td><?php echo $data['soal'];?></td>
                </tr>
                <?php
                    if(!empty($data['gambar'])){
                        echo "<tr><td></td><td><img src='assets/img/$data[gambar]' width='80' height='80'></td></tr>";
                    }
                ?>
                <tr>
                    <td></td>
                    <td>A. <input name="pilihan[<?php echo $data['id_soal']?>]" type="radio" value="A"><?php echo $data['a'];?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>B. <input name="pilihan[<?php echo $data['id_soal']?>]" type="radio" value="B"><?php echo $data['b'];?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>C. <input name="pilihan[<?php echo $data['id_soal']?>]" type="radio" value="C"><?php echo $data['c'];?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>D. <input name="pilihan[<?php echo $data['id_soal']?>]" type="radio" value="D"><?php echo $data['d'];?></td>
                </tr>
                <?php
                }
                ?>
                <tr>
                    <td height="40"></td>
                    <td>
                        <input type="submit" name="submit" value="Jawab" onclick="return confirm('Perhatian! Apakah Anda sudah yakin dengan semua jawaban Anda?')">
                        <input type="reset" value="Reset">
                    </td>
                </tr>
            </form>
        </tbody>
    </table>
</body>
</html>