<?php
  //require 'nav.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['userName']; ?></title>
<!--link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  /-->
<!--script type="text/javascript" src="jquery-ui-1.11.4/jquery.js"></script-->
<!--script type="text/javascript" src="jquery-ui-1.11.4/jquery-ui.js"></script-->
<!--link rel="stylesheet" type="text/css" href="jquery-ui-1.11.4/jquery-ui.css"-->
<!--link rel="stylesheet" href="style.css" type="text/css" /-->
<!--link href="jquery/css/bootstrap.min.css" rel="stylesheet"-->
<link href="jquery/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="jquery/jquery-2.1.4.min.js"></script>
	<script src="jquery/js/bootstrap.min.js"></script>
	<script src="jquery/js/moment.min.js"></script>
	<script src="jquery/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
   $(function () {
    $('#datetimepicker').datetimepicker({
     format: 'DD MMMM YYYY HH:mm',
                });
	$('#datetimepicker2').datetimepicker({
     format: 'DD MMMM YYYY HH:mm',
                });			
    
    $('#datepicker').datetimepicker({
     format: 'DD MMMM YYYY',
    });
    
    $('#timepicker').datetimepicker({
     format: 'HH:mm'
    });
   });
  </script>
</head>
<body>

 <!--nav class="navbar navbar-default navbar-fixed-top"-->
     
    <!--/nav--> 

