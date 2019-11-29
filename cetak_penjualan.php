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
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['userName']; ?></title>
<link rel="stylesheet" href="assets/css/bootstrap.min1.css" type="text/css"  />
<link rel="stylesheet" href="style1.css" type="text/css" />
<script>window.print();</script>
</head>
<body>
<img src="http://localhost:1234/bunder/kasir/assets/img/LOGO.gif" width="10%" height="10%" alt="terumbu karang">
 <!--nav class="navbar navbar-default navbar-fixed-top"-->
    
    <!--/nav--> 

<?php if ($_GET[act]==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Penjualan </h3>
                  <?php if($_SESSION[level]!='admin'){ ?>
                  
                  <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Uraian</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
						<th>Total Jual</th>
						
                        <?php if($_SESSION[level]!='admin'){ ?>
                        
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysql_query("SELECT s.sewa,p.tgl,p.qty,p.total_harga FROM penjualan as p, sewa as s where p.id_sewa=s.id_sewa ORDER BY p.tgl desc");
                    $no = 1;
                    while($r=mysql_fetch_array($tampil)){
						$total=$r[gaji1]+$r[gaji2];
                    //$tanggal = tgl_indo($r[tgl_posting]);
                    echo "<tr><td>$no</td>
                              <td>$r[sewa]</td>
                              <td>$r[tgl]</td>
							  <td>$r[qty]</td>
							  <td>$r[total_harga]</td>
							  
							  "; 
							  //setlocale(LC_MONETARY,'en_US');
							  //money_format('Rp. %i',$r[gaji1]);
							  //echo "&#36; $r[gaji1]";
							 // $english_format_number = number_format($r[gaji1]);
					
                              if($_SESSION[level]!='admin'){
                        echo "";
                              }
                            echo "</tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysql_query("DELETE FROM setor where id='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=gaji';</script>";
                      }

                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
<?php } ?>
				<a class='pull-left btn btn-primary btn-sm' href='cetak_penjualan.php'>Cetak </a>
				<a class='pull-left btn btn-primary btn-sm' href='penjualan.php'>Selesai </a>
			</body>
			
</html>
<?php ob_end_flush(); ?>