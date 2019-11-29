<!DOCTYPE html>
<?php
 ob_start();
 session_start();
 require 'dbconnect.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }
 // select loggedin users detail
 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);
?>
<html lang="en">
<head>
  <title>SI-Bunder</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="jquery/css/bootstrap.min.css">
  <script src="jquery/js/jquery.min.js"></script>
  <script src="jquery/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Bunder-Bangsring</a>
    </div>
    <ul class="nav navbar-nav">
      
	  <li class="active"><a href="home.php"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a></li>
      
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Master Emp<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="karyawan.php">Data Karyawan</a></li>
          <li><a href="form.php">Data User</a></li>
		  <li role="separator" class="divider"></li>
		  <li><a href="karyawan.php">Rekap Karyawan</a></li>
        </ul>
      </li>
	  
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Master Salary</a>
        <ul class="dropdown-menu">
			<li><a href="gajikaryawan.php"><span class="glyphicons glyphicons-group">Master Gaji</a></li>
			<li><a href="gajiminggu.php">Kategori Gaji </a></li>
			<li><a href="gaji.php">Gaji Bulanan</a></li>
			<li><a href="gajiharian.php">Gaji Harian</a></li>
        </ul>
      </li>
      
	  <li><a href="kasir/index.php">Tiket</a></li>
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="rekapjual.php">Transaksi</a>
		<ul class="dropdown-menu">
			<li><a href="rekapjual.php">Penyetoran</a></li>
			<li><a href="penjualan.php">Penjualan</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="cetak_rekapjual.php">Cetak Penyetoran</a></li>
			<li><a href="cetak_penjualan.php">Cetak Penjualan</a></li>
		</ul>
	  </li>
	  
		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="absen.php">Presensi</a>
		<ul class="dropdown-menu">
			<li><a href="absenharian.php">Harian</a></li>
			<li><a href="absenharian.php">Bulanan</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="entryabsen.php">Entry</a></li>
		</ul>
	  </li>
	  
	  <li><a href="#">About</a></li>
	  <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="" class="dropdown-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				<span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
				<li role="presentation" class="divider"></li>
				<li><a href="daftar.php">Register User</a></li>
				<li><a href="lihatuser.php">Edit User</a></li>
              </ul>
            </li>
       </ul>
    </ul>
  </div>
</nav>
  
<div class="container">
  <center><h3>Selamat Datang di Aplikasi Sistem Informasi Bunder (SI-Bunder)</h3>
    <p>Jl. Bangsring</p>
	</center>
</div>

</body>
</html>
<?php ob_end_flush(); ?>