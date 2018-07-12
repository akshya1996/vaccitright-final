<?php
session_start();
$userid=$_SESSION['userid'];
$childid=$_SESSION['childid']

?>

<html>
<head>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/script.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1.0">
  <style>
  @import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);
  body {
    font-family: 'Open Sans', 'sans-serif';
  }
  .carousel-control {
    width: 30px;
    height: 30px;
    top: -35px;

  }
  .left.carousel-control {
    right: 30px;
    left: inherit;
  }
  .carousel-control .glyphicon-chevron-left, 
  .carousel-control .glyphicon-chevron-right {
    font-size: 12px;
    background-color: #fff;
    line-height: 30px;
    text-shadow: none;
    color: #333;
    border: 1px solid #ddd;
  }
  .navbar{
    border-radius: 0px !important;
  }

  .panel-info {
    border-color: #696768 !important;
  }

  .panel-info>.panel-heading {
    color: #e7eef1 !important;
    background-color: #4a4d4e !important;
    border-color: #696768 !important;


  }
  .panel-table .panel-body{
    padding:0;
  }

  .panel-table .panel-body .table-bordered{
    border-style: none;
    margin:0;
  }

  .panel-table .panel-body .table-bordered > thead > tr > th:first-of-type {
    text-align:center;
    width: 100px;
  }

  .panel-table .panel-body .table-bordered > thead > tr > th:last-of-type,
  .panel-table .panel-body .table-bordered > tbody > tr > td:last-of-type {
    border-right: 0px;
  }

  .panel-table .panel-body .table-bordered > thead > tr > th:first-of-type,
  .panel-table .panel-body .table-bordered > tbody > tr > td:first-of-type {
    border-left: 0px;
  }

  .panel-table .panel-body .table-bordered > tbody > tr:first-of-type > td{
    border-bottom: 0px;
  }

  .panel-table .panel-body .table-bordered > thead > tr:first-of-type > th{
    border-top: 0px;
  }

  .panel-table .panel-footer .pagination{
    margin:0; 
  }

/*
used to vertically center elements, may need modification if you're not using default sizes.
*/
.panel-table .panel-footer .col{
 line-height: 34px;
 height: 34px;
}

.panel-table .panel-heading .col h3{
 line-height: 30px;
 height: 30px;
}

.panel-table .panel-body .table-bordered > tbody > tr > td{
  line-height: 34px;
}
</style>

<script>


</script>
<script>
function myFunction() {
    window.print();
}



</script>
</head>
<body>
<?php

//cnnect to the database
  $db = new mysqli("localhost","root","","vaccitright");



?>
  <!------ Include the above in your HEAD tag ---------->

  <div class="container-fullwidth">
    <nav class="navbar navbar-inverse">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">My Child Vaccines</a>
      </div>

      <div class="collapse navbar-collapse js-navbar-collapse">

        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="parentlogin.php">Home</span></a>
          </li>
          <li><a href="home.html">Logout</a></li>
        </ul>
      </div><!-- /.nav-collapse -->
    </nav>
  </div>
<?php 
$query = "SELECT cfname,clname,dob,sex FROM child WHERE childid='$childid'";
$result=$db->query($query);  
$row = $result->fetch_array();
$cfname=$row[0];
$clname=$row[1];
$dob=$row[2];
$sex=$row[3];





?>
<center><p><b>Common Vaccine Information</b></p> </center>
<p><b>First Name: </b><?php echo $cfname; ?></p>
<p><b>Last Name: </b><?php echo $clname;?></p>
<p><b>Date of Birth: </b><?php echo $dob; ?></p>
<p><b>Sex: </b><?php echo $sex;?></p>

  
  
  
 <center><p><b>Common Vaccine Information</b></p> </center>
  <div class="container">
    <div class="">

      <p></p>



              <table class="table table-striped table-bordered table-list">
                <thead>
                  <tr>

                    <th>Vaccine</th>
                   
                    <th>Dosage month</th>
                    <th>Symptom1</th>
                    <th>Symptom2</th>
                    <th>Symptom3</th>
					
                  </tr> 
                </thead>
                <tbody>
<?php 

$query = "SELECT vaccinename,description,dosagedate,symptom1,symptom2,symptom3 FROM vaccine,vacc_child where childid='$childid' and vaccineid=vid";
       if($result = mysqli_query($db, $query)){
        if(mysqli_num_rows($result) > 0){
      
          while($row = mysqli_fetch_array($result))
          {
              


?>                 <tr>
                
                   <td><?php echo $row['vaccinename']; ?></td>
                   <td><?php echo $row['dosagedate'];?></td>
                   <td><?php echo $row['symptom1'];?></td>
                   <td><?php echo $row['symptom2'];?></td>
				   <td><?php echo $row['symptom3'];?></td>
				   
				
                 </tr>
                
<?php  }
          }
        }
        ?>             
           
 
</tbody>
</table>

</div>
</div>
<!----------------------------------------------------------EXTERNAL VACCINE INFORMATION---------------------------------------------------->
<!----------------------------------------------------------EXTERNAL VACCINE INFORMATION---------------------------------------------------->
<!----------------------------------------------------------EXTERNAL VACCINE INFORMATION---------------------------------------------------->
<!----------------------------------------------------------EXTERNAL VACCINE INFORMATION---------------------------------------------------->
<!----------------------------------------------------------EXTERNAL VACCINE INFORMATION---------------------------------------------------->
<!----------------------------------------------------------EXTERNAL VACCINE INFORMATION---------------------------------------------------->


  
  
  
  
 <center><p><b>External Vaccine Information</b></p> </center>
  <div class="container">
    <div class="">

      <p></p>



              <table class="table table-striped table-bordered table-list">
                <thead>
                  <tr>

                    <th>Vaccine</th>
                   
                    <th>Dosage month</th>
                    <th>Symptom1</th>
                    <th>Symptom2</th>
                    <th>Symptom3</th>
					
                  </tr> 
                </thead>
                <tbody>
<?php 

$query = "SELECT evaccname,evaccdesc,dosagedate,symptom1,symptom2,symptom3 FROM externalvacc,evacc_child where childid='$childid' and evaccid=evid";
       if($result = mysqli_query($db, $query)){
        if(mysqli_num_rows($result) > 0){
      
          while($row = mysqli_fetch_array($result))
          {
              


?>                 <tr>
                 
                   <td><?php echo $row['evaccname']; ?></td>
				   
                   <td><?php echo $row['dosagedate'];?></td>
                   <td><?php echo $row['symptom1'];?></td>
                   <td><?php echo $row['symptom2'];?></td>
				   <td><?php echo $row['symptom3'];?></td>
				  
			
                 </tr>
                
<?php  }
          }
        }
        ?>             
           
 
</tbody>
</table>


</div>
</div>
<!------------------------------------PRINT THE PAGE---------------------------------------------------------------->
<center>
                                    <div class="col-sm-12 controls">
                                      <button class="btn btn-primary hidden-print" onclick="myFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
                                     

                                    </div>
									</center>
                            








</body>
</html>