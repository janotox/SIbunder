<?php
 require 'nav.php';
  ?>
<!DOCTYPE html>
<html>
<head>

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
                  <a class='pull-left btn btn-primary btn-sm' href='index.php?view=karyawan&act=tambahkaryawan'>Tambahkan Data </a>
                  <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telpon</th>
                        <th>Agama</th>
                        <th>Jabatan</th>
                        <th>Mulai Kerja</th>
                        <?php if($_SESSION[level]!='admin'){ ?>
                        <th>Action</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysql_query("SELECT * FROM karyawan ORDER BY kd_emp asc");
                    $no = 1;
                    while($r=mysql_fetch_array($tampil)){
                    //$tanggal = tgl_indo($r[tgl_posting]);
                    echo "<tr><td>$no</td>
                              <td>$r[nama]</td>
                              <td>$r[jk]</td>
                              <td>$r[telpon]</td>
                              <td>$r[agama]</td>
                              <td>$r[jabatan]</td>
                              <td>$r[tglmulaikerja]</td>";
                              if($_SESSION[level]!='admin'){
                        echo "<td><center>
                                <a class='btn btn-info btn-xs' title='Lihat Detail' href='?view=karyawan&act=detailkaryawan&id=$r[kd_emp]'><span class='glyphicon glyphicon-search'></span></a>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='?view=karyawan&act=editkaryawan&id=$r[kd_emp]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='?view=karyawan&hapus=$r[kd_emp]'><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysql_query("DELETE FROM karyawan where kd_emp='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=karyawan';</script>";
                      }

                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
<?php 
}elseif($_GET[act]=='tambahkaryawan'){
  if (isset($_POST[tambah])){
      $dir_gambar = 'foto_pegawai/';
      $filename = basename($_FILES['h']['name']);
      $uploadfile = $dir_gambar . $filename;
      if ($filename != ''){      
        if (move_uploaded_file($_FILES['h']['tmp_name'], $uploadfile)) {
          mysql_query("INSERT INTO karyawan VALUES ('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]','$_POST[g]',
                                                    '$filename','$_POST[i]','$_POST[j]','$_POST[k]','$_POST[l]','$_POST[m]','$_POST[n]','$_POST[o]')");
            echo "<script>document.location='index.php?view=karyawan';</script>";
        }else{
          echo "<script>window.alert('Gagal Tambahkan Data karyawan.');
                      window.location='index.php?view=karyawan'</script>";
        }
      }else{
        mysql_query("INSERT INTO karyawan VALUES ('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]','$_POST[g]',
                                                    '','$_POST[i]','$_POST[j]','$_POST[k]','$_POST[l]','$_POST[m]','$_POST[n]','$_POST[o]')");
        echo "<script>document.location='index.php?view=karyawan';</script>";

      }
  }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data karyawan Baru</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-6'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='120px' scope='row'>kd_emp</th>      <td><input type='text' class='form-control' name='a'> </td></tr>
                    <tr><th scope='row'>Password</th>               <td><input type='text' class='form-control' name='b'></td></tr>
                    <tr><th scope='row'>Nama Lengkap</th>           <td><input type='text' class='form-control' name='c'></td></tr>
                    <tr><th scope='row'>Alamat</th>                 <td><input type='text' class='form-control' name='d'></td></tr>
                    <tr><th scope='row'>Tempat Lahir</th>           <td><input type='text' class='form-control' name='e'></td></tr>
                    <tr><th scope='row'>Tanggal Lahir</th>          <td><input type='text' class='form-control' name='f'></td></tr>
                    <tr><th width='120px' scope='row'>Jenis Kelamin</th>  <td>
                                <input type='radio' name='g' class='flat-red' value='Laki-laki'> Laki-laki
                                <input type='radio' name='g' class='flat-red' value='Perempuan'> Perempuan
                    </td></tr>
                    <tr><th scope='row'>Upload Foto</th>             <td><div style='position:relative;''>
                                                                          <a class='btn btn-primary' href='javascript:;'>
                                                                            Cari Foto Anda...' 
                     <input type='file' class='files' name='h' onchange='$('#upload-file-info').html($(this).val());'>
                     </a> <span style='width:155px' class='label label-info' id='upload-file-info'></span>
                                                                        </div>
                    </td></tr>
                  </tbody>
                  </table>
                </div>

                <div class='col-md-6'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='120px' scope='row'>No Telpon</th>              <td><input type='text' class='form-control' name='i'></td></tr>
                    <tr><th scope='row'>Agama</th>                  <td><input type='text' class='form-control' name='j'></td></tr>
                    <tr><th scope='row'>Jabatan</th>                <td><input type='text' class='form-control' name='k'></td></tr>
                    <tr><th scope='row'>Ijazah / Tahun</th>         <td><input type='text' class='form-control' name='l'></td></tr>
                    <tr><th scope='row'>Golongan</th>               <td><input type='text' class='form-control' name='m'></td></tr>
                    <tr><th scope='row'>Tgl Pegawai</th>            <td><input type='text' class='form-control' name='n'></td></tr>
                    <tr><th scope='row'>Tgl Kerja</th>              <td><input type='text' class='form-control' name='o'></td></tr>
                  </tbody>
                  </table>
                </div> 
              </div>
              <div class='box-footer'>
                    <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                    <a href='karyawan.php'><button class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}elseif($_GET[act]=='editkaryawan'){
  if (isset($_POST[update])){
      $dir_gambar = 'foto_pegawai/';
      $filename = basename($_FILES['h']['name']);
      $uploadfile = $dir_gambar . $filename;
      if ($filename != ''){      
        if (move_uploaded_file($_FILES['h']['tmp_name'], $uploadfile)) {
          mysql_query("UPDATE karyawan SET 
                           kd_emp          = '$_POST[a]',
                           password     = '$_POST[b]',
                           nama         = '$_POST[c]',
                           alamat       = '$_POST[d]',
                           tempat       = '$_POST[e]',
                           tanggallahir = '$_POST[f]',
                           jk           = '$_POST[g]',
                           foto         = '$filename',
                           telpon       = '$_POST[i]',
                           agama        = '$_POST[j]',
                           jabatan      = '$_POST[k]',
                           ijazahdantahun = '$_POST[l]',
                           tglmulaikerja = '$_POST[o]' where kd_emp='$_POST[id]'");

            echo "<script>document.location='index.php?view=karyawan&act=editkaryawan&id=".$_POST[id]."';</script>";
        }else{
          echo "<script>window.alert('Gagal Upload Foto.....');
                      window.location='index.php?view=karyawan&act=editkaryawan&id=".$_POST[id]."'</script>";
        }
      }else{
        mysql_query("UPDATE karyawan SET 
                           kd_emp          = '$_POST[a]',
                           password     = '$_POST[b]',
                           nama         = '$_POST[c]',
                           alamat       = '$_POST[d]',
                           tempat       = '$_POST[e]',
                           tanggallahir = '$_POST[f]',
                           jk           = '$_POST[g]',
                           telpon       = '$_POST[i]',
                           agama        = '$_POST[j]',
                           jabatan      = '$_POST[k]',
                           ijazahdantahun = '$_POST[l]',
                           tglmulaikerja = '$_POST[o]' where kd_emp='$_POST[id]'");
        echo "<script>document.location='index.php?view=karyawan&act=editkaryawan&id=".$_POST[id]."';</script>";

      }
  }

    $edit = mysql_query("SELECT * FROM karyawan a where a.kd_emp='$_GET[id]'");
    $s = mysql_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data karyawan</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-6'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[kd_emp]'>
                    <tr><th style='background-color:#E7EAEC' width='160px' rowspan='9'>";
                        if (trim($s[foto])==''){
                          echo "<img class='img-thumbnail' style='width:155px' src='user_images/432422.jpg'>";
                        }else{
                          echo "<img class='img-thumbnail' style='width:155px' src='foto_pegawai/$s[foto]'>";
                        }
                        echo "</th>
                    </tr>
                    <tr><th width='120px' scope='row'>kd_emp</th>      <td><input type='text' class='form-control' name='a' value='$s[kd_emp]'> </td></tr>
                    <tr><th scope='row'>Password</th>               <td><input type='text' class='form-control' name='b' value='$s[password]'></td></tr>
                    <tr><th scope='row'>Nama Lengkap</th>           <td><input type='text' class='form-control' name='c' value='$s[nama]'></td></tr>
                    <tr><th scope='row'>Alamat</th>                 <td><input type='text' class='form-control' name='d' value='$s[alamat]'></td></tr>
                    <tr><th scope='row'>Tempat Lahir</th>           <td><input type='text' class='form-control' name='e' value='$s[tempat]'></td></tr>
                    <tr><th scope='row'>Tanggal Lahir</th>          <td><input type='text' class='form-control' name='f' value='$s[tanggallahir]'></td></tr>
                    <tr><th width='120px' scope='row'>Jenis Kelamin</th>  <td>"; 
                      if ($s[jk]=='Laki-laki'){
                          echo "<input type='radio' name='g' class='flat-red' value='Laki-laki' checked> Laki-laki
                                <input type='radio' name='g' class='flat-red' value='Perempuan'> Perempuan";
                      }else{
                          echo "<input type='radio' name='g' class='flat-red' value='Laki-laki'> Laki-laki
                                <input type='radio' name='g' class='flat-red' value='Perempuan' checked> Perempuan";
                      }
                    echo "</td></tr>
                    <tr><th scope='row'>Ganti Foto</th>             <td><div style='position:relative;''>
                                                                          <a class='btn btn-primary' href='javascript:;'>
                                                                            Cari Foto Anda...!!!
                                                                            <input type='file' class='files' name='h' onchange='$('#upload-file-info').html($(this).val());'>
                                                                          </a> <span style='width:155px' class='label label-info' id='upload-file-info'></span>
                                                                        </div>
                    </td></tr>
                  </tbody>
                  </table>
                </div>

                <div class='col-md-6'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='120px' scope='row'>No Telpon</th>              <td><input type='text' class='form-control' name='i' value='$s[telpon]'></td></tr>
                    <tr><th scope='row'>Agama</th>                  <td><input type='text' class='form-control' name='j' value='$s[agama]'></td></tr>
                    <tr><th scope='row'>Jabatan</th>                <td><input type='text' class='form-control' name='k' value='$s[jabatan]'></td></tr>
                    <tr><th scope='row'>Ijazah / Tahun</th>         <td><input type='text' class='form-control' name='l' value='$s[ijazahdantahun]'></td></tr>
                    <tr><th scope='row'>Golongan</th>               <td><input type='text' class='form-control' name='m' value='$s[gol]'></td></tr>
                    <tr><th scope='row'>Tgl Pegawai</th>            <td><input type='text' class='form-control' name='n' value='$s[tgljdpegawai]'></td></tr>
                    <tr><th scope='row'>Tgl Kerja</th>              <td><input type='text' class='form-control' name='o' value='$s[tglmulaikerja]'></td></tr>
                  </tbody>
                  </table>
                </div> 
              </div>
              <div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Update</button>
                    <a href='karyawan.php'><button class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}elseif($_GET[act]=='detailkaryawan'){
    $detail = mysql_query("SELECT * FROM karyawan a where a.kd_emp='$_GET[id]'");
    $s = mysql_fetch_array($detail);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data karyawan</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-6'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[kd_emp]'>
                    <tr><th style='background-color:#E7EAEC' width='160px' rowspan='9'>";
                        if (trim($s[foto])==''){
                          echo "<img class='img-thumbnail' style='width:155px' src='user_images/432422.jpg'>";
                        }else{
                          echo "<img class='img-thumbnail' style='width:155px' src='foto_pegawai/$s[foto]'>";
                        }
						//http://localhost:1234/bunder/karyawan.php?view=karyawan&act=editkaryawan&id=1
                        echo "<a href='?view=karyawan&act=editkaryawan&id=$_GET[id]' class='btn btn-success btn-block'>Edit Profile '$s[nama]'</a>
                        </th>
                    </tr>
                    <tr><th width='120px' scope='row'>kd_emp</th>   <td>$s[kd_emp]</td></tr>
                    <tr><th scope='row'>Password</th>               <td>$s[password]</td></tr>
                    <tr><th scope='row'>Nama Lengkap</th>           <td>$s[nama]</td></tr>
                    <tr><th scope='row'>Alamat</th>                 <td>$s[alamat]</td></tr>
                    <tr><th scope='row'>Tempat Lahir</th>           <td>$s[tempat]</td></tr>
                    <tr><th scope='row'>Tanggal Lahir</th>          <td>$s[tanggallahir]</td></tr>
                    <tr><th scope='row'>Jenis Kelamin</th>  		<td>$s[jk]</td></tr>
                  </tbody>
                  </table>
                </div>

                <div class='col-md-6'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='120px' scope='row'>No Telpon</th>    <td>$s[telpon]</td></tr>
                    <tr><th scope='row'>Agama</th>                  	<td>$s[agama]</td></tr>
                    <tr><th scope='row'>Jabatan</th>                	<td>$s[jabatan]</td></tr>
                    <tr><th scope='row'>Ijazah / Tahun</th>         	<td>$s[ijazahdantahun]</td></tr>
                    <tr><th scope='row'>Golongan</th>               	<td>$s[gol]</td></tr>
                    <tr><th scope='row'>Tgl Pegawai</th>            	<td>$s[tgljdpegawai]</td></tr>
                    <tr><th scope='row'>Tgl Kerja</th>              	<td>$s[tglmulaikerja]</td></tr>
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