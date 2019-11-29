<!DOCTYPE html>
<html>
<head>
	<title>JQuery UI Part 2 : Membuat form inputan tanggal dengan jquery ui</title>	
	<script type="text/javascript" src="jquery-ui-1.11.4/jquery.js"></script>
	<script type="text/javascript" src="jquery-ui-1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="jquery-ui-1.11.4/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Membuat form inputan tanggal dengan jquery ui | www.malasngoding.com</h1>	

	<input type="text" class="input-tanggal">

</body>
<script type="text/javascript">
	$(document).ready(function(){
		$('.input-tanggal').datepicker();		
	});
</script>
</html>