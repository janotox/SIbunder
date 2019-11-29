<?php
 require_once 'nav.php';
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Data Gaji Karyawan</title>
<script type="text/javascript">
$(document).ready(function(){
	
	$("#btn-view").hide();
	
	$("#btn-add").click(function(){
		$(".content-loader").fadeOut('slow', function()
		{
			$(".content-loader").fadeIn('slow');
			$(".content-loader").load('add_form.php');
			$("#btn-add").hide();
			$("#btn-view").show();
		});
	});
	
	$("#btn-view").click(function(){
		
		$("body").fadeOut('slow', function()
		{
			$("body").load('gaji.php');
			$("body").fadeIn('slow');
			window.location.href="gaji.php";
		});
	});
	
});
</script>

</head>

<body>
 
<!--nav class="navbar navbar-default navbar-fixed-top"-->
      
    <!--/nav--> 


	<div class="container">
      
        <h2 class="form-signin-heading">Salary Records.</h2><hr />
        <button class="btn btn-info" type="button" id="btn-add"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Tambah Karyawan</button> 
        <button class="btn btn-info" type="button" id="btn-view"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; Lihat Karyawan</button>
        <hr />
        
        <div class="content-loader">
        
        <table cellspacing="0" width="100%" id="example" class="table table-striped table-hover table-responsive">
        <thead>
        <tr>
		<th>No</th>
        <th>ID</th>
        <th>NamA</th>
        <th>Jabatan</th>
        <th>Gaji</th>
        <th>edit</th>
        <th>delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require_once 'dbconfig.php';
        $no=1;
        $stmt = $DB_con->prepare("SELECT * FROM tbl_employees ORDER BY emp_id DESC");
        $stmt->execute();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $row['emp_id']; ?></td>
			<td><?php echo $row['emp_name']; ?></td>
			<td><?php echo $row['emp_dept']; ?></td>
			<td><?php echo $row['emp_salary']; ?></td>
			<td align="center">
			<a id="<?php echo $row['emp_id']; ?>" class="edit-link" href="gaji.php" title="Edit">
			<img src="edit.png" width="20px" />
            </a></td>
			<td align="center"><a id="<?php echo $row['emp_id']; ?>" class="delete-link" href="gaji.php" title="Delete">
			<img src="delete.png" width="20px" />
            </a></td>
			</tr>
			<?php
			$no++;
		}
		?>
        </tbody>
        </table>
        
        </div>

    </div>
    
    <br />
    
    
    

    
<script src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/datatables.min.js"></script>
<script type="text/javascript" src="crud.js"></script>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#example').DataTable();

	$('#example')
	.removeClass( 'display' )
	.addClass('table table-bordered');
});
</script>
</body>
</html>