<?php if ($_GET[act]==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Karyawan </h3>
                  <?php if($_SESSION[level]!='admin'){ ?>
                  <a class='pull-left btn btn-primary btn-sm' href='index.php?view=absen&act=tambahabsen'>Tambahkan Data </a>
                  <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Jam Datang</th>
                        <th>Jam Pulang</th>
                        <?php if($_SESSION[level]!='admin'){ ?>
                        <th>Action</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysql_query("SELECT * FROM absen ORDER BY no asc");
                    $no = 1;
                    while($r=mysql_fetch_array($tampil)){
                    //$tanggal = tgl_indo($r[tgl_posting]);
                    echo "<tr><td>$no</td>
                              <td>$r[nama]</td>
                              <td>$r[jam_datang]</td>
                              <td>$r[jam_pulang]</td>";
                              if($_SESSION[level]!='admin'){
                        echo "<td><center>
                                <a class='btn btn-info btn-xs' title='Lihat Detail' href='?view=absen&act=detailabsen&id=$r[no]'><span class='glyphicon glyphicon-search'></span></a>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='?view=absen&act=editabsen&id=$r[no]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='?view=absen&hapus=$r[no]'><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysql_query("DELETE FROM absen where no='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=absen';</script>";
                      }

                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
<?php 
}elseif($_GET[act]=='tambahabsen'){
  if (isset($_POST[tambah])){
      $dir_gambar = 'foto_pegawai/';
      $filename = basename($_FILES['h']['name']);
      $uploadfile = $dir_gambar . $filename;
      if ($filename != ''){      
        if (move_uploaded_file($_FILES['h']['tmp_name'], $uploadfile)) {
          mysql_query("INSERT INTO absen VALUES ('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]')");
            echo "<script>document.location='index.php?view=absen';</script>";
        }else{
          echo "<script>window.alert('Gagal Tambahkan Data absen.');
                      window.location='index.php?view=absen'</script>";
        }
      }else{
        mysql_query("INSERT INTO absen VALUES ('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]')");
        echo "<script>document.location='index.php?view=absen';</script>";

      }
  }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data absen Baru</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-6'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='120px' scope='row'>No</th>      <td><input type='text' class='form-control' name='a'> </td></tr>
                    <tr><th scope='row'>Nama</th>               <td><input type='text' class='form-control' name='b'></td></tr>
                    <tr><th scope='row'>Jam Datang 1</th>           <td><input type='text' class='form-control' name='c'></td></tr>
                    <tr><th scope='row'>Jam Pulang</th>                 <td><input type='text' class='form-control' name='d'></td></tr>
                    
                  </tbody>
                  </table>
                </div>

               </div>
              <div class='box-footer'>
                    <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php?view=absen'><button class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}elseif($_GET[act]=='editabsen'){
  if (isset($_POST[update])){
      $dir_gambar = 'foto_pegawai/';
      $filename = basename($_FILES['h']['name']);
      $uploadfile = $dir_gambar . $filename;
      if ($filename != ''){      
        if (move_uploaded_file($_FILES['h']['tmp_name'], $uploadfile)) {
          mysql_query("UPDATE absen SET 
                           no          = '$_POST[a]',
                           nama     = '$_POST[b]',
                           jam_datang         = '$_POST[c]',
                           jam_pulang       = '$_POST[d]'
                           ");

            echo "<script>document.location='index.php?view=absen&act=editabsen&id=".$_POST[id]."';</script>";
        }else{
          echo "<script>window.alert('Gagal Upload Foto .');
                      window.location='index.php?view=absen&act=editabsen&id=".$_POST[id]."'</script>";
        }
      }else{
        mysql_query("UPDATE absen SET 
                           nama     = '$_POST[b]',
                           jam_datang         = '$_POST[c]',
                           jam_pulang       = '$_POST[d]' 
						   where no='$_POST[a]'
						   ");
        echo "<script>document.location='index.php?view=absen&act=editabsen&id=".$_POST[id]."';</script>";

      }
  }

    $edit = mysql_query("SELECT * FROM absen a where a.no='$_GET[id]'");
    $s = mysql_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data absen</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-6'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[no]'>
                    <tr><th style='background-color:#E7EAEC' width='160px' rowspan='9'>";
                        if (trim($s[foto])==''){
                          echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/no-image.jpg'>";
                        }else{
                          echo "<img class='img-thumbnail' style='width:155px' src='foto_pegawai/$s[foto]'>";
                        }
                        echo "</th>
                    </tr>
                    <tr><th width='120px' scope='row'>no</th>      
						<td><input type='text' class='form-control' name='a' value='$s[no]'> </td></tr>
                    <tr><th scope='row'>Nama</th>               
						<td><input type='text' class='form-control' name='b' value='$s[nama]'></td></tr>
                    <tr><th scope='row'>Jam Datang 2</th>           
						<td><input id='datetimepicker' type='text' class='form-control' name='c' value='$s[jam_datang]'></td></tr>
                    <tr><th scope='row'>Jam Pulang</th>                 
						<td><input id='datetimepicker2' type='text' class='form-control' name='d' value='$s[jam_pulang]'><span class='glyphicon glyphicon-calendar'></span></td></tr>
                    
                  </tbody>
                  </table>
                </div>

                
              </div>
				<div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Update</button>
                    <a href='absen.php?view=absen'><button class='btn btn-default pull-info'>Cancel</button></a>
                    
                </div>
              </form>
            </div>";
}elseif($_GET[act]=='detailabsen'){
    $detail = mysql_query("SELECT * FROM absen a where a.no='$_GET[id]'");
    $s = mysql_fetch_array($detail);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data absen</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-6'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[no]'>
                    <tr><th style='background-color:#E7EAEC' width='160px' rowspan='9'>";
                        if (trim($s[foto])==''){
                          echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/no-image.jpg'>";
                        }else{
                          echo "<img class='img-thumbnail' style='width:155px' src='foto_pegawai/$s[foto]'>";
                        }
                        echo "<a href='index.php?view=absen&act=editabsen&id=$_GET[id]' class='btn btn-success btn-block'>Edit Profile</a>
                        </th>
                    </tr>
                    <tr><th width='120px' scope='row'>no</th>      <td>$s[no]</td></tr>
                    <tr><th scope='row'>Nama</th>               <td>$s[nama]</td></tr>
                    <tr><th scope='row'>Jam Datang</th>           <td>$s[jam_datang]</td></tr>
                    <tr><th scope='row'>Jam Pulang</th>                 <td>$s[jam_pulang]</td></tr>
                    </tbody>
                  </table>
                </div>

                
              </div>
            </form>
            </div>";
}  
?>
</body>
</html>
<?php ob_end_flush(); ?>