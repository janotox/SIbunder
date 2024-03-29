<html>
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery Datetimepicker</title>
  <link href="jquery/css/bootstrap.min.css" rel="stylesheet">
  <link href="jquery/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
 </head>
 <body>
  <div class="container">
   <div> 
    <div style="padding-top: 25px;">
     <center><h1>jQuery Datetimepicker</h1></center>
    </div>
    <br />
    <div class="row">
     <div class='col-sm-4'>
     </div>
     <!-- DATETIMEPICKER -->
     <div class='col-sm-4'>
      <label>Date Time Picker:</label>
      <div class="form-group">
       <div class='input-group date' id='datetimepicker'>
        <input type='text' class="form-control" />
        <span class="input-group-addon">
         <span class="glyphicon glyphicon-calendar"></span>
        </span>
       </div>
      </div>
      
      <label>Date Picker:</label>
      <div class="form-group">
       <div class='input-group date' id='datepicker'>
        <input type='text' class="form-control" />
        <span class="input-group-addon">
         <span class="glyphicon glyphicon-calendar"></span>
        </span>
       </div>
      </div>
      
      <label>Time Picker:</label>
      <div class="form-group">
       <div class='input-group date' id='timepicker'>
        <input type='text' class="form-control" />
        <span class="input-group-addon">
         <span class="glyphicon glyphicon-calendar"></span>
        </span>
       </div>
      </div>
     </div>
     <!-- DATETIMEPICKER -->
     <div class='col-sm-4'>
     </div>
    </div>
   </div>
  </div>
  <script src="jquery/jquery-2.1.4.min.js"></script>
  <script src="jquery/js/bootstrap.min.js"></script>
  <script src="jquery/js/moment.min.js"></script>
  <script src="jquery/js/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript">
   $(function () {
    $('#datetimepicker').datetimepicker({
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
 </body>
</html>